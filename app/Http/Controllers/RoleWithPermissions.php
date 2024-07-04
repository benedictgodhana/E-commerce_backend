<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleWithPermissions extends Controller
{
    public function getRolesWithPermissions()
    {
        // Fetch all roles with their associated permissions
        $rolesWithPermissions = Role::with('permissions')->get();

        // Transform the data to make it easier to work with
        $formattedRoles = $rolesWithPermissions->map(function ($role) {
            return [
                'name' => $role->name,
                'permissions' => $role->permissions->pluck('name')->toArray(),
            ];
        });

        return response()->json($formattedRoles);
    }
}
