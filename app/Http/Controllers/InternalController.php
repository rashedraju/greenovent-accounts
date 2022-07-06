<?php

namespace App\Http\Controllers;

use App\Http\Requests\InternalCostRequest;
use App\Models\File;
use App\Models\InternalCost;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;

class InternalController extends Controller {
    // show internal costs
    public function index( Project $project ) {
        return view( 'projects.internal', ['project' => $project] );
    }

    // Store internal cost
    public function store( Project $project, InternalCostRequest $request ) {
        $request->validated();

        $internal = $project->internal()->create( $request->only( ['total', 'ait', 'note'] ) );

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

        $internalCost->update( $request->only( ['total', 'ait', 'note'] ) );

        return redirect()->route( 'projects.internal.index', ['project' => $project] )->with( 'success', 'internal cost updated' );
    }

    // delete internal cost
    public function delete( Project $project, InternalCost $internalCost ) {
        $internalCost->delete();

        return redirect()->route( 'projects.internal.index', ['project' => $project] )->with( 'success', 'internal cost deleted' );
    }

    // file management
    public function fileStore( Project $project, Request $request ) {
        $request->validate( [
            'file' => 'required'
        ] );

        $fname = time() . "_" . $request->file->getClientOriginalName();
        $filePath = $request->file( 'file' )->storeAs( 'internal_files', $fname, 'uploads' );

        $project->internal->file()->create( ['file' => $filePath] );

        return redirect()->back()->with( 'success', "Internal file added" );

    }

    // file management
    public function fileDelete( Project $project, File $file, Request $request ) {

        if ( FacadesFile::exists( public_path( "uploads/{$file->file}" ) ) ) {
            FacadesFile::delete( public_path( "uploads/{$file->file}" ) );

            $project->internal->file()->delete();

            return redirect()->back()->with( 'success', "Internal file deleted" );
        }

        return redirect()->back()->with( 'success', "Internal file not found" );

    }
}
