<?php

use App\Http\Controllers\Api\DeforestationStoryUpdateApiController;
use App\Http\Controllers\Api\DeforestoryApiController;
use Illuminate\Support\Facades\Route;

Route::get('/deforestory', [DeforestoryApiController::class, 'index']);
Route::post('/deforestory', [DeforestoryApiController::class, 'store'])
    ->middleware('deforestory.token');
Route::post('/deforestory/sync', [DeforestoryApiController::class, 'sync'])
    ->middleware('deforestory.token');
Route::post('/deforestory/{deforestoryUuid}/updates/sync', [DeforestationStoryUpdateApiController::class, 'sync'])
    ->whereUuid('deforestoryUuid')
    ->middleware('deforestory.token');
