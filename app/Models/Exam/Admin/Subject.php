<?php

namespace App\Models\Exam\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public function quiz()
    {
        return $this->hasMany(Quiz::class);
    }
    protected $fillable = [
        'name'
    ];
}
