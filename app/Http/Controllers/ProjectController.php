<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\ProjectType;
use App\Models\User;

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
        // todo: get business manager role users only
        $bussinessManagers = User::all();
        $clients = Client::all();
        $projectTypes = ProjectType::all();
        $projectStatuses = ProjectStatus::all();

        return view( 'projects.create', compact( ['bussinessManagers', 'clients', 'projectTypes', 'projectStatuses'] ) );
    }
}
