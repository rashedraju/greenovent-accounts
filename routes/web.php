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
Route::get( '/projects/create', [ProjectController::class, 'create'] )->name( 'projects.create' );
Route::post( '/projects', [ProjectController::class, 'store'] )->name( 'projects.store' );
Route::get( '/projects/{project}', [ProjectController::class, 'show'] )->name( 'projects.show' );
Route::get( '/projects/{project}/edit', [ProjectController::class, 'edit'] )->name( 'projects.edit' );
Route::put( '/projects/{project}', [ProjectController::class, 'update'] )->name( 'projects.update' );
Route::delete( '/projects/{project}', [ProjectController::class, 'delete'] )->name( 'projects.delete' );

// Project Internal Costs
Route::get( '/projects/{project}/internals', [ProjectController::class, 'internalCost'] )->name( 'projects.internals' );
Route::get( '/projects/{project}/internals/add', [ProjectController::class, 'addInternalCost'] )->name( 'projects.internals.add' );
Route::post( '/projects/{project}/internals', [ProjectController::class, 'storeInternalCost'] )->name( 'projects.internals.store' );
Route::put( '/projects/{project}/internals/{internalCost}', [ProjectController::class, 'updateInternalCost'] )->name( 'projects.internals.update' );
Route::delete( '/projects/{project}/internals/{internalCost}', [ProjectController::class, 'deleteInternalCost'] )->name( 'projects.internals.delete' );

// Project External Costs
Route::get( '/projects/{project}/externals', [ProjectController::class, 'externalCost'] )->name( 'projects.externals' );
Route::post( '/projects/{project}/externals', [ProjectController::class, 'storeExternalCost'] )->name( 'projects.externals.store' );
Route::put( '/projects/{project}/externals/{externalCost}', [ProjectController::class, 'updateExternalCost'] )->name( 'projects.externals.update' );
Route::delete( '/projects/{project}/externals/{externalCost}', [ProjectController::class, 'deleteExternalCost'] )->name( 'projects.externals.delete' );

// Project Vendor Costs
Route::get( '/projects/{project}/vendors', [ProjectController::class, 'vendorCosts'] )->name( 'projects.vendors' );
Route::post( '/projects/{project}/vendors', [ProjectController::class, 'storeVendorsCost'] )->name( 'projects.vendors.store' );
Route::put( '/projects/{project}/vendors/{vendorCost}', [ProjectController::class, 'updateVendorCost'] )->name( 'projects.vendors.update' );
Route::delete( '/projects/{project}/vendors/{vendorCost}', [ProjectController::class, 'deleteVendorCost'] )->name( 'projects.vendors.delete' );

// Clients Routes
Route::get( '/clients', [ClientsController::class, 'index'] )->name( 'clients' );
Route::get( '/clients/add', [ClientsController::class, 'create'] )->name( 'clients.create' );
Route::post( '/clients', [ClientsController::class, 'store'] )->name( 'clients.store' );
Route::get( '/clients/{client}', [ClientsController::class, 'show'] )->name( 'clients.show' );
Route::get( '/clients/{client}/edit', [ClientsController::class, 'edit'] )->name( 'clients.edit' );
Route::put( '/clients/{client}', [ClientsController::class, 'update'] )->name( 'clients.update' );
Route::delete( '/clients/{client}', [ClientsController::class, 'destroy'] )->name( 'clients.destroy' );

// Add new Client Contact Person
Route::get( '/clients/{client}/contact/add', [ClientsController::class, 'createContactPerson'] )->name( 'clients.contact.create' );
Route::post( '/clients/{client}/contact', [ClientsController::class, 'storeContactPerson'] )->name( 'clients.contact.add' );

// Edit Client Contact Person
Route::get( '/clients/{client}/client_contact_persons/{clientContactPerson}/edit', [ClientsController::class, 'editContactPerson'] )->name( 'clients.contact.edit' );
Route::put( '/clients/{client}/client_contact_persons/{clientContactPerson}', [ClientsController::class, 'updateContactPerson'] )->name( 'clients.contact.update' );

Route::fallback( function () {
    echo "404";
} );

// Authentication routes
require __DIR__ . '/auth.php';
