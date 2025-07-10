<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductAPIController;

Route::prefix('product')->group(function (): void {
    Route::post('create', [ProductAPIController::class, 'create']);
    Route::get('list', [ProductAPIController::class, 'list']);
    Route::get('{id}/get', [ProductAPIController::class, 'detail']);
    Route::put('{id}/update', [ProductAPIController::class, 'update']);
    Route::delete('{id}/delete', [ProductAPIController::class, 'delete']);
});
