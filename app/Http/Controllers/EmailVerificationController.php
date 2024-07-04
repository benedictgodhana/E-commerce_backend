<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationCode;
use App\Models\User; // Assuming you have a User model

class EmailVerificationController extends Controller
{
    public function requestEmailVerification(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255|exists:users,email',
        ]);

        // Generate a random verification code
        $verificationCode = mt_rand(100000, 999999);

        // Save the verification code in the user's record
        $user = User::where('email', $validatedData['email'])->first();
        $user->email_verification_code = $verificationCode;
        $user->save();

        // Send the verification code to the user's email
        Mail::to($validatedData['email'])->send(new EmailVerificationCode($verificationCode));

        // Return a response indicating success
        return response()->json(['message' => 'Email verification code sent successfully'], 200);
    }

    public function verifyEmail(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'email' => 'required|string|email|max:255|exists:users,email',
        'verification_code' => 'required|string|digits:6',
    ]);

    // Check if the verification code matches
    $user = User::where('email', $validatedData['email'])
                ->where('email_verification_code', $validatedData['verification_code'])
                ->first();

    if (!$user) {
        return response()->json(['error' => 'Invalid verification code'], 400);
    }

    // Update the verification_at column to mark the email as verified
    $user->email_verified_at = Carbon::now();
    $user->email_verification_code = null;
    $user->save();

    // Return a response indicating success
    return response()->json(['message' => 'Email verified successfully'], 200);
}
}
