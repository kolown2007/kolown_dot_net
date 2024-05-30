<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SmsController;

Route::get('/', function () {
    return Inertia:: render('Home');
});


Route::inertia('/tw5', 'Home');

Route::post('/send-message',  [SmsController::class, 'send']);
Route::post('/trigger',  [SmsController::class, 'send']);







