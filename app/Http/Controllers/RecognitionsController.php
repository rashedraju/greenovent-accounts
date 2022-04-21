<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRecognitionRequest;
use App\Models\Project;
use App\Models\Recognition;
use App\Models\User;

class RecognitionsController extends Controller {
    public function index( Project $project ) {
        $projects = Project::pluck( 'name', 'id' );
        $users = User::pluck( 'name', 'id' );

        return view( 'projects.recognitions', ['projects' => $projects, 'users' => $users, 'project' => $project] );
    }

    public function store( Project $project, AddRecognitionRequest $request ) {
        $attrs = $request->validated();

        $recognitionItems = array_pop( $attrs );

        $recognition = Recognition::create( array_merge( $attrs, [
            'date'       => now(),
            'project_id' => $project->id
        ] ) );

        $recognition->items()->createMany( $recognitionItems );

        return back()->with( 'success', "Recognition added successfully" );
    }

    public function delete() {

    }
}
