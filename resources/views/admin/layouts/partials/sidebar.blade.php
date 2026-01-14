<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarOffcanvas">
    <span class="position-absolute sidebar-offcanvas-close-btn translate-middle-y p-2 bg-primary text-white d-lg-none" data-bs-dismiss="offcanvas"><i class="bi bi-x-lg"></i></span>
    <!-- ======= Sidebar Start ======== -->
    <div class="sidebar overflow-hidden" id="sidebar">
        <div class="sidebar-inner h-100 overflow-hidden">
            <!-- Sidebar Header -->
            <div class="sidebar-header p-3">
                <div class="sidebar-logo-area">
                    <!-- mini logo -->
                    <div class="mini-logo text-center tansition-opacity d-none">
                        <a href="#" class="m-auto w-75">
                            <img src="{{ Vite::asset(config('constants.company_logo')) }}" alt="Logo"  class="m-auto img-fluid" />
                        </a>
                    </div>
                    <!-- full logo -->
                    <div class="full-logo text-center tansition-opacity">
                        <a href="#" class="m-auto w-75">
                            <img src="{{ Vite::asset(config('constants.company_logo')) }}" alt="Logo"  class="m-auto img-fluid" />
                        </a>
                    </div>
                </div>
            </div>
            <!-- Sidebar menus start -->
            <div class="sidebar-menus pt-0 pb-5 px-1 overflow-x-hidden overflow-y-auto">

        <ul class="accordion border-0 list-unstyled " id="sidebarMenusAccordian">
            <!-- Dashboard Menu start -->
            <li class="accordion-item {{ \Request::routeIs('admin.dashboard.index') ? 'active' : '' }}">
                <a class="accordion-button cursor-pointer no-arrow {{ \Request::routeIs('admin.dashboard.index') ? '' : 'collapsed' }}" aria-current="page"  href="{{ route('admin.dashboard.index') }}" title="{{ __('labels.dashboard') }}">
                    <i class="fa-solid fa-gauge d-flex align-items-center"></i><span class="sidebar-menus-name ms-2 tansition-opacity">{{ __('labels.dashboard') }}</span>
                </a>
            </li>
            <!-- Dashboard Menu end -->

            <!-- User Management Menu start -->
            <li class="accordion-item">
                <a class="accordion-button cursor-pointer collapsed" data-bs-toggle="collapse" data-bs-target="#user-management" aria-expanded="false" aria-controls="user-management">
                    <i class="bi bi-person-gear d-flex align-items-center"></i><span class="sidebar-menus-name ms-2 tansition-opacity">User Management</span>
                </a>
                <div id="user-management" class="accordion-collapse collapse" data-bs-parent="#sidebarMenusAccordian">
                    <div class="accordion-body py-0 px-2">
                        <ul class="nav flex-column">
                            <li>
                                <a href="{{ route('admin.users.index') }}" class="nav-link sidebar-menu-links @if (\Request::routeIs('admin.users.*')) active @endif">
                                    <i class="bi bi-people d-flex align-items-center"></i><span class="sidebar-menus-name ms-2 tansition-opacity">Users</span> 
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.roles.index') }}" class="nav-link sidebar-menu-links @if (\Request::routeIs('admin.roles.*')) active @endif">
                                    <i class="bi bi-person-badge d-flex align-items-center"></i><span class="sidebar-menus-name ms-2 tansition-opacity">Roles</span> 
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.permissions.index') }}" class="nav-link sidebar-menu-links @if(\Request::routeIs('admin.permissions.*')) active @endif">
                                    <i class="bi bi-shield-lock d-flex align-items-center"></i><span class="sidebar-menus-name ms-2 tansition-opacity">Permissions</span> 
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <!-- User Management Menu end -->

            <!-- Car Rental Management Menu start -->
            <li class="accordion-item @if (\Request::routeIs('admin.bookings.*') || \Request::routeIs('admin.cars.*') || \Request::routeIs('admin.categories.*')) active @endif">
                <a class="accordion-button cursor-pointer collapsed" data-bs-toggle="collapse" data-bs-target="#car-rental-management" aria-expanded="false" aria-controls="car-rental-management">
                    <i class="fa-solid fa-car d-flex align-items-center"></i><span class="sidebar-menus-name ms-2 tansition-opacity">Car Rental Management</span>
                </a>
                <div id="car-rental-management" class="accordion-collapse collapse" data-bs-parent="#sidebarMenusAccordian">
                    <div class="accordion-body py-0 px-2">
                        <ul class="nav flex-column">
                            <li>
                                <a href="{{ route('admin.bookings.index') }}" class="nav-link sidebar-menu-links @if (\Request::routeIs('admin.bookings.*')) active @endif">
                                    <i class="fa-solid fa-calendar-check d-flex align-items-center"></i><span class="sidebar-menus-name ms-2 tansition-opacity">Bookings</span> 
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.cars.index') }}" class="nav-link sidebar-menu-links @if (\Request::routeIs('admin.cars.*')) active @endif">
                                    <i class="fa-solid fa-car-side d-flex align-items-center"></i><span class="sidebar-menus-name ms-2 tansition-opacity">Cars</span> 
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.categories.index') }}" class="nav-link sidebar-menu-links @if (\Request::routeIs('admin.categories.*')) active @endif">
                                    <i class="fa-solid fa-list d-flex align-items-center"></i><span class="sidebar-menus-name ms-2 tansition-opacity">Categories</span> 
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <!-- Car Rental Management Menu end -->

        </ul>
        </div>
        <!-- sidebar menus end -->
    <div class="d-flex align-items-center px-3 py-3 bg-secondary sidebar-logout-menu position-absolute end-0 start-0 bottom-0">
            <div class="d-flex align-items-center dropdown-toggle cursor-pointer justify-center" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                @php
                    $user = auth()->user();
                @endphp
                @if (!empty($user->profile_pic))
                    <img src="{{ asset('storage/profile_images/' . $user->profile_pic) }}" alt="User Avatar" class="rounded-circle img-fluid auth-imgs me-2 cursor-pointer tansition-opacity object-fit-cover" style="width: 40px; height: 40px;">
                @else
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                        <i class="fa-solid fa-user text-white"></i>
                    </div>
                @endif
                <span class="d-block user-name text-nowrap cursor-pointer tansition-opacity text-white ms-2">{{ !empty($user->name) ? $user->name : '' }}</span>
            </div>
            <!-- ==== Profile list start ==== -->
            <ul class="user-dropdown-menu dropdown-menu dropdown-menu-end shadow inline-size-2 py-0 px-2">
                <li>
                    <a class="dropdown-item border-bottom d-flex align-items-center gap-2 fw-medium" href="{{ route('admin.user.profile.edit') }}">
                        <i class="bi bi-person-circle"></i>
                        <span>Profile</span> 
                    </a>
                </li>
                <li>
                    <a class="dropdown-item border-bottom d-flex align-items-center gap-2 fw-medium" href="{{ route('admin.change-password') }}">
                        <i class="fa-solid fa-key"></i>
                        <span>Change Password</span>
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item border-bottom d-flex align-items-center gap-2 fw-medium text-danger">
                            <i class="fas fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        </div>
    </div>
</div>