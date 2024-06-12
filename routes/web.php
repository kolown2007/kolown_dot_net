<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\MessageController;


Route::get('/', function () {
    return Inertia:: render('Home');
});


Route::inertia('/bruce', 'Bruce');
Route::post('/trigger',  [SmsController::class, 'send']);

//route for the messages of the day
Route::get('/messagestoday', [MessageController::class, 'showMessage']);

//current story to be consumed by tradewinds
Route::get('/storytoday', [MessageController::class, 'showCurrentStory']);

//route for processing and altering the text
Route::get('/altertext', [OpenAIController::class, 'aiTextRevision']);





