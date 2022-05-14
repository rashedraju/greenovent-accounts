<?php

declare ( strict_types = 1 );

namespace App\Charts;

use App\Models\Project;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class BusinessManagerContributionChart extends BaseChart {
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler( Request $request ): Chartisan {
        $year = now()->year;
        $month = now()->month;

        $managers = Project::whereYear( 'created_at', $year )->whereMonth( 'created_at', $month )->get()->map( fn( $project ) => $project->manager );

        $labels = $managers->map( fn( $manager ) => $manager->name )->toArray();

        $data = $managers->map( fn( $manager ) => $manager->projects()->whereYear( 'created_at', $year )->whereMonth( 'created_at', $month )->get()->sum( fn( $project ) => $project->po_value ) )->toArray();

        return Chartisan::build()
            ->labels( $labels )
            ->dataset( 'Contribution by Business Manager', $data );
    }
}
