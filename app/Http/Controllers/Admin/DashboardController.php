<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarCategory;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics
        $totalCars = Car::count();
        $availableCars = Car::where('is_available', true)->count();
        $featuredCars = Car::where('is_featured', true)->count();
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $totalCategories = CarCategory::where('is_active', true)->count();
        $totalUsers = User::count();
        
        // Get latest bookings
        $latestBookings = Booking::with(['car', 'category'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Get most searched/popular cars
        $popularCars = Car::where('is_most_searched', true)
            ->orWhere('search_count', '>', 0)
            ->orderBy('search_count', 'desc')
            ->take(5)
            ->get();
        
        // Get cars by category
        $carsByCategory = CarCategory::withCount('cars')
            ->where('is_active', true)
            ->get();
        
        // Recent cars
        $recentCars = Car::with('category')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        
        // Booking status breakdown
        $bookingStats = [
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'completed' => Booking::where('status', 'completed')->count(),
            'cancelled' => Booking::where('status', 'cancelled')->count(),
        ];

        return view('admin.dashboard.index', compact(
            'totalCars',
            'availableCars',
            'featuredCars',
            'totalBookings',
            'pendingBookings',
            'confirmedBookings',
            'totalCategories',
            'totalUsers',
            'latestBookings',
            'popularCars',
            'carsByCategory',
            'recentCars',
            'bookingStats'
        ));
    }
}
