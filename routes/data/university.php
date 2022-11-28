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
    Route::get('faculty', [FacultyController::class, 'dataFaculty'])
        ->name('data.faculty.index');
    Route::get('faculty/edit/{id}', [FacultyController::class, 'editDataFaculty'])
        ->name('data.faculty.edit');
    Route::patch('faculty/update/{id}', [FacultyController::class, 'updateDataFaculty'])
        ->name('data.faculty.update');
    Route::get('faculty/create', [FacultyController::class, 'createDataFaculty'])
        ->name('data.faculty.create');
    Route::post('faculty', [FacultyController::class, 'storeDataFaculty'])
        ->name('data.faculty.store');
    Route::delete('faculty/{id}', [FacultyController::class, 'destroyDataFaculty'])
        ->name('data.faculty.destroy');

    Route::get('major', [MajorController::class, 'dataMajor'])
        ->name('data.major.index');
    Route::get('major/edit/{id}', [MajorController::class, 'editDataMajor'])
        ->name('data.major.edit');
    Route::patch('major/update/{id}', [MajorController::class, 'updateDataMajor'])
        ->name('data.major.update');
    Route::get('major/create', [MajorController::class, 'createDataMajor'])
        ->name('data.major.create');
    Route::post('major', [MajorController::class, 'storeDataMajor'])
        ->name('data.major.store');
    Route::delete('major/{id}', [MajorController::class, 'destroyDataMajor'])
        ->name('data.major.destroy');
});
