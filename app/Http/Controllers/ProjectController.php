<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProjectRequest;
use App\Http\Requests\EditProjectRequest;
use App\Models\BillType;
use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\ProjectType;
use App\Models\User;

class ProjectController extends Controller {
    public function index() {
        // Project Data
        $projects = Project::orderBy( 'id', 'desc' )->get();
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

    // porject dashboard
    public function show( Project $project ) {
        // get project statuses
        $projectStatuses = ProjectStatus::all();

        // bill types
        $billTypes = BillType::all();

        return view( 'projects.show', compact( ['project', 'projectStatuses', 'billTypes'] ) );
    }

    // create new project
    public function create() {
        // get bussiness managers
        $bussinessManagers = User::role( 'Bussiness Manager' )->get();

        // get clients
        $clients = Client::all();

        // get project types
        $projectTypes = ProjectType::all();

        // get project statuses
        $projectStatuses = ProjectStatus::all();

        // bill types
        $billTypes = BillType::all();

        return view( 'projects.create', compact( ['bussinessManagers', 'clients', 'projectTypes', 'projectStatuses', 'billTypes'] ) );
    }

    // store project
    public function store( AddProjectRequest $request ) {
        // fields
        $attrs = $request->validated();

        $project = Project::create( $attrs );

        return redirect()->route( 'accounts-manager.client', ['user' => $project->business_manager_id, 'client' => $project->client->id] )->with( 'success', 'Project added successfully' );
    }

    // edit project details
    public function edit( Project $project ) {
        // get bussiness managers
        $bussinessManagers = User::role( 'Bussiness Manager' )->get();

        // get clients
        $clients = Client::all();

        // get project types
        $projectTypes = ProjectType::all();

        // get project statuses
        $projectStatuses = ProjectStatus::all();

        // bill types
        $billTypes = BillType::all();

        return view( 'projects.edit', compact( ['project', 'bussinessManagers', 'clients', 'projectTypes', 'projectStatuses', 'billTypes'] ) );
    }

    // update project details
    public function update( EditProjectRequest $request, Project $project ) {
        $attrs = $request->validated();

        $project->update( $attrs );

        return redirect()->route( 'projects.show', $project )->with( 'success', 'Project updated successfully' );
    }

    // delete project
    public function delete( Project $project ) {
        $project->delete();

        return redirect()->route( 'projects.index' )->with( 'success', 'Project Deleted' );
    }
}
