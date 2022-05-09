<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRequisitionRequest;
use App\Models\Project;
use App\Models\Requisition;
use App\Models\User;

class RequisitionsController extends Controller {
    public function index( Project $project ) {
        $projects = Project::pluck( 'name', 'id' );
        $users = User::pluck( 'name', 'id' );

        return view( 'projects.requisitions', ['projects' => $projects, 'users' => $users, 'project' => $project] );
    }

    public function store( Project $project, AddRequisitionRequest $request ) {
        $attrs = $request->validated();

        $requisitionItems = array_pop( $attrs );

        $requisition = Requisition::create( array_merge( $attrs, [
            'date'       => now(),
            'project_id' => $project->id
        ] ) );

        $requisition->items()->createMany( $requisitionItems );

        return back()->with( 'success', "Requisition added successfully" );
    }

    public function delete() {

    }
}
