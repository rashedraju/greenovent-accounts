<?php

namespace App\Http\Controllers;

use App\Models\Accounts\AccountsBill;
use App\Models\Client;
use Illuminate\Http\Request;

class AccountsBillsController extends Controller {
    public function index( $year, $month ) {
        $clients = Client::orderBy( 'id', 'desc' )->get();
        return view( 'accounts.bills.index', ['clients' => $clients, 'year' => $year, 'month' => $month] );
    }

    public function show( $year, $month, Client $client ) {
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
                'year'                      => $year,
                'month'                     => $month,
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
            'date'                    => 'nullable',
            'description'             => 'nullable',
            'bill_no'                 => 'nullable',
            'invoice_amount'          => 'nullable',
            'vat'                     => 'nullable',
            'gross_invoice_value'     => 'nullable',
            'ait'                     => 'nullable',
            'cash_suppose_to_receipt' => 'nullable',
            'receipt_number'          => 'nullable',
            'receipt_date'            => 'nullable',
            'cash_cheque_receipt'     => 'nullable',
            'advance'                 => 'nullable',
            'discount'                => 'nullable',
            'due'                     => 'nullable'
        ] );

        if ( AccountsBill::create( $attrs ) ) {
            return back()->with( 'success', 'Bill record has been added.' );
        }

        return redirect()->route( 'accounts.bills.index' )->with( 'failed', 'Failed to add bill record!' );
    }

    public function update( AccountsBill $accountsBill, Request $request ) {
        $attrs = $request->validate( [
            'date'                    => 'nullable',
            'description'             => 'nullable',
            'bill_no'                 => 'nullable',
            'invoice_amount'          => 'nullable',
            'vat'                     => 'nullable',
            'gross_invoice_value'     => 'nullable',
            'ait'                     => 'nullable',
            'cash_suppose_to_receipt' => 'nullable',
            'receipt_number'          => 'nullable',
            'receipt_date'            => 'nullable',
            'cash_cheque_receipt'     => 'nullable',
            'advance'                 => 'nullable',
            'discount'                => 'nullable',
            'due'                     => 'nullable'
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
