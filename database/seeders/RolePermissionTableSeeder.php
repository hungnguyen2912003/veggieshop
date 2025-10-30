<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $staffRole = Role::where('name', 'staff')->first();

        $permissions = Permission::all();

        //Admin gets all permissions
        $adminRole->permissions()->sync($permissions->pluck('id')->toArray());

        //Staff gets limited permissions
        $staffPermissions = $permissions->whereIn('name', [
            'manage_contacts',
            'manage_products',
        ]);

        $staffRole->permissions()->sync($staffPermissions->pluck('id')->toArray());
    }
}
