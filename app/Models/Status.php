<?php

namespace App\Models;

use App\Models\Exam\Admin\ContactInfo;
use App\Models\Exam\Admin\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function post()
    {
        return $this->hasMany(Post::class);
    }
    public function contactInfo()
    {
        return $this->hasMany(ContactInfo::class);
    }
}
