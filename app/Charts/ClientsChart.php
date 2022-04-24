<?php

declare ( strict_types = 1 );

namespace App\Charts;

use App\Models\Client;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class ClientsChart extends BaseChart {
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler( Request $request ): Chartisan {
        $clients = Client::orderBy( 'id', 'desc' )->get();

        $labels = $clients->map( fn( $client ) => $client->company_name )->toArray();
        $sales = $clients->map( fn( $client ) => $client->salesThisYear() )->toArray();

        return Chartisan::build()
            ->labels( $labels )
            ->dataset( '', $sales );
    }
}
