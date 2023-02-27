<?php

namespace App\Models;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'user_id',
        'company_name',
        'company_description',
        'company_location',
        'bedroom_price',
        'livingroom_price',
        'guestroom_price',
        'kitchen_price',
        'km_price',
        'pack_price',
        'status',
        'company_rate'=>"double",
        'company_rate_count',
        'company_bookings_count',
        'company_image',
        'company_email',
        'company_phone',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class,'company_id','company_id');
    }
}
