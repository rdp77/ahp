<?php

use App\Http\Controllers\University\FacultyController;
use App\Http\Controllers\University\MajorController;
use App\Http\Controllers\University\UniversityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Master Routes
|--------------------------------------------------------------------------
|
| Here is where you can register master routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "master" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'master'], function () {
    Route::resource('university', UniversityController::class)
        ->except([
            'show', 'create'
        ]);
    Route::resource('faculty', FacultyController::class)
        ->except([
            'show', 'create'
        ]);
    Route::resource('major', MajorController::class)
        ->except([
            'show', 'create'
        ]);
});

Route::group(['prefix' => 'temp'], function () {
    // University Recycle
    Route::controller(UniversityController::class)->group(function () {
        Route::get('/university', 'recycle')
            ->name('university.recycle');
        Route::group(['prefix' => 'university'], function () {
            Route::get('/restore/{id}', 'restore')
                ->name('university.restore');
            Route::delete('/delete/{id}', 'delete');
            Route::delete('/delete-all', 'deleteAll');
        });
    });
    // Faculty Recycle
    Route::controller(FacultyController::class)->group(function () {
        Route::get('/faculty', 'recycle')
            ->name('faculty.recycle');
        Route::group(['prefix' => 'faculty'], function () {
            Route::get('/restore/{id}', 'restore')
                ->name('faculty.restore');
            Route::delete('/delete/{id}', 'delete');
            Route::delete('/delete-all', 'deleteAll');
        });
    });
    // Major Recycle
    Route::controller(MajorController::class)->group(function () {
        Route::get('/major', 'recycle')
            ->name('major.recycle');
        Route::group(['prefix' => 'major'], function () {
            Route::get('/restore/{id}', 'restore')
                ->name('major.restore');
            Route::delete('/delete/{id}', 'delete');
            Route::delete('/delete-all', 'deleteAll');
        });
    });
});
