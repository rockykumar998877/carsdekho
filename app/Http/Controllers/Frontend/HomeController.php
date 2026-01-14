<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = CarCategory::where('is_active', true)->get();
        
        $featuredCars = Car::where('is_featured', true)
            ->where('is_available', true)
            ->with('category')
            ->take(8)
            ->get();
        
        $mostSearchedCars = Car::where('is_most_searched', true)
            ->where('is_available', true)
            ->with('category')
            ->orderBy('search_count', 'desc')
            ->take(6)
            ->get();

        return view('frontend.home', compact('categories', 'featuredCars', 'mostSearchedCars'));
    }
}
