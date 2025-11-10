<?php

use Abedin\WebInstaller\Controllers\InstallationController;
use Abedin\WebInstaller\Controllers\PermissionController;
use Abedin\WebInstaller\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Abedin\WebInstaller\Controllers\RequirementController;
use Abedin\WebInstaller\Controllers\UpdateController;

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

    // requirement check page routes here
    Route::controller(InstallationController::class)->group(function(){
        Route::get('/configure', 'index')->name('configure.index');
        Route::get('/app-final-installation', 'finalInstall')->name('app.final-install');
        Route::post('/app-configure/{index}', 'appConfigure')->name('app-configure.store');
        Route::post('/verify-purchase', 'purchaseVerify')->name('verify-perchase');
    });

    Route::get('/refresh-csrf-token', function() {
        return response()->json(['token' => csrf_token()]);
    })->name('new-csrf');
});

Route::group(['prefix' => 'update', 'as' => 'updater.', 'middleware' => ['web']], function (){
    // requirement check page routes here
    Route::controller(UpdateController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/verify-purchase-form', 'verifyForm')->name('verify');
        Route::post('/verify-purchase', 'purchaseVerify')->name('purcgase-verify');

        Route::get('/upload-file', 'uploadFile')->name('file-upload');
        Route::post('/update-file', 'updateFile')->name('file-update');
    });
});
