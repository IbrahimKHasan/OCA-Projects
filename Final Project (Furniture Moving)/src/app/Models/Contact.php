<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'contact_name',
        'contact_email',
        'contact_phone',
        'contact_message',
    ];
}
