<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InsightContoller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapndataController;
use App\Http\Middleware\checkSession;
use App\Http\Middleware\hasSession;
use App\Http\Middleware\setLanguage;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/id');
Route::get('/id/stadi2024', [InsightContoller::class, 'stadi2024'])->name('stadi2024');
Route::get('/en/stadi2024', [InsightContoller::class, 'stadi2024EN'])->name('stadi2024EN');


Route::middleware([setLanguage::class])->group(function () {
    Route::group(['prefix' => '{lang}'], function () {
        Route::get('/', [IndexController::class, 'index'])->name('index');
        Route::get('/mapndata', [MapndataController::class, 'index'])->name('mapndata');
        Route::get('/download', [DownloadController::class, 'index'])->name('downloads');

    });
});


Route::middleware([checkSession::class])->group(function () {
    Route::get('/cms/dashboard', [DashboardController::class, 'index']);

});

//redirect to dashboard if user has session to dashboard
Route::middleware([hasSession::class])->group(function () {
    Route::get('/cms/login', [LoginController::class, 'index']);
});

//url to logout session
Route::get('/cms/logout', function () {
    session()->flush();
    return redirect('/cms/login');
});


