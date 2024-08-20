<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\GitController;
use App\Http\Controllers\GITMcontroller;
use Carbon\Carbon;
use App\Http\Controllers\AllowedEmailController;
use App\Http\Controllers\MigrationController;
use App\Http\Controllers\WebScrapController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/storytoday', [MessageController::class, 'showCurrentStory']);

Route::get('/storymain', [MessageController::class, 'showMainStory']);

Route::get('/git-pull', [GitController::class, 'pull']);

Route::get('/gitm-data', [GITMcontroller::class, 'gitm']);

Route::post('/allowedemail', [AllowedEmailController::class, 'store']);

Route::get('/run-migrations', [MigrationController::class, 'runMigrations']);

Route::get('/scrape-headline', [WebScrapController::class, 'scrapeHeadline']);


Route::get('/date', function () {
    return Carbon::now()->toDateString();
});