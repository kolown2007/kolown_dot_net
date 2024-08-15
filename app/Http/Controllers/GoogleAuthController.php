<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\AllowedEmail;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();

          // Fetch allowed emails from the database
          $allowedEmails = AllowedEmail::pluck('email')->toArray();

            // Check if the authenticated user's email is in the allowed list
            if (in_array($googleUser->getEmail(), $allowedEmails)) {
                // Store user information in session or any other method you prefer
                $request->session()->put('googleUser', $googleUser);

                Log::info('User authenticated and session stored.', ['email' => $googleUser->getEmail()]);

                // Redirect to the intended route
                return redirect()->intended('/missioncontrol');
            } else {
                // Deny access if the email is not in the allowed list
                Log::warning('Access denied. Email not authorized.', ['email' => $googleUser->getEmail()]);
                return redirect('/gitm')->withErrors(['msg' => 'Access denied. Your email is not authorized.']);
            }
        } catch (Exception $e) {
            // Handle the error
            Log::error('Failed to authenticate with Google.', ['error' => $e->getMessage()]);
            return redirect('/')->withErrors(['msg' => 'Failed to authenticate with Google.']);
        }
    }
}