<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddInternalCostRequest;
use App\Http\Requests\AddProjectRequest;
use App\Http\Requests\EditProjectRequest;
use App\Models\Client;
use App\Models\InternalCost;
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

    // create new project
    public function create() {
        // todo: get business manager role users only
        $bussinessManagers = User::all();
        $clients = Client::all();
        $projectTypes = ProjectType::all();
        $projectStatuses = ProjectStatus::all();

        return view( 'projects.create', compact( ['bussinessManagers', 'clients', 'projectTypes', 'projectStatuses'] ) );
    }

    // store project
    public function store( AddProjectRequest $request ) {
        // fields
        $attrs = $request->validated();

        $project = Project::create( $attrs );

        if ( $project ) {
            return redirect()->route( 'clients.contact.create', $project->client )->with( 'success', 'Project added successfully' );
        }

        return redirect()->route( 'projects' )->with( 'failed', 'Failed to add project' );

    }

    // porject dashboard
    public function show( Project $project ) {
        return view( 'projects.show', ['project' => $project] );
    }

    // edit project details
    public function edit( Project $project ) {
        $bussinessManagers = User::all();
        $clients = Client::all();
        $projectTypes = ProjectType::all();
        $projectStatuses = ProjectStatus::all();

        return view( 'projects.edit', compact( ['project', 'bussinessManagers', 'clients', 'projectTypes', 'projectStatuses'] ) );
    }

    // update project details
    public function update( EditProjectRequest $request, Project $project ) {
        $attrs = $request->validated();

        $project->update( $attrs );

        return redirect()->route( 'projects' )->with( 'success', 'Project updated successfully' );
    }

    // delete project
    public function delete( Project $project ) {
        $project->delete();

        return redirect()->route( 'projects' )->with( 'success', 'Project Deleted' );
    }

    // Add internal cost
    public function addInternalCost(Project $project){
        return view('projects.internals.add', ['project' => $project]);
    }

    // Store internal cost
    public function storeInternalCost(AddInternalCostRequest $request, Project $project){
        $attrs = $request->validated();

        $internalCost = InternalCost::create($attrs);

        $project->intenalCosts->create($internalCost);

        return redirect()->route('projects.show', $project)->with('success', 'Internal Cost Added');
    }
}
