<?php

namespace App\Http\Controllers;

use App\Http\Requests\InternalCostRequest;
use App\Models\InternalCost;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class InternalController extends Controller {
    // show internal costs
    public function index( Project $project ) {
        return view( 'projects.internal', ['project' => $project] );
    }

    // Store internal cost
    public function store( Project $project, InternalCostRequest $request ) {
        $request->validated();

        $internal = $project->internal()->create( $request->only( ['total', 'note'] ) );

        if ( $request->has( 'file' ) ) {
            $fname = time() . "_" . $request->file->getClientOriginalName();
            $filePath = $request->file( 'file' )->storeAs( 'internal_files', $fname, 'uploads' );

            $internal->file()->create( ['file' => $filePath] );
        } else {
            return back()->with( 'failed', "internal file did't found" );
        }

        return redirect()->route( 'projects.internal.index', $project )->with( 'success', 'internal Added' );
    }

    // update internal cost
    public function update( Project $project, InternalCost $internalCost, InternalCostRequest $request, ) {
        $request->validated();

        $internalCost->update( $request->only( ['total', 'note'] ) );

        if ( $request->has( 'file' ) ) {
            $fname = time() . "_" . $request->file->getClientOriginalName();

            // store new file
            $filePath = $request->file( 'file' )->storeAs( 'internal_files', $fname, 'uploads' );

            // delete previous file
            if ( isset( $internalCost->file->file ) && Storage::disk( 'uploads' )->exists( $internalCost->file->file ) ) {
                Storage::disk( 'uploads' )->delete( $internalCost->file->file );
            }

            // save file path
            $internalCost->file()->update( ['file' => $filePath] );
        }

        return redirect()->route( 'projects.internal.index', ['project' => $project] )->with( 'success', 'internal cost updated' );
    }

    // delete internal cost
    public function delete( Project $project, InternalCost $internalCost ) {
        $internalCost->delete();

        return redirect()->route( 'projects.internal.index', ['project' => $project] )->with( 'success', 'internal cost deleted' );
    }
}
