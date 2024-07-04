<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assuming you have a User model

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|',
            'phoneNumber' => 'required|string|max:20',
            'gender' => 'required|string|in:Male,Female',
        ]);

        // Create a new user record in the database
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'phoneNumber' => $validatedData['phoneNumber'],
            'gender' => $validatedData['gender'],
        ]);

        // Return a response indicating success
        return response()->json(['message' => 'Registration successful'], 200);
    }
}
