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

 Route::get('/', function () {
        return Inertia:: render('Home');
 });
    
Route::get('/', function () {
    return Inertia:: render('Home');
});

//kolown app home
Route::inertia('/app', 'App');

//kolown app endless love
Route::inertia('/endlesslove', 'Endlesslove');

//app messaging public
Route::post('/trigger',  [SmsController::class, 'send']);

//route for the messages of the day
Route::get('/messagestoday', [MessageController::class, 'showMessage']);

//route for processing and altering the text
Route::get('/altertext', [OpenAIController::class, 'aiTextRevision']);

//git pull route
Route::get('/gitpull', [GitController::class, 'pull']);

//ably auth token route
Route::get('/ablyauth', [SmsController::class, 'TokenRequest']);




//mission control route
Route::get('/missioncontrol', function (Request $request) {
    if (!$request->session()->has('googleUser')) {
        return redirect()->route('auth.google');
    }
    return Inertia::render('missioncontrol/Gitm');
});


//mission control allowed email route
Route::get('missioncontrol/allowedemail', function (Request $request) {
    if (!$request->session()->has('googleUser')) {
        return redirect()->route('auth.google');
    }
    return Inertia::render('missioncontrol/Gitm_allowedemail');
});






//google auth routes
Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);







