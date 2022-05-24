<?php

namespace App\Http\Controllers;

use App\Models\Accounts\AccountsBill;
use App\Models\Client;
use Illuminate\Http\Request;

class AccountsBillsController extends Controller {
    public function index() {
        $clients = Client::orderBy( 'id', 'desc' )->get();
        return view( 'accounts.bills.index', ['clients' => $clients] );
    }

    public function show( Client $client ) {
        if ( $client ) {
            $bills = AccountsBill::where( 'client_id', $client->id )->orderBy( 'id', 'desc' )->get();
            $totalInvoiceAmount = $bills->sum( fn( $bill ) => $bill->invoice_amount );
            $totalVat = $bills->sum( fn( $bill ) => $bill->vat );
            $totalGrossInvoiceValue = $bills->sum( fn( $bill ) => $bill->gross_invoice_value );
            $totalAit = $bills->sum( fn( $bill ) => $bill->ait );
            $totalCashSupposeToReceipt = $bills->sum( fn( $bill ) => $bill->cash_suppose_to_receipt );
            $total_cash_cheque_receipt = $bills->sum( fn( $bill ) => $bill->cash_cheque_receipt );
            $total_advance = $bills->sum( fn( $bill ) => $bill->advance );
            $total_discount = $bills->sum( fn( $bill ) => $bill->discount );
            $total_due = $bills->sum( fn( $bill ) => $bill->due );

            $data = [
                'client'                    => $client,
                'bills'                     => $bills,
                'total_invoice_amount'      => $totalInvoiceAmount,
                'total_vat'                 => $totalVat,
                'total_gross_invoice_value' => $totalGrossInvoiceValue,
                'total_ait'                 => $totalAit,
                'total_ait'                 => $totalCashSupposeToReceipt,
                'total_cash_cheque_receipt' => $total_cash_cheque_receipt,
                'total_advance'             => $total_advance,
                'total_discount'            => $total_discount,
                'total_due'                 => $total_due
            ];

            return view( 'accounts.bills.show', ['data' => $data] );

        }

        return redirect()->route( 'accounts.bills.index' )->with( 'failed', 'Bill records not found!' );
    }

    public function store( Request $request ) {
        $attrs = $request->validate( [
            'client_id'               => 'required|exists:clients,id',
            'date'                    => 'sometimes',
            'description'             => 'sometimes',
            'bill_no'                 => 'sometimes',
            'invoice_amount'          => 'sometimes',
            'vat'                     => 'sometimes',
            'gross_invoice_value'     => 'sometimes',
            'ait'                     => 'sometimes',
            'cash_suppose_to_receipt' => 'sometimes',
            'receipt_number'          => 'sometimes',
            'receipt_date'            => 'sometimes',
            'cash_cheque_receipt'     => 'sometimes',
            'advance'                 => 'sometimes',
            'discount'                => 'sometimes',
            'due'                     => 'sometimes'
        ] );

        if ( AccountsBill::create( $attrs ) ) {
            return back()->with( 'success', 'Bill record has been added.' );
        }

        return redirect()->route( 'accounts.bills.index' )->with( 'failed', 'Failed to add bill record!' );
    }

    public function update( AccountsBill $accountsBill, Request $request ) {
        $attrs = $request->validate( [
            'date'                    => 'sometimes',
            'description'             => 'sometimes',
            'bill_no'                 => 'sometimes',
            'invoice_amount'          => 'sometimes',
            'vat'                     => 'sometimes',
            'gross_invoice_value'     => 'sometimes',
            'ait'                     => 'sometimes',
            'cash_suppose_to_receipt' => 'sometimes',
            'receipt_number'          => 'sometimes',
            'receipt_date'            => 'sometimes',
            'cash_cheque_receipt'     => 'sometimes',
            'advance'                 => 'sometimes',
            'discount'                => 'sometimes',
            'due'                     => 'sometimes'
        ] );

        if ( $accountsBill->update( $attrs ) ) {
            return back()->with( 'success', 'Bill record has been updated.' );
        }

        return back()->with( 'failed', 'Failed to update bill record!' );
    }

    public function delete( AccountsBill $accountsBill ) {

        if ( $accountsBill->delete() ) {
            return back()->with( 'success', 'Bill record has been deleted.' );
        }

        return back()->with( 'failed', 'Failed to delete bill record!' );
    }
}
