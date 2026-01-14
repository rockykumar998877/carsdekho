<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CarDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create Car Categories
        $categories = [
            [
                'name' => 'Hatchback',
                'slug' => Str::slug('Hatchback'),
                'description' => 'Compact and fuel-efficient cars perfect for city driving',
                'icon' => 'hatchback-icon',
                'is_active' => true,
            ],
            [
                'name' => 'Sedan',
                'slug' => Str::slug('Sedan'),
                'description' => 'Comfortable and elegant cars for a smooth ride',
                'icon' => 'sedan-icon',
                'is_active' => true,
            ],
            [
                'name' => 'SUV',
                'slug' => Str::slug('SUV'),
                'description' => 'Spacious and powerful vehicles for any terrain',
                'icon' => 'suv-icon',
                'is_active' => true,
            ],
            [
                'name' => 'Luxury',
                'slug' => Str::slug('Luxury'),
                'description' => 'Premium cars with top-of-the-line features',
                'icon' => 'luxury-icon',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            CarCategory::create($categoryData);
        }

        // Get created categories
        $hatchback = CarCategory::where('slug', 'hatchback')->first();
        $sedan = CarCategory::where('slug', 'sedan')->first();
        $suv = CarCategory::where('slug', 'suv')->first();
        $luxury = CarCategory::where('slug', 'luxury')->first();

        // Create Sample Cars
        $cars = [
            // Hatchbacks
            [
                'category_id' => $hatchback->id,
                'name' => 'Honda Jazz',
                'model' => 'VX CVT',
                'year' => 2024,
                'price_per_day' => 45.00,
                'description' => 'Compact hatchback with spacious interior and great fuel economy',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'is_available' => true,
                'is_featured' => true,
                'is_most_searched' => true,
                'search_count' => 120,
            ],
            [
                'category_id' => $hatchback->id,
                'name' => 'Maruti Swift',
                'model' => 'ZXI Plus',
                'year' => 2024,
                'price_per_day' => 40.00,
                'description' => 'Popular hatchback known for reliability and efficiency',
                'seats' => 5,
                'transmission' => 'manual',
                'fuel_type' => 'petrol',
                'is_available' => true,
                'is_featured' => true,
                'is_most_searched' => true,
                'search_count' => 150,
            ],
            [
                'category_id' => $hatchback->id,
                'name' => 'Hyundai i20',
                'model' => 'Asta',
                'year' => 2024,
                'price_per_day' => 48.00,
                'description' => 'Premium hatchback with advanced features',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'is_available' => true,
                'is_featured' => false,
                'is_most_searched' => true,
                'search_count' => 95,
            ],
            
            // Sedans
            [
                'category_id' => $sedan->id,
                'name' => 'Honda City',
                'model' => 'ZX CVT',
                'year' => 2024,
                'price_per_day' => 60.00,
                'description' => 'Elegant sedan with comfortable ride and premium features',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'is_available' => true,
                'is_featured' => true,
                'is_most_searched' => true,
                'search_count' => 180,
            ],
            [
                'category_id' => $sedan->id,
                'name' => 'Hyundai Verna',
                'model' => 'SX (O)',
                'year' => 2024,
                'price_per_day' => 58.00,
                'description' => 'Stylish sedan with great performance',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'diesel',
                'is_available' => true,
                'is_featured' => true,
                'is_most_searched' => false,
                'search_count' => 75,
            ],
            [
                'category_id' => $sedan->id,
                'name' => 'Maruti Ciaz',
                'model' => 'Alpha AT',
                'year' => 2023,
                'price_per_day' => 55.00,
                'description' => 'Spacious sedan perfect for long drives',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'is_available' => true,
                'is_featured' => true,
                'is_most_searched' => false,
                'search_count' => 60,
            ],
            
            // SUVs
           [
                'category_id' => $suv->id,
                'name' => 'Hyundai Creta',
                'model' => 'SX (O) 1.5 Turbo',
                'year' => 2024,
                'price_per_day' => 85.00,
                'description' => 'Premium SUV with advanced safety features',
                'seats' => 7,
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'is_available' => true,
                'is_featured' => true,
                'is_most_searched' => true,
                'search_count' => 200,
            ],
            [
                'category_id' => $suv->id,
                'name' => 'Mahindra XUV700',
                'model' => 'AX7 Diesel AT',
                'year' => 2024,
                'price_per_day' => 95.00,
                'description' => 'Powerful SUV with cutting-edge technology',
                'seats' => 7,
                'transmission' => 'automatic',
                'fuel_type' => 'diesel',
                'is_available' => true,
                'is_featured' => true,
                'is_most_searched' => false,
                'search_count' => 85,
            ],
            [
                'category_id' => $suv->id,
                'name' => 'Kia Seltos',
                'model' => 'GTX Plus DCT',
'year' => 2024,
                'price_per_day' => 80.00,
                'description' => 'Modern SUV with sporty design',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'is_available' => true,
                'is_featured' => true,
                'is_most_searched' => true,
                'search_count' => 110,
            ],
            
            // Luxury
            [
                'category_id' => $luxury->id,
                'name' => 'Mercedes-Benz E-Class',
                'model' => 'E 220d',
                'year' => 2024,
                'price_per_day' => 250.00,
                'description' => 'Luxury sedan with unmatched comfort and style',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'diesel',
                'is_available' => true,
                'is_featured' => true,
                'is_most_searched' => false,
                'search_count' => 45,
            ],
            [
                'category_id' => $luxury->id,
                'name' => 'BMW 5 Series',
                'model' => '520d Luxury Line',
                'year' => 2024,
                'price_per_day' => 280.00,
                'description' => 'Executive sedan with dynamic performance',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'diesel',
                'is_available' => true,
                'is_featured' => false,
                'is_most_searched' => false,
                'search_count' => 35,
            ],
        ];

        foreach ($cars as $carData) {
            Car::create($carData);
        }

        $this->command->info('Car categories and sample cars created successfully!');
    }
}
