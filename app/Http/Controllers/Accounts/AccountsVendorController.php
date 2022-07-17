<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\AccountsVendor;
use App\Models\Project;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AccountsVendorController extends Controller {
    public function index( $year, $month ) {
        $accountsVendorsRecords = AccountsVendor::filter( array_merge( ['year' => $year, 'month' => $month], request( ['year', 'month', 'vendor_id', 'bill'] ) ) )->orderBy( 'id' )->get();

        $data = [
            'year'                   => $year,
            'month'                  => $month,
            'accountsVendorsRecords' => $accountsVendorsRecords,
            'vendors'                => Vendor::all(),
            'projects'               => Project::orderBy( 'id', 'desc' )->pluck( "name" )
        ];

        return view( 'accounts.vendors.index', ['data' => $data] );
    }

    public function createVendor( Request $request ) {
        $attrs = $request->validate( [
            'vendor_name'   => 'string|required',
            'contact_name'  => 'nullable|string',
            'contact_phone' => 'nullable|string'
        ] );

        Vendor::create( $attrs );

        return redirect()->back()->with( 'success', 'Vendor has been added.' );
    }

    public function store( Request $request ) {
        $attrs = $request->validate( [
            'vendor_id'    => 'required|exists:vendors,id',
            'description'  => 'nullable|string',
            'date_bill'    => 'nullable|date',
            'bill_no'      => 'nullable|string',
            'bill_amount'  => 'nullable',
            'date_adv'     => 'nullable|date',
            'advance'      => 'nullable',
            'date_pay'     => 'nullable|date',
            'paid'         => 'nullable',
            'project_name' => 'nullable|string'
        ] );

        // calculate due
        $billAmount = $attrs['bill_amount'] ?? 0;
        $advance = $attrs['advance'] ?? 0;
        $paid = $attrs['paid'] ?? 0;
        $due = $billAmount - $advance - $paid;
        $due = $due > 0 ? $due : 0;

        $attrs = array_merge( $attrs, [
            'due' => $due
        ] );

        AccountsVendor::create( array_filter( $attrs, fn( $attr ) => $attr !== null ) );

        return redirect()->back()->with( 'success', 'Record has been added.' );
    }

    public function update( $year, $month, AccountsVendor $accountsVendor, Request $request ) {
        $attrs = $request->validate( [
            'vendor_id'    => 'required|exists:vendors,id',
            'description'  => 'nullable|string',
            'date_bill'    => 'nullable|date',
            'bill_no'      => 'nullable|string',
            'bill_amount'  => 'nullable',
            'date_adv'     => 'nullable|date',
            'advance'      => 'nullable',
            'date_pay'     => 'nullable|date',
            'paid'         => 'nullable',
            'project_name' => 'nullable|string'
        ] );

        // calculate due
        $billAmount = $attrs['bill_amount'] ?? 0;
        $advance = $attrs['advance'] ?? 0;
        $paid = $attrs['paid'] ?? 0;
        $due = $billAmount - $advance - $paid;
        $due = $due > 0 ? $due : 0;

        $attrs = array_merge( $attrs, [
            'due' => $due
        ] );

        $accountsVendor->update( array_filter( $attrs, fn( $attr ) => $attr !== null ) );

        return redirect()->back()->with( 'success', 'Record has been updated.' );
    }
}
