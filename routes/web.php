<?php

use Abedin\WebInstaller\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'install', 'as' => 'installer.', 'middleware' => ['web']], function () {
    Route::get('/', [WelcomeController::class, 'welcome'])->name('well');
});