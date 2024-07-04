<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationCode;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class VendorController extends Controller
{
   public function show($id)
{
    // Fetch vendor details based on the provided ID with its products
    $vendor = Vendor::with('products')->findOrFail($id);

    // Return the vendor details with its products as JSON response
    return response()->json($vendor);
}


public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'phoneNumber' => 'required|string|max:15',
        'shopName' => 'required|string|max:255',
        'shopType' => 'required|string|max:255',
        'shopDescription' => 'nullable|string',
        'businessLogo' => 'nullable|string',  // Handle file upload if necessary
    ]);

    // Create the user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'phone' => $request->phoneNumber,
    ]);

    // Assign the vendor role to the user
    $user->assignRole('vendor');

    // Create the vendor
    $vendor = Vendor::create([
        'user_id' => $user->id,
        'business_name' => $request->shopName,
        'logo' => $request->businessLogo,
        'type' => $request->shopType,
        'description' => $request->shopDescription,
    ]);

    // Generate a random verification code
    $verificationCode = mt_rand(100000, 999999);

    // Save the verification code in the user's record
    $user->email_verification_code = $verificationCode;
    $user->save();

    // Send the verification code to the user's email
    Mail::to($user->email)->send(new EmailVerificationCode($verificationCode));

    return response()->json(['message' => 'Vendor registered successfully. Please check your email for the verification code.']);
}
}
