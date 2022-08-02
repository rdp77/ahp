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
Route::get('/', function () {
    return view('home');
})->name('home');
Route::post('/feedback', [FrontController::class, 'feedback'])
    ->name('feedback');
// Backend
Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')
        ->name('dashboard');
    Route::get('/log', 'log')
        ->name('dashboard.log');
    Route::get('/feedback', 'feedback')
        ->name('dashboard.feedback');
});
// Debug
Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});
// Server Monitor
Route::get('/server-monitor', [DashboardController::class, 'serverMonitor'])
    ->name('dashboard.server-monitor');
Route::prefix('server-monitor')->group(function () {
    Route::get('refresh', [MainController::class, 'serverMonitorRefresh'])
        ->name('dashboard.server-monitor.refresh');
    Route::get('refresh-all', [MainController::class, 'serverMonitorRefreshAll'])
        ->name('dashboard.server-monitor.refreshAll');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/data/users.php';
require __DIR__ . '/data/university.php';