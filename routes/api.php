<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\GitController;
use App\Http\Controllers\GITMcontroller;
use Carbon\Carbon;
use App\Http\Controllers\AllowedEmailController;
use App\Http\Controllers\GhostwriterController;
use App\Http\Controllers\MigrationController;
use App\Http\Controllers\WebScrapController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\ImageScrapController;
use App\Http\Controllers\LoveUpdate;
use App\Http\Middleware\SendTelegramMessage;

use App\Http\Controllers\TelegramBotController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//SERVER MAINTENACE
//migrations for database updates
Route::get('/run-migrations', [MigrationController::class, 'runMigrations']);
//git pull for server updates
Route::post('/git-pull', [GitController::class, 'pull']);
Route::get('/run-nodejs', [NodeController::class, 'runCommands']);

//FUNCTIONALITY ROUTES
//ably auth token route
Route::get('/ablyauth', [SmsController::class, 'TokenRequest']);
//pusher auth token route
Route::get('/pusherauth', [SmsController::class, 'PusherTokenRequest']);


//NEVERENDING STORY PROJECT
//current story for neverending story project
Route::get('/storytoday', [MessageController::class, 'showCurrentStory']);
//mainstory for neverending story project
Route::get('/storymain', [MessageController::class, 'showMainStory']);
//route for the messages of the day
Route::get('/messagestoday', [MessageController::class, 'showMessage']);


//GHOST IN THE MACHINE PROJECT
//json data for gitm assets
Route::get('/gitm-data', [GITMcontroller::class, 'gitm']);
//allowed email for ghost in the machine
Route::post('/allowedemail', [AllowedEmailController::class, 'store']);
Route::get('/leeum', [ImageScrapController::class, 'leeumimagescrapper']);
Route::post('/updatelove', [LoveUpdate::class, 'updateLove']);

//GHOSTWRITER PROJECT
//scrape headline for ghostwriter projects currently rappler
Route::get('/scrape-headline', [WebScrapController::class, 'scrapeHeadline']);
//ghostwriter for generating fake stories
Route::get('/ghoststory', [GhostwriterController::class, 'ghoststory']);
//ghostwriter for generating fake stories cronjob, to be consumed by frontend
Route::get('/ghoststory2', [GhostwriterController::class, 'ghoststory2']);



//ACCESSORY ROUTES
Route::get('/date', function () {
    return Carbon::now()->toDateString();
});


//TELEGRAM_BOT ROUTES
Route::get('/kolown_bot', [TelegramBotController::class, 'sendMessage']);