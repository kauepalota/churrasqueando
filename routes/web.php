<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/barbecue', function () {
    return view('barbecue');
});

Route::get('/contactus', function() {
    return view('contactus');
});
