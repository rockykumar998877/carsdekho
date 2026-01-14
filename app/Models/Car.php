<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'model',
        'year',
        'price_per_day',
        'image',
        'images',
        'description',
        'features',
        'seats',
        'transmission',
        'fuel_type',
        'is_available',
        'is_featured',
        'is_most_searched',
        'search_count',
    ];

    protected $casts = [
        'images' => 'array',
        'features' => 'array',
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
        'is_most_searched' => 'boolean',
        'year' => 'integer',
        'seats' => 'integer',
        'search_count' => 'integer',
        'price_per_day' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(CarCategory::class, 'category_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
