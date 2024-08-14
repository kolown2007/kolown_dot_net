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



   
 Route::get('/', function () {
        return Inertia:: render('Home');
 });
    



Route::get('/', function () {
    return Inertia:: render('Home');
});

//kolown app home
Route::inertia('/app', 'App');

//kolown app ghost in the machine
// Route::inertia('/gitm', 'Gitm');


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


Route::get('/gitm', function (Request $request) {
    if (!$request->session()->has('googleUser')) {
        return redirect()->route('auth.google');
    }
    return Inertia::render('Gitm');
});


//google auth routes
Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);







