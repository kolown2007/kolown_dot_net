<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\MessageController;



   
    Route::get('/', function () {
        return Inertia:: render('Home');
    });
    



Route::get('/', function () {
    return Inertia:: render('Home');
});

//kolown app home
Route::inertia('/app', 'Home');

Route::post('/trigger',  [SmsController::class, 'send']);

//route for the messages of the day
Route::get('/messagestoday', [MessageController::class, 'showMessage']);


//route for processing and altering the text
Route::get('/altertext', [OpenAIController::class, 'aiTextRevision']);





