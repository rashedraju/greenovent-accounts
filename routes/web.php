<?php

use App\Http\Controllers\AccountsBillsController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AccountsExpensesController;
use App\Http\Controllers\ApprovalsController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositsController;
use App\Http\Controllers\EmployeeLeaveController;
use App\Http\Controllers\EmployeePerformanceController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ExternalController;
use App\Http\Controllers\InternalController;
use App\Http\Controllers\ProjectBillController;
use App\Http\Controllers\ProjectContactPersonController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RequisitionsController;
use App\Http\Controllers\RolesAndPermissionsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VendorController;
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

    // Employee Leave
    Route::name( 'leave.' )->prefix( 'leave' )->group( function () {
        Route::get( '/create', [EmployeeLeaveController::class, 'create'] )->name( 'create' );
        Route::post( '/', [EmployeeLeaveController::class, 'store'] )->name( 'store' );
        Route::put( '/{employeeLeave}', [EmployeeLeaveController::class, 'update'] )->name( 'update' );
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

        // Project External Cost
        Route::get( '/{project}/external', [ExternalController::class, 'index'] )->name( 'external.index' );
        Route::post( '/{project}/external', [ExternalController::class, 'store'] )->name( 'external.store' );
        Route::put( '/{project}/external/{externalCost}', [ExternalController::class, 'update'] )->name( 'external.update' );
        Route::delete( '/{project}/external/{externalCost}', [ExternalController::class, 'delete'] )->name( 'external.delete' );

        // Project Internal Cost
        Route::get( '/{project}/internal', [InternalController::class, 'index'] )->name( 'internal.index' );
        Route::post( '/{project}/internal', [InternalController::class, 'store'] )->name( 'internal.store' );
        Route::put( '/{project}/internal/{internalCost}', [InternalController::class, 'update'] )->name( 'internal.update' );
        Route::delete( '/{project}/internal/{internalCost}', [InternalController::class, 'delete'] )->name( 'internal.delete' );

        // Project Internal Cost
        Route::get( '/{project}/vendor', [VendorController::class, 'index'] )->name( 'vendor.index' );
        Route::post( '/{project}/vendor', [VendorController::class, 'store'] )->name( 'vendor.store' );
        Route::put( '/{project}/vendor/{vendorCost}', [VendorController::class, 'update'] )->name( 'vendor.update' );
        Route::delete( '/{project}/vendor/{vendorCost}', [VendorController::class, 'delete'] )->name( 'vendor.delete' );

        // Project Requisitions
        Route::get( '/{project}/requisitions', [RequisitionsController::class, 'index'] )->name( 'requisitions.index' );
        Route::post( '/{project}/requisitions', [RequisitionsController::class, 'store'] )->name( 'requisitions.store' );

        // Project Bill
        Route::get( '/{project}/bill', [ProjectBillController::class, 'index'] )->name( 'bill.index' );
        Route::post( '/{project}/bill', [ProjectBillController::class, 'store'] )->name( 'bill.store' );
        Route::put( '/{project}/bill/{bill}', [ProjectBillController::class, 'update'] )->name( 'bill.update' );
        Route::delete( '/{project}/bill/{bill}', [ProjectBillController::class, 'delete'] )->name( 'bill.delete' );

        // Project Contact Person
        Route::post( '{project}/contact', [ProjectContactPersonController::class, 'store'] )->name( 'contact.store' );
    } );

    Route::name( 'bills.' )->prefix( 'bills' )->group( function () {
        Route::get( '/', [BillController::class, 'index'] )->name( 'index' );
        Route::get( '/{bill}', [BillController::class, 'show'] )->name( 'show' );
    } );

    Route::name( 'expenses.' )->prefix( 'expenses' )->group( function () {
        Route::get( '/', [ExpensesController::class, 'index'] )->name( 'index' );
        Route::get( '/{year}/{month}', [ExpensesController::class, 'show'] )->name( 'show' );
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

        // Client Contact Person
        Route::get( '/{client}/client_contact_persons/add', [ClientsController::class, 'createContactPerson'] )->name( 'contact.create' );
        Route::post( '/{client}/client_contact_persons', [ClientsController::class, 'storeContactPerson'] )->name( 'contact.add' );
        Route::get( '/{client}/client_contact_persons/{clientContactPerson}/edit', [ClientsController::class, 'editContactPerson'] )->name( 'contact.edit' );
        Route::put( '/{client}/client_contact_persons/{clientContactPerson}', [ClientsController::class, 'updateContactPerson'] )->name( 'contact.update' );
    } );

    // Accounts
    Route::name( 'accounts.' )->prefix( 'accounts' )->group( function () {
        // finances
        Route::name( 'finances.' )->prefix( 'finances' )->group( function () {
            Route::get( '/', [AccountsController::class, 'index'] )->name( 'index' );
            Route::get( '{year}/{month}', [AccountsController::class, 'show'] )->name( 'show' );
        } );

        // debit
        Route::name( 'expenses.' )->prefix( 'expenses' )->group( function () {
            Route::get( '/', [AccountsExpensesController::class, 'index'] )->name( 'index' );
            Route::get( '/{year}/{month}', [AccountsExpensesController::class, 'show'] )->name( 'show' );
            Route::post( '/', [AccountsExpensesController::class, 'store'] )->name( 'store' );
            Route::put( '/{expense}', [AccountsExpensesController::class, 'update'] )->name( 'update' );
            Route::delete( '/{expense}', [AccountsExpensesController::class, 'destory'] )->name( 'delete' );

            // data import/export
            Route::get( '/{year}/{month}/export', [AccountsExpensesController::class, 'export'] )->name( 'export' );
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

        // deposits
        Route::name( 'deposits.' )->prefix( 'deposits' )->group( function () {
            Route::get( '/', [DepositsController::class, 'index'] )->name( 'index' );
            Route::get( '/{year}/{month}', [DepositsController::class, 'show'] )->name( 'show' );
            Route::post( '/', [DepositsController::class, 'store'] )->name( 'store' );
            Route::put( '/{deposit}', [DepositsController::class, 'update'] )->name( 'update' );
            Route::delete( '/{deposit}', [DepositsController::class, 'destory'] )->name( 'delete' );

            // data import/export
            Route::get( '/{year}/{month}/export', [DepositsController::class, 'export'] )->name( 'export' );
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

        // bills
        Route::name( 'bills.' )->prefix( 'bills' )->group( function () {
            Route::get( '/', [AccountsBillsController::class, 'index'] )->name( 'index' );
        } );
    } );

    // Route access permissions
    Route::get( '/permissions', [RolesAndPermissionsController::class, 'index'] )->name( 'permissions.index' );
    Route::put( '/permissions/{permission}', [RolesAndPermissionsController::class, 'update'] )->name( 'permissions.update' );

    // Approvals
    Route::get( '/approvals', [ApprovalsController::class, 'index'] )->name( 'approvals.index' );
    Route::get( '/approvals/{approval}', [ApprovalsController::class, 'show'] )->name( 'approvals.show' );
    Route::put( '/approvals/{approval}', [ApprovalsController::class, 'update'] )->name( 'approvals.update' );
} );

// Route::fallback( function () {
//     echo "404";
// } );

// Authentication routes
require __DIR__ . '/auth.php';
