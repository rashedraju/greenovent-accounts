<?php

declare ( strict_types = 1 );

namespace App\Charts;

use App\Models\Project;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class ProjectsChart extends BaseChart {
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler( Request $request ): Chartisan {
        $year = now()->year;
        $projects = Project::whereYear( 'created_at', $year )->orWhere( 'status_id', 2 )->orderBy( 'id', 'desc' )->get();
        $labels = $projects->map( fn( $project ) => $project->name )->toArray();
        $values = $projects->map( fn( $project ) => $project->po_value )->toArray();

        return Chartisan::build()
            ->labels( $labels )
            ->dataset( '', $values );
    }
}
