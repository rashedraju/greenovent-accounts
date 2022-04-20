<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRecognitionRequest;
use App\Models\Project;
use App\Models\Recognition;

class RecognitionsController extends Controller {
    public function index( Project $project ) {
        $projects = Project::pluck( 'name', 'id' );

        return view( 'projects.recognitions', ['projects' => $projects, 'project' => $project] );
    }

    public function store( Project $project, AddRecognitionRequest $request ) {
        $attrs = $request->validated();

        $recognitionItems = array_pop( $attrs );

        $recognition = Recognition::create( [
            'date' => now(),
            'user_id' => auth()->user()->id,
            'project_id' => $project->id,
        ] );

        $recognition->items()->createMany( $recognitionItems );

        return back()->with( 'success', "Recognition added successfully" );
    }

    public function delete() {

    }
}
