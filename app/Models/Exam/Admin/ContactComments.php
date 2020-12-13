<?php

namespace App\Models\Exam\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactComments extends Model
{
    use HasFactory;
    public function contactInfo()
    {
        return $this->belongsTo(ContactInfo::class);
    }
}
