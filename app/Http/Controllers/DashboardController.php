<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\SalesService;

class DashboardController extends Controller {
    public $salesService;

    public function __construct( SalesService $salesService ) {
        $this->salesService = $salesService;
    }

    public function index() {
        if ( auth()->user()->cannot( 'Dashboard' ) ) {
            abort( 403 );
        }

        $salesData = $this->salesService->sales();

        $onGoingProjects = Project::where( 'status_id', 2 )->orderBy( 'id', 'desc' )->get();

        $completedProjects = Project::where( 'status_id', 1 )->orderBy( 'id', 'desc' )->take( 5 )->get();

        $data = array_merge( [
            'onGoingProjects'   => $onGoingProjects,
            'completedProjects' => $completedProjects
        ], $salesData );

        return view( 'dashboard', ['data' => $data] );
    }
}
