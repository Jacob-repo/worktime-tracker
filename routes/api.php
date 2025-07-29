<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\EmployeeController;
use App\Http\Controllers\Api\V1\WorkTimeController;
use App\Http\Controllers\Api\V1\WorkTimeSummaryController;

Route::prefix('v1')->group(function () {
    Route::post('/employees', [EmployeeController::class, 'store']);
    Route::post('/work-time', [WorkTimeController::class, 'store']);
    Route::get('/work-time/summary-day', [WorkTimeSummaryController::class, 'day']);
    Route::get('/work-time/summary-month', [WorkTimeSummaryController::class, 'month']);
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
