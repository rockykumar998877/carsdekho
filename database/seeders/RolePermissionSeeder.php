<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Domain\Admin\User\Models\Role;
use Illuminate\Support\Facades\DB;
use Domain\Admin\User\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // create permissions for user management
        $userManagementPermission = Permission::create(['name' => 'user-management']);
        Permission::create(['name' => 'role-list', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'role-create', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'role-edit', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'role-delete', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'role-show', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'role-view-all', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'permission-list', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'permission-create', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'permission-edit', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'permission-delete', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'permission-show', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'permission-view-all', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'user-list', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'user-create', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'user-delete', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'user-edit', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'user-show', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'user-view-all', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'profile-edit', 'parent_id' => $userManagementPermission->id]);
        Permission::create(['name' => 'change-password', 'parent_id' => $userManagementPermission->id]);

        $superAdmin = Role::create(['guard_name' => config('constants.guard_name'),'name' => config('constants.super_admin_role_name')]);
        $superAdmin->givePermissionTo(Permission::all());
        Role::create(['guard_name' => config('constants.guard_name'),'name' => config('constants.customer_role_name')]);
    }
}
