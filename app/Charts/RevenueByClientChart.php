<?php

declare ( strict_types = 1 );

namespace App\Charts;

use App\Models\Project;
use App\Services\ProjectService;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class RevenueByClientChart extends BaseChart {
    public $projectService;

    public function __construct( ProjectService $projectService ) {
        $this->projectService = $projectService;
    }

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler( Request $request ): Chartisan {
        $year = now()->year;
        $data = [];
        // $labels = Project::whereYear('created_at', $year)->map(fn($project) => $project->client->company_name)->unique()->toArray();
        $projects = Project::whereYear( 'created_at', $year )->get();
        foreach ( $projects as $project ) {
            $key = $project->client->company_name;
            array_key_exists( $key, $data ) ? $data[$key] += $project->grossProfit() : $data[$key] = $project->grossProfit();
        }

        return Chartisan::build()
            ->labels( array_keys( $data ) )
            ->dataset( 'Gross Porfit By Client', array_values( $data ) );
    }
}
