<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Admin\TypeController;
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

Route::middleware('auth')
  ->prefix('admin')
  ->name('admin.')
  ->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // PROJECTS ROUTES
    Route::resource('projects', ProjectController::class);

    // TYPES ROUTES
    Route::middleware('role.admin')->group(function () {
      Route::post('/types', [TypeController::class, 'store'])->name('types.store');
      Route::get('/types/create', [TypeController::class, 'create'])->name('types.create');
      Route::patch('/types/{type}', [TypeController::class, 'update'])->name('types.update');
      Route::delete('/types/{type}', [TypeController::class, 'destroy'])->name('types.destroy');
      Route::get('/types/{type}/edit', [TypeController::class, 'edit'])->name('types.edit');
    });
    Route::get('/types', [TypeController::class, 'index'])->name('types.index');
    Route::get('/types/{type}', [TypeController::class, 'show'])->name('types.show');

    // TECHNOLOGIES ROUTES
    Route::middleware('role.admin')->group(function () {
      Route::post('/technologies', [TechnologyController::class, 'store'])->name('technologies.store');
      Route::get('/technologies/create', [TechnologyController::class, 'create'])->name('technologies.create');
      Route::patch('/technologies/{technology}', [TechnologyController::class, 'update'])->name('technologies.update');
      Route::delete('/technologies/{technology}', [TechnologyController::class, 'destroy'])->name('technologies.destroy');
      Route::get('/technologies/{technology}/edit', [TechnologyController::class, 'edit'])->name('technologies.edit');
    });
    Route::get('/technologies', [TechnologyController::class, 'index'])->name('technologies.index');
    Route::get('/technologies/{technology}', [TechnologyController::class, 'show'])->name('technologies.show');


  });



require __DIR__ . '/auth.php';

// GET|HEAD        admin/types/create .......................................................... admin.types.create › Admin\TypeController@create  
// GET|HEAD        admin/types/create .......................................................... admin.types.create › Admin\TypeController@create  