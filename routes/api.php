<?php

use App\Http\Controllers\Api\CalendarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('calendar')->name('calendar.')->group(function () {
    Route::post('/', [CalendarController::class, 'store'])->name('store');
    Route::put('/{event}', [CalendarController::class, 'update'])->name('update');
    Route::delete('/{event}', [CalendarController::class, 'destroy'])->name('destroy');
    Route::prefix('{year}')->group(function () {
        Route::get('/', [CalendarController::class, 'year'])->name('year')->where('year', '[0-9]{4}');
        Route::prefix('{month}')->group(function () {
            Route::get('/', [CalendarController::class, 'month'])->name('month')->where('month', '[0-9]{1,2}');
        });
    });
});

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
