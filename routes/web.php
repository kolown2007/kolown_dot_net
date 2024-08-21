<?php

use Illuminate\Support\Facades\Auth; // Add this line
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\GitController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\AllowedEmailController;


//HOME   
Route::get('/', function () {
    return Inertia:: render('Home');
});

//kolown app home
//Route::inertia('/app', 'App');


//GITM project
//endless love route
Route::inertia('/endlesslove', 'GITM/Endlesslove');
//mission control allowed email route
Route::get('missioncontrol/allowedemail', function (Request $request) {
    if (!$request->session()->has('googleUser')) {
        return redirect()->route('auth.google');
    }
    return Inertia::render('missioncontrol/Gitm_allowedemail');
});
//mission control route
Route::get('/missioncontrol', function (Request $request) {
    if (!$request->session()->has('googleUser')) {
        return redirect()->route('auth.google');
    }
    return Inertia::render('missioncontrol/Gitm');
});


//google auth routes
Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);


//TO BE REMOVED
//app messaging public
Route::post('/trigger',  [SmsController::class, 'send']);
//route for processing and altering the text
Route::get('/altertext', [OpenAIController::class, 'aiTextRevision']);
//ably auth token route
Route::get('/ablyauth', [SmsController::class, 'TokenRequest']);




