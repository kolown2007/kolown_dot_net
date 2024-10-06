<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\GhostWriterMessageController;


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

//GHOST IN THE MACHINE PROJECT


//allowed email for ghost in the machine
Route::post('/allowedemail', [AllowedEmailController::class, 'store']);
Route::post('/updatelove', [LoveUpdate::class, 'updateLove']);

//GHOSTWRITER PROJECT
//scrape headline for ghostwriter projects currently rappler
Route::get('/scrape-headline', [WebScrapController::class, 'scrapeHeadline']);
//ghostwriter for generating fake stories
Route::get('/ghoststory', [GhostwriterController::class, 'ghoststory']);
//ghostwriter for generating fake stories cronjob, to be consumed by frontend
Route::get('/ghoststory2', [GhostwriterController::class, 'ghoststory2']);
//message submission
Route::post('/ghostwritermessage', [GhostWriterMessageController::class, 'store']);



//ACCESSORY ROUTES
Route::get('/date', function () {
    return Carbon::now()->toDateString();
});


//TELEGRAM_BOT ROUTES
Route::get('/kolown_bot', [TelegramBotController::class, 'sendMessage']);