<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create users and assign roles with permissions
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $this->assignRoleWithPermissions($admin, 'admin');

        $vendor = User::create([
            'name' => 'Vendor User',
            'email' => 'vendor@example.com',
            'password' => bcrypt('password'),
        ]);
        $this->assignRoleWithPermissions($vendor, 'vendor');

        $customer = User::create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
        ]);
        $this->assignRoleWithPermissions($customer, 'customer');

        $superAdmin = User::create([
            'name' => 'Super Admin User',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
        ]);
        $this->assignRoleWithPermissions($superAdmin, 'super admin');

        $this->command->info('Users seeded successfully.');
    }

    private function assignRoleWithPermissions($user, $roleName)
    {
        $role = Role::where('name', $roleName)->firstOrFail();
        $permissions = $role->permissions;

        $user->assignRole($role);
        $user->syncPermissions($permissions);
    }
}
