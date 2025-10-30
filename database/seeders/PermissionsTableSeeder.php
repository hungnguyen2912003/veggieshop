<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage_users',
            'manage_products',
            'manage_orders',
            'view_categories',
            'manage_contacts',
        ];

        foreach ($permissions as $permission) {
            \App\Models\Permission::create([
                'name' => $permission,
            ]);
        }
    }
}
