<?php

use App\Http\Controllers\Api\DeforestationStoryUpdateApiController;
use App\Http\Controllers\Api\DeforestoryApiController;
use Illuminate\Support\Facades\Route;

Route::get('/deforestory', [DeforestoryApiController::class, 'index']);
Route::post('/deforestory', [DeforestoryApiController::class, 'store'])
    ->middleware('deforestory.token');
Route::post('/deforestory/sync', [DeforestoryApiController::class, 'sync'])
    ->middleware('deforestory.token');
Route::post('/deforestory/sync/{uuid}', [DeforestationStoryUpdateApiController::class, 'sync'])
    ->whereUuid('uuid')
    ->middleware('deforestory.token');
