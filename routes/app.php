<?php

use Illuminate\Support\Facades\Route;

// Main application routes go here
Route::get('/', function () {
    return view('welcome'); // Change to your main app's home view or controller
});

// Add more routes as needed
