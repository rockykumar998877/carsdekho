<?php

return [
    'admin' => [
        [
            'label' => 'labels.dashboard',
            'route' => 'admin.dashboard.index',
            'icon' => 'fa-solid fa-gauge'
        ],
        [
            'label' => 'labels.user_management',
            'icon' => 'bi bi-person-gear',
            'children' => [
                [
                    'label' => 'labels.permissions',
                    'route' => 'admin.permissions.index',
                    'icon' => 'bi bi-shield-lock',
                    'permission' => 'permission-list'
                ],
                [
                    'label' => 'labels.roles',
                    'route' => 'admin.roles.index',
                    'icon' => 'bi bi-person-badge',
                    'permission' => 'role-list'
                ],
                [
                    'label' => 'labels.users',
                    'route' => 'admin.users.index',
                    'icon' => 'bi bi-person',
                    'permission' => 'user-list'
                ],
            ]
        ],
        [
            'label' => 'Car Rental Management',
            'icon' => 'fa-solid fa-car',
            'children' => [
                [
                    'label' => 'Bookings',
                    'route' => 'admin.bookings.index',
                    'icon' => 'fa-solid fa-calendar-check'
                ],
                [
                    'label' => 'Cars',
                    'route' => 'admin.cars.index',
                    'icon' => 'fa-solid fa-car-side'
                ],
                [
                    'label' => 'Categories',
                    'route' => 'admin.categories.index',
                    'icon' => 'fa-solid fa-list'
                ],
            ]
        ],
    ],
];
