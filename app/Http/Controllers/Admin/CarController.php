<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('category')->latest()->paginate(15);
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        $categories = CarCategory::where('is_active', true)->get();
        return view('admin.cars.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:car_categories,id',
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price_per_day' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'seats' => 'required|integer|min:1|max:20',
            'transmission' => 'required|in:automatic,manual',
            'fuel_type' => 'required|in:petrol,diesel,electric,hybrid',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'is_most_searched' => 'boolean',
        ]);

        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        Car::create($data);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car created successfully!');
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $categories = CarCategory::where('is_active', true)->get();
        return view('admin.cars.edit', compact('car', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:car_categories,id',
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price_per_day' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'seats' => 'required|integer|min:1|max:20',
            'transmission' => 'required|in:automatic,manual',
            'fuel_type' => 'required|in:petrol,diesel,electric,hybrid',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'is_most_searched' => 'boolean',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        $car->update($data);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car updated successfully!');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }

        $car->delete();

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car deleted successfully!');
    }
}
