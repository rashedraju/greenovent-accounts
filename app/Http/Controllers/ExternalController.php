<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCostRequest;
use App\Http\Requests\EditCostRequest;
use App\Models\ExternalCost;
use App\Models\File;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;

class ExternalController extends Controller {
    // show external costs
    public function index( Project $project ) {

        return view( 'projects.external', ['project' => $project] );
    }

    // Store external cost
    public function store( AddCostRequest $request, Project $project ) {
        $request->validated();

        $external = $project->external()->create( $request->only( ['total', 'asf', 'vat', 'note'] ) );

        if ( $request->has( 'file' ) ) {
            $fname = time() . "_" . $request->file->getClientOriginalName();
            $filePath = $request->file( 'file' )->storeAs( 'external_files', $fname, 'uploads' );

            $external->file()->create( ['file' => $filePath] );
        } else {
            return back()->with( 'failed', "External file did't fount" );
        }

        return redirect()->route( 'projects.external.index', $project )->with( 'success', 'External Added' );
    }

    // update external cost
    public function update( EditCostRequest $request, Project $project, ExternalCost $externalCost ) {
        $request->validated();

        $externalCost->update( $request->only( ['total', 'asf', 'vat', 'note'] ) );

        return redirect()->route( 'projects.external.index', ['project' => $project] )->with( 'success', 'External cost updated' );
    }

    // delete external cost
    public function delete( Project $project, ExternalCost $externalCost ) {
        $externalCost->delete();

        return redirect()->route( 'projects.external.index', ['project' => $project] )->with( 'success', 'External cost deleted' );
    }

    // file management
    public function fileStore( Project $project, Request $request ) {
        $request->validate( [
            'file' => 'required'
        ] );

        $fname = time() . "_" . $request->file->getClientOriginalName();
        $filePath = $request->file( 'file' )->storeAs( 'external_files', $fname, 'uploads' );

        $project->external->file()->create( ['file' => $filePath] );

        return redirect()->back()->with( 'success', "external file added" );

    }

    // file management
    public function fileDelete( Project $project, File $file, Request $request ) {

        if ( FacadesFile::exists( public_path( "uploads/{$file->file}" ) ) ) {
            FacadesFile::delete( public_path( "uploads/{$file->file}" ) );

            $project->external->file()->delete();

            return redirect()->back()->with( 'success', "external file deleted" );
        }

        return redirect()->back()->with( 'success', "external file not found" );

    }
}
