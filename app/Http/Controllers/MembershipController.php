<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MembershipController extends Controller
{
    public function sendVerificationCode(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        // Generate a 6-digit verification code
        $verificationCode = rand(100000, 999999);

        // Store the code and email in the session
        session([
            'verification_code' => $verificationCode,
            'verification_email' => $email,
        ]);

        // Send the verification code via email
        Mail::raw("Your verification code is: $verificationCode", function ($message) use ($email) {
            $message->to($email)
                    ->subject('Your Verification Code');
        });

        return response()->json(['success' => true]);
    }

    public function verifyCodeAndSubmit(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'verificationCode' => 'required|digits:6',
            'fullName' => 'required|string|max:255',
            'boatName' => 'required|string|max:255',
            'mmsi' => ['required', 'regex:/^[2-7]\d{8}$/'],
            'email' => 'required|email',
            'mobilePhone' => 'required|string|max:20',
        ]);

        $verificationCode = $request->input('verificationCode');
        $storedCode = session('verification_code');
        $storedEmail = session('verification_email');

        if ($verificationCode == $storedCode && $request->input('email') == $storedEmail) {
            // Verification successful
            // Collect the form data
            $membershipData = $request->only(['fullName', 'boatName', 'mmsi', 'email', 'mobilePhone']);

            // Send an email with the membership details
            Mail::send('emails.membership_application', $membershipData, function ($message) {
                $message->to('areaelectronica@protonmail.com') // Replace with your email
                        ->subject('New VIP SILVER Membership Application');
            });

            // Clear the verification code from the session
            session()->forget(['verification_code', 'verification_email']);

            return response()->json(['success' => true]);
        } else {
            // Verification failed
            return response()->json(['success' => false, 'message' => 'Incorrect verification code.']);
        }
    }
}

