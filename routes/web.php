<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\JobExamInfoController;
use App\Http\Controllers\Admin\PreviousQuestionController;
use App\Http\Controllers\Admin\QuestionTypeController;
use App\Http\Controllers\Admin\QuestionYearController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuizManageController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\API\UserController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//Front end view
Route::get('/', function () {
    return view('layouts.frontEnd.master');
});
Route::get('/exam/contact-us', function () {
    return view('layouts.frontEnd.contact.contact-us');
});
Route::get('/exam/about', function () {
    return view('layouts.frontEnd.about.about');
});
Route::get('/exam/question', function () {
    return view('layouts.frontEnd.question.question-show-front');
});
Route::get('/exam/model-test', function () {
    return view('layouts.frontEnd.quiz.model-test');
});

Route::get('/user/login', function () {
    return view('layouts.frontEnd.register.login');
});

Route::get('/user/registration', function () {
    return view('layouts.frontEnd.register.registration');
});



//Admin view
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('layouts.admin.exam');
})->name('dashboard');

Route::middleware([Authenticate::class])->group(function () {
    Route::get('/users/list/view', function () {
        return view('layouts.admin.users.user');
    });

    Route::get('/users/contact-info', function () {
        return view('layouts.admin.contactInfo.contact-info');
    });

    //Post
    Route::get('/users/blog-post', function () {
        return view('layouts.admin.blog.blog-post');
    });
    Route::get('/users/add-post', function () {
        return view('layouts.admin.blog.add-post');
    });

    //Profile
    Route::get('/users/profile', function () {
        return view('layouts.admin.profile.profile');
    });

    //Quiz
    Route::get('/quiz/list/view', function () {
        return view('layouts.admin.quiz.quiz');
    });
    Route::get('/add-quiz', function () {
        return view('layouts.admin.quiz.add-quiz');
    });
    Route::get('/add-quiz-answer', function () {
        return view('layouts.admin.quiz.add-quiz-answer');
    });
    Route::get('/add-quiz-question', function () {
        return view('layouts.admin.quiz.add-quiz-question');
    });

    //Previous question
    Route::get('/add-previous-question', function () {
        return view('layouts.admin.previousQuestion.previous-question');
    });
    Route::get('/show-question', function () {
        return view('layouts.admin.previousQuestion.show-question');
    });

    //Job exam info
    Route::get('/show-exam-info', function () {
        return view('layouts.admin.jobExam.show-job-info');
    });
    Route::get('/add-exam-info', function () {
        return view('layouts.admin.jobExam.add-job-info');
    });

});

//Api for data get post edit delete
//User
Route::resource('users', UserController::class);
Route::get('/find-user', [UserController::class, 'search']);

//Profile
Route::get('/profile', [UserController::class, 'profile']);
Route::patch('/profile/{id}', [UserController::class, 'updateProfile']);

//Quiz
Route::resource('quiz', QuizController::class);
Route::post('/quiz-answer', [QuizController::class, 'addQuizAnswer'])
    ->name('question');
Route::get('/find-quiz', [QuizController::class, 'search']);

Route::post('/quiz/question', [QuizController::class, 'addQuizQuestion'])
    ->name('question');
Route::get('/get-question', [QuizController::class, 'getQuizQuestion'])
    ->name('get_question');
Route::get('/get-subject', [SubjectController::class, 'getsubject'])
    ->name('get_subject');

//Previous question
Route::resource('get-years', QuestionYearController::class);
Route::resource('get-types', QuestionTypeController::class);

Route::resource('previous-question', PreviousQuestionController::class);
Route::get('/find-previous-question', [PreviousQuestionController::class, 'search']);

//Contact info
Route::resource('contact-info', ContactInfoController::class);

Route::resource('blogs', BlogController::class);
Route::get('/get-post-category', [BlogController::class, 'getCategory'])
    ->name('get_post_category');
Route::get('/get-status', [BlogController::class, 'getStatus'])
    ->name('get_status');

Route::resource('jobs-info', JobExamInfoController::class);


Route::get('/exam/question/{id}/preview', [PreviousQuestionController::class, 'previewQuestion'])
    ->name('preview-question');

Route::get('/exam/question/{id}/download', [PreviousQuestionController::class, 'download'])
    ->name('download');

Route::get('/get-quiz', [QuizController::class, 'getQuiz'])
    ->name('get_quiz');

//Profile data get
Route::get('/get-total-user', [UserController::class, 'totalUser'])
    ->name('get_total_user');
Route::get('/get-total-question', [UserController::class, 'totalQuestion'])
    ->name('get_total_question');
Route::get('/get-total-quiz', [UserController::class, 'totalQuiz'])
    ->name('get_total_quiz');

//User login
Route::post('/user-login', [UserController::class, 'loginUser'])
    ->name('user_login');
Route::post('/admin-login', [UserController::class, 'loginAdmin'])
    ->name('admin_login');
