<?php

use App\Http\Controllers\StatementController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('/statement')->group(function () {

    Route::post('/', [StatementController::class, 'store']);
    Route::post('/{user}/confirm', [StatementController::class, 'confirm']);
    Route::post('/{user}/send', [StatementController::class, 'send']);

});

