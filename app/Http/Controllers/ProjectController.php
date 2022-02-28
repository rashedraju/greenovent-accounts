<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectStatus;

class ProjectController extends Controller {
    public function index() {
        // Project Data
        $projects = Project::orderBy( 'id', 'desc' )->paginate( 10 );
        $projectStatuses = ProjectStatus::all();
        $totalBudget = Project::getTotalBudget();

        // Budget Data
        $avgBudget = Project::getAvgBudget();
        $highestBudget = Project::getHighestBudget();
        $lowestBudget = Project::getLowestBudget();

        // Clients Data
        $clients = Client::orderBy( 'id', 'desc' )->get();

        return view( 'projects.index', compact( ['projects', 'projectStatuses', 'totalBudget', 'avgBudget', 'highestBudget', 'lowestBudget', 'clients'] ) );
    }

    public function create() {
        //
    }
}
