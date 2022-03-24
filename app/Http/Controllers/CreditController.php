<?php

namespace App\Http\Controllers;

use App\Exports\CreditsExport;
use App\Http\Requests\CreditAddRequest;
use App\Models\CompanyInvestor;
use App\Models\CompanyLoanLender;
use App\Models\Credit;
use App\Models\CreditCategory;
use App\Models\Project;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CreditController extends Controller {
    public function index() {
        return view( 'accounts.credits.index' );
    }

    public function show( Request $request ) {
        if ( $request->year && $request->month ) {
            // find credits of this date
            $year = $request->year;
            $month = $request->month;

            $creditRecords = Credit::filter( array_merge( ['year' => $year, 'month' => $month], request( ['user_id', 'category_id', 'loan_lender_id', 'investor_id', 'project_id', 'transaction_type_id'] ) ) )->get();

            // credit categories
            $creditCategories = CreditCategory::pluck( 'name', 'id' );

            // get projects
            $projects = Project::pluck( 'name', 'id' );

            // get loan lender
            $loanLenders = CompanyLoanLender::pluck( 'name', 'id' );

            // get company investors
            $companyInvestors = CompanyInvestor::pluck( 'name', 'id' );

            // get those persons who has credit permission
            // todo: add credit persion to users
            // now it will show all users
            $receivedPersons = User::pluck( 'name', 'id' );

            // get transaction types
            $transactionTypes = TransactionType::pluck( 'name', 'id' );

            // calculate total withdrawal of this month
            $totalCreditsOfThisMonth = $creditRecords->sum( fn( $credit ) => $credit->amount );

            // data for filter
            // recived persons of this month credits
            $receivedPersonsOfThisMonth = $creditRecords->pluck( 'receivedPerson.name', 'receivedPerson.id' );
            // projects of this month
            $projectsOfThisMonth = $creditRecords->pluck( 'project.name', 'project.id' );
            // transaction types

            return view( 'accounts.credits.show', compact( ['month', 'year', 'creditRecords', 'creditCategories', 'projects', 'loanLenders', 'companyInvestors', 'receivedPersons', 'totalCreditsOfThisMonth', 'receivedPersonsOfThisMonth', 'transactionTypes', 'projectsOfThisMonth'] ) );
        }

        return redirect()->route( 'accounts.credits.index' )->with( 'failed', 'Credit records not found!' );
    }

    // store credit record
    public function store( CreditAddRequest $request ) {
        $attributes = $request->validated();

        $attributes = array_merge( $attributes, [
            'modified' => now()
        ] );

        $creditRecord = Credit::create( $attributes );

        if ( $creditRecord ) {
            return redirect()->back()->with( 'success', 'Credit record added.' );
        }

        return redirect()->back()->with( 'failed', 'Failed to add credit record.' );
    }

    // update credit record
    public function update( Credit $credit, CreditAddRequest $request ) {
        $attributes = $request->validated();

        $attributes = array_merge( $attributes, [
            'modified' => now()
        ] );

        if ( $credit->update( $attributes ) ) {
            return redirect()->back()->with( 'success', "Credit record updated." );
        }

        return redirect()->back()->with( 'failed', "Credit record Failed to update." );

    }

    // delete credit record
    public function destory( Credit $credit ) {
        if ( $credit->delete() ) {
            return redirect()->back()->with( 'success', "Credit Record deleted." );
        }

        return redirect()->back()->with( 'failed', "Credit Record Failed to delete." );
    }

    // download credit records by year and month
    public function export( Request $request ) {
        if ( $request->year && $request->month ) {
            $year = $request->year;
            $month = $request->month;

            $fname = now()->month( $month )->format( 'F' ) . "_" . $year . "_credit_records.xlsx";

            return Excel::download( new CreditsExport( $year, $month ), $fname );
        }

        return redirect()->route( 'accounts.credits.index' )->with( 'failed', 'Credit records not found!' );
    }

}
