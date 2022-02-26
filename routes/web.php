<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get( '/', function () {
    return view( 'dashboard' );
} )->middleware( ['auth'] )->name( 'dashboard' );

// Employees Routes
Route::get( '/employees', [UsersController::class, 'index'] )->name( 'employees' );
Route::get( '/employees/create', [UsersController::class, 'create'] )->name( 'employees.create' );
Route::post( '/employees/create', [UsersController::class, 'store'] )->name( 'employees.create' );
Route::get( '/employees/{user}/edit', [UsersController::class, 'edit'] )->name( 'employees.edit' );
Route::put( '/employees/{user}/edit', [UsersController::class, 'update'] )->name( 'employees.edit' );
Route::delete( '/employees/{user}/delete', [UsersController::class, 'destroy'] )->name( 'employees.delete' );

// Projects Routes
Route::get( '/projects', [ProjectController::class, 'index'] )->name( 'projects' );
Route::get( '/projects/create', [ProjectController::class, 'create'] )->name( 'projects.create' );

// Authentication routes
require __DIR__ . '/auth.php';
