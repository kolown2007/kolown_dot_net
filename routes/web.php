<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SmsController;


Route::domain('www.bruce.kolown.net')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Bruce');
    });
});


Route::get('/', function () {
    return Inertia:: render('Home');
});


Route::inertia('/tw5', 'Home');
Route::inertia('/bruce', 'Bruce');


Route::post('/send-message',  [SmsController::class, 'send']);
Route::post('/trigger',  [SmsController::class, 'send']);







