<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\GitController;
use App\Http\Controllers\GITMcontroller;
use Carbon\Carbon;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/storytoday', [MessageController::class, 'showCurrentStory']);

Route::get('/storymain', [MessageController::class, 'showMainStory']);

Route::get('/git-pull', [GitController::class, 'pull']);

Route::get('/gitm-data', [GITMcontroller::class, 'gitm']);


Route::get('/date', function () {
    return Carbon::now()->toDateString();
});