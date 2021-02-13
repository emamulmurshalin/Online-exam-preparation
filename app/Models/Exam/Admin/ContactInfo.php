<?php

namespace App\Models\Exam\Admin;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'status_id'
    ];
}
