<?php

use App\Http\Controllers\University\FacultyController;
use App\Http\Controllers\University\MajorController;
use App\Http\Controllers\University\UniversityController;
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
    Route::get('/university-all', [UniversityController::class, 'list'])
        ->name('university.all');
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
    Route::get('/major', [MajorController::class, 'recycle'])
        ->name('major.recycle');
    Route::group(['prefix' => 'major'], function () {
        Route::get('/restore/{id}', [MajorController::class, 'restore'])
            ->name('major.restore');;
        Route::delete('/delete/{id}', [MajorController::class, 'delete']);
        Route::delete('/delete-all', [MajorController::class, 'deleteAll']);
    });
});