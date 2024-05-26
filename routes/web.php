<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia:: render('Home');
});

Route::get('/tw5', function () {
    return Inertia:: render('Home');
});

Route::get('/codw', function () {
    return Inertia:: render('Home');
});


