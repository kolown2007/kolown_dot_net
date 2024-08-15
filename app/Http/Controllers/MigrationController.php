<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class MigrationController extends Controller
{
    public function runMigrations()
    {
        // Run the migrations
        Artisan::call('migrate');

        // Get the output of the migration command
        $output = Artisan::output();

        // Return the output as a response
        return response()->json(['output' => $output]);
    }
}