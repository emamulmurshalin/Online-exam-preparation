<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\SignUpMail;
use App\Models\Exam\Admin\PreviousQuestion;
use App\Models\Exam\Admin\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('isAdmin');
        return User::with('status')
            ->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|min:6'
        ]);
        $randomCode = mt_rand(100000, 999999);
        $request['password'] = Hash::make($request->password);
        $request['verification_code'] = $randomCode;

        $user = User::create($request->all());

        $details = [
            'title' => 'Hi There, Hope this mail finds you well and healthy.
            We are informing you that you\'ve been registered to our application
            by own. It\'ll be a great opportunity to work with you. We send a varification
            code for you to verified your email',
            'body' => 'verification code: '.$randomCode
        ];

        Mail::to($request->email)
            ->send(new SignUpMail($details));

        if ($user)
        {
            return [
                'status' => 200,
                'message' => 'User created successfully',
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return User::with('status')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (!$request->password){
            $request['password'] = $user->password;
        }else{
            $request['password'] = Hash::make($request->password);
        }
        $this->validate($request, [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|string|email|max:191',
            'password' => 'required|min:6'
        ]);
//        if (!empty($request->password)){
//            $request->merge(['password' => Hash::make($request['password'])]);
//        }
        $updatUser = $user->update($request->all());
        if ($updatUser)
        {
            return [
                'status' => 200,
                'message' => 'User updated successfully',
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('isAdmin');
        $user = User::findOrFail($id);
        if ($user->delete())
        {
            return [
                'status' => 200,
                'message' => 'User deleted successfully',
            ];
        }
    }

    public function profile()
    {
        $user = Auth::user();
        if (!$user->photo){
            $user->photo = "default.png";
        }
        return $user;
    }
    public function updateProfile(Request $request, $id)
    {
        $user = Auth::user();
        if (!$request->password){
            $request['password'] = $user->password;
        }else{
            $request['password'] = Hash::make($request->password);
        }

        $this->validate($request, [
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|string|min:6'
        ]);

        $currentPhoto = $user->photo;
        if ($request->photo != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('img/profile/').$name);

            $request->merge(['photo' => $name]);

            //$userPhoto = basename(public_path('/img/profile/').$currentPhoto);
            $filePath = public_path('img/profile/').$currentPhoto;
            if (file_exists($filePath)){
                unlink($filePath);
            }
        }

//        if (!empty($request->password)){
//            $request->merge(['password' => Hash::make($request['password'])]);
//        }
        $user->update($request->all());
        return [
            'status' => 200,
            'message' => 'User profile updated successfully',
        ];
    }
    public function search(Request $request){
        if ($search = \Request::get('search')){
            $users = User::with('status')
                ->where(function ($query) use ($search){
                $query->where('email', 'LIKE', '%'.$search.'%')
                    ->orWhere('first_name', 'LIKE', '%'.$search.'%')
                    ->orWhere('last_name', 'LIKE', '%'.$search.'%');
                })->paginate(10);
            return $users;
        }
        return User::with('status')
            ->paginate(10);
    }

    public function loginUser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'sometimes|required|string|min:6'
        ]);

        $userInfo = User::where('email', $request->email)->first()->verified;

        if ($userInfo == 1)
        {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return response()->json([
                    'status' => 200,
                    'message' => 'You are logged in successfully'
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Incorrect login details'
                ]);
            }
        } else{
            return response()->json([
                'status' => 403,
                'message' => 'You are not verified yet'
            ]);
        }
    }

    public function loginAdmin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'sometimes|required|string|min:6'
        ]);

        $userInfo = User::where('email', $request->email)->first()->verified;

        if ($userInfo == 1)
        {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return response()->json([
                    'status' => 200,
                    'message' => 'You are logged in successfully'
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Incorrect login details'
                ]);
            }
        } else {
            return response()->json([
                'status' => 403,
                'message' => 'You are not verified yet'
            ]);
        }
    }

    public function userVerified(Request $request, User $user)
    {
        $userId = User::where('email', $request->email)->first();
        if ($userId->verification_code == $request->verification_code)
        {
            $request['verified'] = 1;
            $request['status_id'] = 1;
            $userId->update($request->all());
            return response()->json([
                'status' => 200,
                'message' => 'You are now verified'
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Verification code don\'t matched'
            ]);
        }
    }

    public function userResendCode(Request $request, User $user)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:191',
        ]);
        $randomCode = mt_rand(100000, 999999);
        $request['verification_code'] = $randomCode;

        $userInfo = User::where('email', $request->email)->first();
        $sendCode = $userInfo->update($request->all());

        $details = [
            'title' => 'Hi There, Hope this mail finds you well and healthy.
            We are informing you that you\'ve been registered to our application
            by own. It\'ll be a great opportunity to work with you. We send a verification
            code for you to verified your email',
            'body' => 'verification code: '.$randomCode
        ];

        Mail::to($request->email)
            ->send(new SignUpMail($details));

        if ($sendCode)
        {
            return [
                'status' => 200,
                'message' => 'Resend code sent',
            ];
        }
    }
    public function userPasswordReset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:191',
        ]);
        $randomCode = mt_rand(1000000, 9999999);
        $request['password_recover_code'] = $randomCode;

        $userInfo = User::where('email', $request->email)->first();

        $sendCode = $userInfo->update(
            ['password_recover_code' => $request->password_recover_code]
        );

        $details = [
            'title' => 'Hi There, Hope this mail finds you well and healthy.
            We are informing you that you\'ve been apply for reset password
            by own. We send a verification code for you to verified your email',
            'body' => 'verification code: '.$randomCode
        ];

        Mail::to($request->email)
            ->send(new SignUpMail($details));

        if ($sendCode)
        {
            return [
                'status' => 200,
                'message' => 'Verification code sent',
            ];
        }
    }

    public function userNewPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:191',
            'password_recover_code' => 'required',
            'password' => 'required|min:6',
        ]);

        $userInfo = User::where('email', $request->email)->first();

        $updatePassword = $userInfo->update(
            ['password' => Hash::make($request->password)]
        );

        if ($updatePassword)
        {
            return [
                'status' => 200,
                'message' => 'Your password updated',
            ];
        }
    }

    //Get profile data
    public function totalUser()
    {
        return User::all()->count();
    }
    public function totalQuestion()
    {
        return PreviousQuestion::all()->count();
    }
    public function totalQuiz()
    {
        return Quiz::all()->count();
    }

}
