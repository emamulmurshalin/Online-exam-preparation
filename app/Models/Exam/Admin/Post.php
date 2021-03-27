<?php

namespace App\Models\Exam\Admin;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function postLike()
    {
        return $this->hasMany(PostLike::class);
    }
    public function category()
    {
        return $this->belongsTo(PostCatergory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    protected $fillable = [
        'title',
        'content',
        'category_id',
        'status_id',
        'user_id',
        'file_path'
    ];
}
