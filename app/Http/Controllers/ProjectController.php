<?php

namespace App\Http\Controllers;

use App\Exports\ExternalCostExport;
use App\Exports\InternalCostExport;
use App\Exports\VendorCostExport;
use App\Http\Requests\AddCostRequest;
use App\Http\Requests\AddProjectRequest;
use App\Http\Requests\AddVendorCostRequest;
use App\Http\Requests\EditCostRequest;
use App\Http\Requests\EditProjectRequest;
use App\Http\Requests\EditVendorCostRequest;
use App\Imports\ExternalCostImport;
use App\Imports\InternalCostImport;
use App\Imports\VendorCostImport;
use App\Models\Client;
use App\Models\ExternalCost;
use App\Models\InternalCost;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\ProjectType;
use App\Models\User;
use App\Models\VendorCost;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
            return redirect()->route( 'clients.contact.create', [$project->client, 'skipable' => true, 'skipto' => route( 'projects.show', $project )] )->with( 'success', 'Project added successfully' );
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

    // show internal costs
    public function internalCost( Project $project ) {
        return view( 'projects.internals.index', ['project' => $project] );
    }

    // Add internal cost
    public function addInternalCost( Project $project ) {
        return view( 'projects.internals.add', ['project' => $project] );
    }

    // Store internal cost
    public function storeInternalCost( AddCostRequest $request, Project $project ) {
        $attrs = $request->validated();

        $internalCost = InternalCost::create( $attrs );

        $project->intenalCosts()->save( $internalCost );

        return redirect()->route( 'projects.internals', ['project' => $project] )->with( 'success', 'Internal Cost Added' );
    }

    // import internal cost excel file
    public function importInternalCosts( Request $request, Project $project ) {
        $file = $request->file( 'internal_file' );
        Excel::import( new InternalCostImport(), $file );

        return redirect()->route( 'projects.internals', $project )->with( 'success', 'Internal Cost Added' );
    }

    // export internal cost to excel file
    public function exportInternalCosts( Project $project ) {
        $filename = $project->name . "_internal.xlsx";

        return Excel::download( new InternalCostExport(), $filename );
    }

    // update internal cost
    public function updateInternalCost( EditCostRequest $request, Project $project, InternalCost $internalCost ) {
        $attrs = $request->validated();
        $internalCost->update( $attrs );

        return redirect()->route( 'projects.internals', ['project' => $project] )->with( 'success', 'Internal cost updated' );
    }

    // delete internal cost
    public function deleteInternalCost( Project $project, InternalCost $internalCost ) {
        $internalCost->delete();

        return redirect()->route( 'projects.internals', ['project' => $project] )->with( 'success', 'Internal cost deleted' );
    }

    // show external costs
    public function externalCost( Project $project ) {
        return view( 'projects.externals.index', ['project' => $project] );
    }

    // Store external cost
    public function storeExternalCost( AddCostRequest $request, Project $project ) {
        $attrs = $request->validated();

        $externalCost = ExternalCost::create( $attrs );

        $project->externalCosts()->save( $externalCost );

        return redirect()->route( 'projects.externals', $project )->with( 'success', 'External Cost Added' );
    }

    // import external cost excel file
    public function importExternalCosts( Request $request, Project $project ) {
        $file = $request->file( 'external_file' );
        Excel::import( new ExternalCostImport(), $file );

        return redirect()->route( 'projects.externals', $project )->with( 'success', 'External Cost Added' );
    }

    // export exter cost to excel file
    public function exportExternalCosts( Project $project ) {
        $filename = $project->name . "_external.xlsx";

        return Excel::download( new ExternalCostExport(), $filename );
    }

    // update external cost
    public function updateExternalCost( EditCostRequest $request, Project $project, ExternalCost $externalCost ) {
        $attrs = $request->validated();
        $externalCost->update( $attrs );

        return redirect()->route( 'projects.externals', ['project' => $project] )->with( 'success', 'External cost updated' );
    }

    // delete external cost
    public function deleteExternalCost( Project $project, ExternalCost $externalCost ) {
        $externalCost->delete();

        return redirect()->route( 'projects.externals', ['project' => $project] )->with( 'success', 'External cost deleted' );
    }

    // show vendor costs
    public function vendorCosts( Project $project ) {
        return view( 'projects.vendors.index', ['project' => $project] );
    }

    // Store vendor cost
    public function storeVendorsCost( AddVendorCostRequest $request, Project $project ) {
        $attrs = $request->validated();

        $vendorCost = VendorCost::create( $attrs );

        $project->vendorCosts()->save( $vendorCost );

        return redirect()->route( 'projects.vendors', $project )->with( 'success', 'Vendor Cost Added' );
    }

    // import vendor cost excel file
    public function importVendorCosts( Request $request, Project $project ) {
        $file = $request->file( 'vendor_file' );
        Excel::import( new VendorCostImport(), $file );

        return redirect()->route( 'projects.vendors', $project )->with( 'success', 'Vendor Cost Added' );
    }

    // export vendor cost to excel file
    public function exportVendorCosts( Project $project ) {
        $filename = $project->name . "_vendor.xlsx";

        return Excel::download( new VendorCostExport(), $filename );
    }

    // update vendor cost
    public function updateVendorCost( EditVendorCostRequest $request, Project $project, VendorCost $vendorCost ) {
        $attrs = $request->validated();
        $vendorCost->update( $attrs );

        return redirect()->route( 'projects.vendors', ['project' => $project] )->with( 'success', 'Vendor cost updated' );
    }

    // delete external cost
    public function deleteVendorCost( Project $project, VendorCost $vendorCost ) {
        $vendorCost->delete();

        return redirect()->route( 'projects.vendors', ['project' => $project] )->with( 'success', 'Vendor cost deleted' );
    }
}
