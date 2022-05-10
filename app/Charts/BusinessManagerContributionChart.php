<?php

declare ( strict_types = 1 );

namespace App\Charts;

use App\Models\User;
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
        $managers = User::role( 'Bussiness Manager' )->get();

        $labels = $managers->pluck( 'name' )->toArray();
        $date = \Carbon\Carbon::now();
        $lastMonth = $date->subMonth()->format( 'm' );

        $data = $managers->map( fn( $manager ) => $manager->projects()->whereMonth( 'created_at', $lastMonth )->get()->sum( fn( $project ) => $project->po_value ) )->toArray();

        return Chartisan::build()
            ->labels( $labels )
            ->dataset( 'Contribution by Business Manager', $data );
    }
}
