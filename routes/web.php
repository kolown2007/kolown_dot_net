<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia:: render('Home');
});

Route::post('/webhook', '\App\Http\Controllers\WebhookController@handleWebhook');
