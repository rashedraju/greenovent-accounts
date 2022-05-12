<?php

namespace App\Http\Controllers;

use App\Models\CompanyInvestor;
use App\Models\CompanyLoanLender;
use App\Models\Credit;
use App\Models\CreditCategory;
use App\Models\Project;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Http\Request;

class RevenueController extends Controller {
    public function index() {
        // total credits of current year
        $year = now()->year;

        return view( 'revenue.index' );
    }

    public function show( Request $request ) {
        if ( $request->year && $request->month ) {
            // find credits of this date
            $year = $request->year;
            $month = $request->month;

            $projects = Project::whereYear( 'start_date', $year )->whereMonth( 'start_date', $month )->orderBy( 'id', 'desc' )->get();

            return view( 'revenue.show', compact( ['month', 'year', 'projects'] ) );
        }

        return redirect()->route( 'revenue.index' )->with( 'failed', 'Revenue records not found!' );
    }

    public function showOld( Request $request ) {
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

            return view( 'revenue.show', compact( ['month', 'year', 'creditRecords', 'creditCategories', 'projects', 'loanLenders', 'companyInvestors', 'receivedPersons', 'totalCreditsOfThisMonth', 'receivedPersonsOfThisMonth', 'transactionTypes', 'projectsOfThisMonth'] ) );
        }

        return redirect()->route( 'revenue.index' )->with( 'failed', 'Revenue records not found!' );
    }
}
