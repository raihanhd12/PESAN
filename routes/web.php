<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TrackerController;
use App\Http\Controllers\ReporterController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AdminReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ReporterController::class, 'create'])->name('reporter.index');
Route::post('/store/reporter', [ReporterController::class, 'store'])->name('reporter.store');

Route::get('/laporan', [ReportController::class, 'create'])->name('laporan.index');
Route::get('/laporan/dashboard', [ReportController::class, 'index'])->name('laporan.dashboard');
Route::post('/store/report', [ReportController::class, 'store'])->name('laporan.store');

Route::get('/admin/login', [UserController::class, 'index'])->name('admin.login');
Route::post('admin/login/auth', [UserController::class, 'login'])->name('admin.store');
Route::get('/admin/register', [UserController::class, 'formRegister'])->name('admin.formRegister');
Route::post('/admin/register/auth', [UserController::class, 'register'])->name('admin.register');
Route::get('/admin/logout', [UserController::class, 'logout'])->name('admin.logout');


Route::middleware(['auth'])->group(function (){

    Route::get('/admin/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/admin/report', AdminReportController::class);
    Route::resource('/admin/activity', ActivityController::class);
    Route::resource('/admin/tracker', TrackerController::class);

});