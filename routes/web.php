<?php

use Abedin\WebInstaller\Controllers\PermissionController;
use Abedin\WebInstaller\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Abedin\WebInstaller\Controllers\RequirementController;

// welcome page routes here
Route::controller(WelcomeController::class)->group(function(){
    Route::get('/install', 'index')->name('installer.welcome.index');
    Route::get('/install/publish-config', 'publishConfig')->name('installer.publish-config');
});

Route::group(['prefix' => 'install', 'as' => 'installer.', 'middleware' => ['web', 'config_check']], function (){

    // requirement check page routes here
    Route::controller(PermissionController::class)->group(function(){
        Route::get('/check-permissions', 'index')->name('permission.index');
    });

    // requirement check page routes here
    Route::controller(RequirementController::class)->group(function(){
        Route::get('/check-requirments', 'index')->name('requerment.index');
    });
});
