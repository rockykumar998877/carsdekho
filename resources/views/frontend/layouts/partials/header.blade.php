<header class="header">
    <div class="container">
        <nav class="navbar">
            <a href="{{ route('home') }}" class="logo">
                <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
                    <path d="M18 2L3 9V16C3 24.5 9.35 32.2 18 34C26.65 32.2 33 24.5 33 16V9L18 2Z" fill="url(#gradient)"/>
                    <defs>
                        <linearGradient id="gradient" x1="3" y1="2" x2="33" y2="34">
                            <stop offset="0%" stop-color="#667eea"/>
                            <stop offset="100%" stop-color="#764ba2"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span>CarRental</span>
            </a>

            <button class="mobile-toggle" id="mobileToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <ul class="nav-menu" id="navMenu">
                <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('booking.create') }}" class="nav-link {{ request()->routeIs('booking.create') ? 'active' : '' }}">Book Now</a></li>
                <li><a href="#featured-cars" class="nav-link">Cars</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
                @auth
                    <li><a href="{{ route('admin.dashboard.index') }}" class="btn btn-primary">Dashboard</a></li>
                @else
                    <li><a href="{{ route('admin.login') }}" class="btn btn-primary">Admin Login</a></li>
                @endauth
            </ul>
        </nav>
    </div>
</header>
