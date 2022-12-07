<?php

use App\Http\Controllers\CalculateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Calculate Routes
|--------------------------------------------------------------------------
|
| Here is where you can register calculate routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "calculate" middleware group. Now create something great!
|
*/

Route::controller(CalculateController::class)->group(function () {
    Route::group(['prefix' => 'calculate'], function () {
        Route::post('/store', 'storeCalculate')
            ->name('calculate.create');
        Route::post('/data', 'calculate')
            ->name('calculate.data');
        Route::get('/', 'calculate')
            ->name('calculate');
        Route::get('/history', 'calculateHistory')
            ->name('calculate.history');
        Route::get('/history/{id}', 'calculateHistoryShow')
            ->name('calculate.history.show');
        Route::get('/criteria', 'calculateCriteria')
            ->name('calculate.criteria');
        Route::get('/alternative/{id}', 'calculateAlternative')
            ->name('calculate.alternative');
    });
});
