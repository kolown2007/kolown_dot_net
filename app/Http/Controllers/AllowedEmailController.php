<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllowedEmail;

class AllowedEmailController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'email' => 'required|email|unique:allowed_emails',
        ]);

        // Create a new instance of AllowedEmail model
        $allowedEmail = new AllowedEmail;
        $allowedEmail->email = $request->email;

        // Save the data to the database
        $allowedEmail->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Email added successfully');
    }
}
