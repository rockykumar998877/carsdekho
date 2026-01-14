<nav class="navbar navbar-expand-lg nowrap px-sm-4 py-3  p-2" id="header">
    <div class="container-fluid nowrap">

        <!-- Left: Mobile Hamburger Menu -->
        <button class="btn text-dark  py-2 px-3  d-lg-none mobile-offcanvas" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#sidebarOffcanvas">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Left: Hamburger Menu -->
        <button class="btn text-dark py-2 px-3 d-lg-block d-none ">
            <i class="fas fa-bars hamburg-icon"></i>
        </button>

        <!-- Right: Icons -->
        <div class="d-flex align-items-center gap-4 header-right-content">

            <!-- Search Bar -->
            <div class="position-relative" style="color:#D4D4D8">
                <input type="text" class="form-control ps-5" placeholder="Search...">
                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
            </div>

            <!-- Notification Icon -->
            <div id="notificationToggle" class="position-relative cursor-pointer" style="color:#D4D4D8">
                <i class="far fa-bell fs-2"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge text-danger p-2">
                    10+
                </span>
            </div>

            <!-- Custom Offcanvas -->
            <div id="overlay" class="overlay"></div>
            <div id="notificationCanvas" class="custom-offcanvas">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-dark">Notifications</h5>
                    <button type="button" class="btn-close closeCanvas"></button>
                </div>

                <div class="offcanvas-body">
                    <div class="notification-item">
                        <div class="notification-left-border"></div>
                        <div class="notification-content">
                            <div class="notification-header">
                                <div class="notification-title">
                                    <img src="{{ Vite::asset('resources/images/beg.svg') }}" class="notify-bag-icon">
                                    <span class="text-dark">New order</span>
                                </div>
                                <button class="notify-close">×</button>
                            </div>

                            <small class="notify-time">1 minute ago</small>
                            <p class="notify-text">Mr. Andre Jones ordered 4 products.</p>
                            <a href="#" class="notify-view">View</a>
                        </div>
                    </div>
                    <div class="notification-item">
                        <div class="notification-left-border"></div>
                        <div class="notification-content">
                            <div class="notification-header">
                                <div class="notification-title">
                                    <img src="{{ Vite::asset('resources/images/beg.svg') }}" class="notify-bag-icon">
                                    <span class="text-dark">New order</span>
                                </div>
                                <button class="notify-close">×</button>
                            </div>

                            <small class="notify-time">1 minute ago</small>
                            <p class="notify-text">Mr. Andre Jones ordered 4 products.</p>
                            <a href="#" class="notify-view">View</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Profile Picture -->
            <div class="dropdown">
                <div class="header-profile-image" data-bs-toggle="dropdown" aria-expanded="false">
                    @php
                        $user = auth()->user();
                    @endphp
                    @if (!empty($user->image))
                        <img src="{{ asset('storage/profile_images/' . $user->image) }}" alt="Profile"
                            class=" rounded-circle img-fluid auth-imgs me-2 cursor-pointer tansition-opacity object-fit-cover">
                    @else
                        <img src="{{ Vite::asset(config('constants.company_logo')) }}" alt="Profile"
                            class="rounded-circle img-fluid auth-imgs me-2 cursor-pointer tansition-opacity object-fit-cover"
                            width="35" height="35">
                    @endif
                </div>
                <!-- ==== Profile list start ==== -->
                <ul class="dropdown-menu dropdown-menu-end shadow inline-size-2 py-0 px-2 pullDown">
                    <li>
                        <a class="dropdown-item border-bottom d-flex align-items-center gap-2 fw-medium"
                            href="{{ route('admin.user.profile.edit') }}">
                            <i class="bi bi-person-circle"></i>
                            <span>{{ __('labels.profile') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item border-bottom d-flex align-items-center gap-2 fw-medium"
                            href="{{ route('admin.change-password') }}">
                            <i class="fa-solid fa-key"></i>
                            <span>{{ __('labels.change_password') }}</span>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center gap-2 fw-medium text-danger">
                                <i class="fas fa-right-from-bracket"></i>
                                <span>{{ __('labels.logout') }}</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<script>
    // Minimal inline translation variables (replaces @javascript directive)
    window.delete_modal_title = {!! json_encode(__('labels.delete_modal_title')) !!};
    window.delete_modal_text = {!! json_encode(__('labels.delete_modal_text')) !!};
    window.confirm_button_modal = {!! json_encode(__('labels.confirm_button_modal')) !!};
    window.cancel = {!! json_encode(__('buttons.cancel')) !!};
</script>