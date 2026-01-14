<?php

namespace Database\Seeders;

use App\Domain\Admin\User\Enums\GenderEnums;
use App\Domain\Admin\User\Enums\UserEnumsStatus;
use Domain\Admin\User\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminUser = [
            'first_name'  => 'Super',
            'last_name' =>'Admin',
            'email'  => 'sadmin@gmail.com',
            'password' => 'Admin@123',
            'gender' => GenderEnums::male,
            'mobile_no' => '01234567847',
            'status'  => UserEnumsStatus::active,
            'created_by' => 1,
            'remember_token'  => null,
            'created_at'  => now(),
            'updated_at'  => now(),
            'deleted_at'  => null,
        ];
        $superAdmin = User::updateOrCreate($superAdminUser);
        $superAdmin->assignRole(config('constants.super_admin_role_name'));
    }
}
