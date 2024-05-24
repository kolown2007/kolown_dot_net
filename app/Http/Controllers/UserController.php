<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return Inertia::render('Pages/Home', [
          'user' => $user
        ]);
    }
}