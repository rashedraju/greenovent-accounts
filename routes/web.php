<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProjectController;
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
Route::post( '/employees', [UsersController::class, 'store'] )->name( 'employees.store' );
Route::get( '/employees/{user}', [UsersController::class, 'show'] )->name( 'employees.show' );
Route::get( '/employees/{user}/edit', [UsersController::class, 'edit'] )->name( 'employees.edit' );
Route::put( '/employees/{user}', [UsersController::class, 'update'] )->name( 'employees.update' );
Route::delete( '/employees/{user}/delete', [UsersController::class, 'destroy'] )->name( 'employees.delete' );

// Projects Routes
Route::get( '/projects', [ProjectController::class, 'index'] )->name( 'projects' );

// Clients Routes
Route::get( '/clients', [ClientsController::class, 'index'] )->name( 'clients' );
Route::get( '/clients/add', [ClientsController::class, 'create'] )->name( 'clients.create' );
Route::post( '/clients', [ClientsController::class, 'store'] )->name( 'clients.store' );
Route::get( '/clients/{client}', [ClientsController::class, 'show'] )->name( 'clients.show' );

// Authentication routes
require __DIR__ . '/auth.php';
