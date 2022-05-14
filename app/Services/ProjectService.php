<?php

namespace App\Services;

use App\Models\Expense;
use App\Models\ExternalCost;
use App\Models\Project;

class ProjectService {

    /**
     * Projects sales, expense, revenue start
     *
     */

    // get sales amount by year
    public function getTotalSalesByYear( $year ) {
        return ExternalCost::whereYear( 'created_at', $year )->get()->sum( fn( $external ) => $external->total );
    }

    // get total sales amount by year and month
    public function getTotalSalesByYearAndMonth( $year, $month ) {
        return ExternalCost::whereYear( 'created_at', $year )->whereMonth( 'created_at', $month )->get()->sum( fn( $external ) => $external->total );
    }

    // get total expense of projects by year
    public function getTotalExpensesOfProjectsByYear( $year ) {
        return Project::whereYear( 'created_at', $year )->get()->sum( fn( $project ) => $project->totalExpense() );
    }

    // get total expense of projects by year and month
    public function getTotalExpensesOfProjectsByYearAndMonth( $year, $month ) {
        return Project::whereYear( 'created_at', $year )->whereMonth( 'created_at', $month )->get()->sum( fn( $project ) => $project->totalExpense() );
    }

    // get total gross profit of projects by year
    public function getTotalGrossProfitOfProjectsByYear( $year ) {
        return Project::whereYear( 'created_at', $year )->get()->sum( fn( $project ) => $project->grossProfit() );
    }

    // get total gross profit of projects by year and month
    public function getTotalGrossProfitOfProjectsByYearAndMonth( $year, $month ) {
        return Project::whereYear( 'created_at', $year )->whereMonth( 'created_at', $month )->get()->sum( fn( $project ) => $project->grossProfit() );
    }

    // get total due amount of projects by year
    public function getTotalDueAmountOfProjectsByYear( $year ) {
        return Project::whereYear( 'created_at', $year )->get()->sum( fn( $project ) => $project->due() );
    }

    // get total due amount of projects by year and month
    public function getTotalDueAmountOfProjectsByYearAndMonth( $year, $month ) {
        return Project::whereYear( 'created_at', $year )->whereMonth( 'created_at', $month )->get()->sum( fn( $project ) => $project->due() );
    }

    /*
 * Projects sales, expense, revenue end
 *
 */
}
