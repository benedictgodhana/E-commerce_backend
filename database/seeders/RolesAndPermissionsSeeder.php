<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Define permissions for customers
        $customerPermissions = [
            'view_products',
            'add_to_cart',
            'manage_cart',
            'checkout',
            'place_orders',
            'view_order_history',
            'track_orders',
            'manage_account',
            'submit_reviews_ratings',
            'access_customer_support',
        ];

        // Define permissions for admins
        $adminPermissions = [
            'manage_users',
            'manage_roles_permissions',
            'manage_vendors',
            'manage_products',
            'manage_orders',
            'manage_payments',
            'access_analytics_reports',
            'moderate_content',
            'manage_settings_configuration',
        ];

        // Define permissions for vendors
        $vendorPermissions = [
            'manage_products',
            'view_orders',
            'update_order_status',
            'manage_store_settings',
            'view_sales_analytics',
            'manage_inventory',
            'view_customer_information',
            'respond_to_customer_inquiries',
            'manage_discounts_promotions',
            'manage_storefront_appearance',
        ];

        // Define permissions for super admin
        $superAdminPermissions = [
            'manage_system_settings',
            'manage_administrators',
            'access_all_data',
            'manage_roles_permissions',
            'override_permissions',
            'manage_platform_features',
            'system_maintenance',
            'manage_billing_payments',
            'emergency_access',
            'audit_compliance',
        ];

        // Create roles and assign permissions
        $this->createRolePermissions('customer', $customerPermissions);
        $this->createRolePermissions('admin', $adminPermissions);
        $this->createRolePermissions('vendor', $vendorPermissions);
        $this->createRolePermissions('super admin', $superAdminPermissions);
    }

    private function createRolePermissions($roleName, $permissions)
    {
        // Create role
        $role = Role::create(['name' => $roleName]);

        // Create permissions and assign to the role
        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            $role->givePermissionTo($permission);
        }
    }


    
}
