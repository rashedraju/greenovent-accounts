<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectContactPersonController extends Controller {
    public function store( Project $project, Request $request ) {
        $attr = $request->validate( [
            'name' => 'sometimes|string',
            'designation' => 'sometimes|string',
            'contact' => 'sometimes|string'
        ] );

        $project->contactPersons()->create( $attr );

        return redirect()->route( 'projects.show', $project )->with( 'success', 'Contact person added.' );
    }
}
