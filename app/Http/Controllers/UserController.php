<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function getRole(Request $request)
    {
        // Check if user is authenticated
        if (Auth::check()) {
            // Get authenticated user
            $user = Auth::user();

            // Check if user has any roles
            if ($user->hasRole()) {
                // Return the first role name
                return response()->json(['role' => $user->getRoleNames()->first()]);
            } else {
                return response()->json(['role' => null]); // User has no roles
            }
        } else {
            return response()->json(['error' => 'Unauthenticated'], 401); // User is not authenticated
        }
    }

    public function getPermissions(Request $request)
    {
        // Check if user is authenticated
        if (Auth::check()) {
            // Get authenticated user
            $user = Auth::user();

            // Check if user has any permissions
            if ($user->hasAnyPermission()) {
                // Return all permissions
                return response()->json(['permissions' => $user->getAllPermissions()->pluck('name')]);
            } else {
                return response()->json(['permissions' => []]); // User has no permissions
            }
        } else {
            return response()->json(['error' => 'Unauthenticated'], 401); // User is not authenticated
        }
    }

    public function getUser()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Return the user data as a JSON response
        return response()->json([
            'user' => $user
        ]);
    }

}
