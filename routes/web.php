<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Template\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Front End
Route::get('/', [FrontController::class, 'index'])
    ->name('home');
Route::post('/feedback', [FrontController::class, 'feedback'])
    ->name('feedback');
Route::get('/get-alternative', [FrontController::class, 'getAlternative'])
    ->name('get.alternative');
// Backend
Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')
        ->name('dashboard');
    Route::get('/log', 'log')
        ->name('dashboard.log');
    Route::get('/feedback', 'feedback')
        ->name('dashboard.feedback');
    Route::get('/criteria', 'criteria')
        ->name('dashboard.criteria');
    Route::get('/criteria/{id}', 'criteriaEdit')
        ->name('dashboard.criteria.edit');
    Route::patch('/criteria/{id}/update', 'criteriaUpdate')
        ->name('dashboard.criteria.update');
    Route::get('/alternative', 'alternative')
        ->name('dashboard.alternative');
    Route::get('/alternative/{id}', 'alternativeEdit')
        ->name('dashboard.alternative.edit');
    Route::patch('/alternative/{id}/update', 'alternativeUpdate')
        ->name('dashboard.alternative.update');
    Route::get('/weighting', 'weighting')
        ->name('dashboard.weighting');
    Route::get('/report', 'report')
        ->name('dashboard.report');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/data/calculate.php';
require __DIR__ . '/data/users.php';
require __DIR__ . '/data/activity.php';
require __DIR__ . '/data/master.php';
require __DIR__ . '/data/university.php';
