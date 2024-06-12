<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\MessageController;





Route::get('/', function () {
    return Inertia:: render('Home');
});


Route::inertia('/tw5', 'Home');
Route::inertia('/bruce', 'Bruce');


Route::post('/send-message',  [SmsController::class, 'send']);
Route::post('/trigger',  [SmsController::class, 'send']);

Route::get('/processmessage', [OpenAIController::class, 'readAndProcessFile']);

Route::get('/messagearchive', [MessageController::class, 'showMessage']);







