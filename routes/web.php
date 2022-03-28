<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeePerformanceController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RolesAndPermissionsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WithdrawalsController;
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

Route::middleware( 'auth' )->group( function () {
    Route::get( '/', [DashboardController::class, 'index'] )->name( 'dashboard' );

    // Employees Routes
    Route::name( 'employees.' )->prefix( 'employees' )->group( function () {
        Route::get( '/', [UsersController::class, 'index'] )->name( 'index' );
        Route::get( '/create', [UsersController::class, 'create'] )->name( 'create' );
        Route::post( '/', [UsersController::class, 'store'] )->name( 'store' );
        Route::get( '/{user}', [UsersController::class, 'show'] )->name( 'show' );
        Route::get( '/{user}/edit', [UsersController::class, 'edit'] )->name( 'edit' );
        Route::put( '/{user}', [UsersController::class, 'update'] )->name( 'update' );
        Route::delete( '/{user}/delete', [UsersController::class, 'destroy'] )->name( 'delete' );
        // Employee performance
        Route::post( '/{user}/performances', [EmployeePerformanceController::class, 'store'] )->name( 'performances.store' );
    } );

    // Projects Routes
    Route::name( 'projects.' )->prefix( 'projects' )->group( function () {
        Route::get( '/', [ProjectController::class, 'index'] )->name( 'index' );
        Route::get( '/create', [ProjectController::class, 'create'] )->name( 'create' );
        Route::post( '/', [ProjectController::class, 'store'] )->name( 'store' );
        Route::get( '/{project}', [ProjectController::class, 'show'] )->name( 'show' );
        Route::get( '/{project}/edit', [ProjectController::class, 'edit'] )->name( 'edit' );
        Route::put( '/{project}', [ProjectController::class, 'update'] )->name( 'update' );
        Route::delete( '/{project}', [ProjectController::class, 'delete'] )->name( 'delete' );

        // Project Internal Costs
        Route::get( '/{project}/internals', [ProjectController::class, 'internalCost'] )->name( 'internals' );
        Route::get( '/{project}/internals/add', [ProjectController::class, 'addInternalCost'] )->name( 'internals.add' );
        Route::post( '/{project}/internals', [ProjectController::class, 'storeInternalCost'] )->name( 'internals.store' );
        Route::post( '/{project}/internals/import', [ProjectController::class, 'importInternalCosts'] )->name( 'internals.import' );
        Route::get( '/{project}/internals/export', [ProjectController::class, 'exportInternalCosts'] )->name( 'internals.export' );
        Route::put( '/{project}/internals/{internalCost}', [ProjectController::class, 'updateInternalCost'] )->name( 'internals.update' );
        Route::delete( '/{project}/internals/{internalCost}', [ProjectController::class, 'deleteInternalCost'] )->name( 'internals.delete' );

        // Project External Costs
        Route::get( '/{project}/externals', [ProjectController::class, 'externalCost'] )->name( 'externals' );
        Route::post( '/{project}/externals', [ProjectController::class, 'storeExternalCost'] )->name( 'externals.store' );
        Route::post( '/{project}/externals/import', [ProjectController::class, 'importExternalCosts'] )->name( 'externals.import' );
        Route::get( '/{project}/externals/export', [ProjectController::class, 'exportExternalCosts'] )->name( 'externals.export' );
        Route::put( '/{project}/externals/{externalCost}', [ProjectController::class, 'updateExternalCost'] )->name( 'externals.update' );
        Route::delete( '/{project}/externals/{externalCost}', [ProjectController::class, 'deleteExternalCost'] )->name( 'externals.delete' );

        // Project Vendor Costs
        Route::get( '/{project}/vendors', [ProjectController::class, 'vendorCosts'] )->name( 'vendors' );
        Route::post( '/{project}/vendors', [ProjectController::class, 'storeVendorsCost'] )->name( 'vendors.store' );
        Route::post( '/{project}/vendors/import', [ProjectController::class, 'importVendorCosts'] )->name( 'vendors.import' );
        Route::get( '/{project}/vendors/export', [ProjectController::class, 'exportVendorCosts'] )->name( 'vendors.export' );
        Route::put( '/{project}/vendors/{vendorCost}', [ProjectController::class, 'updateVendorCost'] )->name( 'vendors.update' );
        Route::delete( '/{project}/vendors/{vendorCost}', [ProjectController::class, 'deleteVendorCost'] )->name( 'vendors.delete' );
    } );

    // Clients Routes
    Route::name( 'clients.' )->prefix( 'clients' )->group( function () {
        Route::get( '/', [ClientsController::class, 'index'] )->name( 'index' );
        Route::get( '/add', [ClientsController::class, 'create'] )->name( 'create' );
        Route::post( '/', [ClientsController::class, 'store'] )->name( 'store' );
        Route::get( '/{client}', [ClientsController::class, 'show'] )->name( 'show' );
        Route::get( '/{client}/edit', [ClientsController::class, 'edit'] )->name( 'edit' );
        Route::put( '/{client}', [ClientsController::class, 'update'] )->name( 'update' );
        Route::delete( '/{client}', [ClientsController::class, 'destroy'] )->name( 'destroy' );

        // Add new Client Contact Person
        Route::get( '/{client}/contact/add', [ClientsController::class, 'createContactPerson'] )->name( 'contact.create' );
        Route::post( '/{client}/contact', [ClientsController::class, 'storeContactPerson'] )->name( 'contact.add' );

        // Edit Client Contact Person
        Route::get( '/{client}/client_contact_persons/{clientContactPerson}/edit', [ClientsController::class, 'editContactPerson'] )->name( 'contact.edit' );
        Route::put( '/{client}/client_contact_persons/{clientContactPerson}', [ClientsController::class, 'updateContactPerson'] )->name( 'contact.update' );
    } );

    // Accounts
    Route::name( 'accounts.' )->prefix( 'accounts' )->group( function () {
        // finances
        Route::name( 'finances.' )->prefix( 'finances' )->group( function () {
            Route::get( '/', [AccountsController::class, 'index'] )->name( 'index' );
            Route::get( '{year}', [AccountsController::class, 'show'] )->name( 'show' );
        } );

        // debit
        Route::name( 'expenses.' )->prefix( 'expenses' )->group( function () {
            Route::get( '/', [ExpensesController::class, 'index'] )->name( 'index' );
            Route::get( '/{year}/{month}', [ExpensesController::class, 'show'] )->name( 'show' );
            Route::post( '/', [ExpensesController::class, 'store'] )->name( 'store' );
            Route::put( '/{expense}', [ExpensesController::class, 'update'] )->name( 'update' );
            Route::delete( '/{expense}', [ExpensesController::class, 'destory'] )->name( 'delete' );

            // data import/export
            Route::get( '/{year}/{month}/export', [ExpensesController::class, 'export'] )->name( 'export' );
        } );

        // withdrawal
        Route::name( 'withdrawals.' )->prefix( 'withdrawals' )->group( function () {
            Route::get( '/', [WithdrawalsController::class, 'index'] )->name( 'index' );
            Route::get( '/{year}/{month}', [WithdrawalsController::class, 'show'] )->name( 'show' );
            Route::post( '/', [WithdrawalsController::class, 'store'] )->name( 'store' );
            Route::put( '/{withdrawal}', [WithdrawalsController::class, 'update'] )->name( 'update' );
            Route::delete( '/{withdrawal}', [WithdrawalsController::class, 'destory'] )->name( 'delete' );

            // data import/export
            Route::get( '/{year}/{month}/export', [WithdrawalsController::class, 'export'] )->name( 'export' );
        } );

        // credit
        Route::name( 'credits.' )->prefix( 'credits' )->group( function () {
            Route::get( '/', [CreditController::class, 'index'] )->name( 'index' );
            Route::get( '/{year}/{month}', [CreditController::class, 'show'] )->name( 'show' );
            Route::post( '/', [CreditController::class, 'store'] )->name( 'store' );
            Route::put( '/{credit}', [CreditController::class, 'update'] )->name( 'update' );
            Route::delete( '/{credit}', [CreditController::class, 'destory'] )->name( 'delete' );

            // data import/export
            Route::get( '/{year}/{month}/export', [CreditController::class, 'export'] )->name( 'export' );
        } );

    } );

    // Route access permissions
    Route::get( '/permissions', [RolesAndPermissionsController::class, 'index'] )->name( 'permissions.index' );
    Route::put( '/permissions/{permission}', [RolesAndPermissionsController::class, 'update'] )->name( 'permissions.update' );
} );

Route::fallback( function () {
    echo "404";
} );

// Authentication routes
require __DIR__ . '/auth.php';
