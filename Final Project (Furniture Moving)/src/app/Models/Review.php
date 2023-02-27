<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'review_id',
        'user_id',
        'company_id',
        'review_body',
        'review_rate',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','company_id');
    }
}
