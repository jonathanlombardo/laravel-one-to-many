<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

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


Route::controller(GuestController::class)
  ->name('guest.')
  ->group(function () {
    Route::get('/', 'index')->name('index');
  });

Route::middleware(['auth', 'verified'])
  ->prefix('admin')
  ->name('admin.')
  ->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('projects', ProjectController::class);
  });

require __DIR__ . '/auth.php';
