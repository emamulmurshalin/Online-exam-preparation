<?php

namespace App\Models\Exam\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;
    public function contactComment()
    {
        return $this->hasOne(ContactComments::class);
    }
    public function country()
    {
        return $this->hasOne(Country::class);
    }
}
