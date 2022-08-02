<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| University Routes
|--------------------------------------------------------------------------
|
| Here is where you can register university routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "university" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'data'], function () {
    Route::resource('university', UniversityController::class)
        ->except([
            'show',
        ]);
    Route::resource('faculty', FacultyController::class)
        ->except([
            'show',
        ]);
    Route::resource('major', MajorController::class)
        ->except([
            'show',
        ]);
});

Route::group(['prefix' => 'temp'], function () {
    Route::get('/major', [MajorController::class, 'recycle'])
        ->name('major.recycle');
    Route::group(['prefix' => 'major'], function () {
        Route::get('/restore/{id}', [MajorController::class, 'restore'])
            ->name('major.restore');;
        Route::delete('/delete/{id}', [MajorController::class, 'delete']);
        Route::delete('/delete-all', [MajorController::class, 'deleteAll']);
    });
});