<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\CarCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function create()
    {
        $categories = CarCategory::where('is_active', true)->get();
        return view('frontend.booking-form', compact('categories'));
    }

    public function getCars(Request $request)
    {
        $categoryIds = is_array($request->category_id) ? $request->category_id : explode(',', $request->category_id);
        
        $cars = Car::whereIn('category_id', $categoryIds)
            ->where('is_available', true)
            ->get();
        
        return response()->json($cars);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'required|email|max:255',
            'customer_address' => 'required|string',
            'category_ids' => 'required|array|min:1',
            'category_ids.*' => 'exists:car_categories,id',
            'car_id' => 'nullable|exists:cars,id',
            'start_date' => 'nullable|date|after_or_equal:today',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        try {
            DB::beginTransaction();

            $car = null;
            if ($request->car_id) {
                $car = Car::findOrFail($request->car_id);
            }

            $totalDays = 1;
            $totalPrice = null;

            if ($request->start_date && $request->end_date && $car) {
                $start = \Carbon\Carbon::parse($request->start_date);
                $end = \Carbon\Carbon::parse($request->end_date);
                $totalDays = $start->diffInDays($end) + 1;
                $totalPrice = $car->price_per_day * $totalDays;
            }

            $booking = Booking::create([
                'category_id' => $request->category_ids[0], // Use first category as primary
                'car_id' => $request->car_id ?? null,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email,
                'customer_address' => $request->customer_address,
                'booking_date' => now(),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'total_days' => $totalDays,
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            // Attach all selected categories
            $booking->categories()->attach($request->category_ids);

            DB::commit();

            return redirect()->route('booking.create')
                ->with('success', 'Booking submitted successfully! We will contact you soon.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
}
