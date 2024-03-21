<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\MapndataController;
use App\Http\Middleware\setLanguage;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/id');


Route::middleware([setLanguage::class])->group(function () {
    Route::group(['prefix' => '{lang}'], function () {
        Route::get('/', [IndexController::class, 'index'])->name('index');
        Route::get('/mapndata', [MapndataController::class, 'index'])->name('mapndata');
    });
});

