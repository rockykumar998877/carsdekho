@extends('frontend.layouts.app')

@section('content')
<div class="homepage">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">
                    Find Your Perfect<br>
                    <span class="gradient-text">Rental Car</span>
                </h1>
                <p class="hero-description">
                    Choose from our wide selection of premium vehicles. Whether it's a compact hatchback, elegant sedan, or spacious SUV, we've got you covered.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('booking.create') }}" class="btn btn-hero-primary">
                        Book Now
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a href="#featured-cars" class="btn btn-hero-secondary">
                        View Fleet
                    </a>
                </div>

                <!-- Stats -->
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Happy Customers</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Premium Cars</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Most Searched Cars Section -->
    @if($mostSearchedCars->count() > 0)
    <section class="section most-searched-section" id="most-searched">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Most Searched Cars</h2>
                <p class="section-subtitle">Popular picks from our collection</p>
            </div>

            <div class="cars-grid">
                @foreach($mostSearchedCars as $car)
                <div class="car-card">
                    <div class="car-card-image">
                        @if($car->image)
                            <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}">
                        @else
                            <div class="car-placeholder">
                                <svg width="80" height="80" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="car-badge">{{ $car->category->name }}</div>
                    </div>
                    <div class="car-card-content">
                        <h3 class="car-name">{{ $car->name }}</h3>
                        <p class="car-model">{{ $car->model }} • {{ $car->year }}</p>
                        
                        <div class="car-specs">
                            <div class="spec-item">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ $car->seats }} Seats</span>
                            </div>
                            <div class="spec-item">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                </svg>
                                <span>{{ ucfirst($car->transmission) }}</span>
                            </div>
                        </div>

                        <div class="car-footer">
                            <div class="car-price">
                                <span class="price-amount">${{ number_format($car->price_per_day, 2) }}</span>
                                <span class="price-period">/day</span>
                            </div>
                            <a href="{{ route('booking.create') }}" class="btn-book">Book Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Featured Cars Section -->
    @if($featuredCars->count() > 0)
    <section class="section latest-cars-section" id="featured-cars">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Latest Cars</h2>
                <p class="section-subtitle">Explore our newest additions</p>
            </div>

            <div class="cars-grid">
                @foreach($featuredCars as $car)
                <div class="car-card">
                    <div class="car-card-image">
                        @if($car->image)
                            <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}">
                        @else
                            <div class="car-placeholder">
                                <svg width="80" height="80" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="car-badge">{{ $car->category->name }}</div>
                    </div>
                    <div class="car-card-content">
                        <h3 class="car-name">{{ $car->name }}</h3>
                        <p class="car-model">{{ $car->model }} • {{ $car->year }}</p>
                        
                        <div class="car-specs">
                            <div class="spec-item">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ $car->seats }} Seats</span>
                            </div>
                            <div class="spec-item">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                </svg>
                                <span>{{ ucfirst($car->transmission) }}</span>
                            </div>
                        </div>

                        <div class="car-footer">
                            <div class="car-price">
                                <span class="price-amount">${{ number_format($car->price_per_day, 2) }}</span>
                                <span class="price-period">/day</span>
                            </div>
                            <a href="{{ route('booking.create') }}" class="btn-book">Book Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Contact Section -->
    <section class="section contact-section" id="contact">
        <div class="container">
            <div class="contact-content">
                <div class="contact-info">
                    <h2 class="section-title">Get In Touch</h2>
                    <p class="section-subtitle">Have questions? We're here to help!</p>
                    
                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                            </div>
                            <div>
                                <h4>Phone</h4>
                                <p>+1 (555) 123-4567</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                            </div>
                            <div>
                                <h4>Email</h4>
                                <p>info@carrental.com</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h4>Address</h4>
                                <p>123 Main St, City, State 12345</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact-cta">
                    <h3>Ready to hit the road?</h3>
                    <p>Book your dream car today and experience the best rental service!</p>
                    <a href="{{ route('booking.create') }}" class="btn btn-primary btn-large">
                        Start Booking
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
