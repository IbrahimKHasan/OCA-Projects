<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_id',
        'user_id',
        'company_id',
        'user_email',
        'status',
        'phone',
        'price',
        'date'
    ];
}
