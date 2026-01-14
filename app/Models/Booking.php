<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_number',
        'car_id',
        'category_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'booking_date',
        'start_date',
        'end_date',
        'total_days',
        'total_price',
        'status',
        'notes',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'total_days' => 'integer',
        'total_price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->booking_number)) {
                $booking->booking_number = 'BK' . strtoupper(uniqid());
            }
        });
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function category()
    {
        return $this->belongsTo(CarCategory::class, 'category_id');
    }
}
