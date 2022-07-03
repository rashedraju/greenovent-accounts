<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCostRequest;
use App\Http\Requests\EditCostRequest;
use App\Models\ExternalCost;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class ExternalController extends Controller {
    // show external costs
    public function index( Project $project ) {
        $sheetHeader = null;
        $sheetData = null;
        $sheetFooter = null;

        if ( $project->external?->file && Storage::disk( 'uploads' )->exists( $project->external?->file->file ) ) {
            $reader = new Xlsx();
            $spreadsheet = $reader->load( 'public/uploads/' . $project->external->file->file );

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Html( $spreadsheet );
            $hdr = $writer->generateHTMLHeader();
            $sty = $writer->generateStyles( false ); // do not write <style> and </style>
            $newstyle = <<<EOF
            <style type='text/css'>
            $sty
            </style>
            EOF;
            $sheetHeader = preg_replace( '@</head>@', "$newstyle\n</head>", $hdr );
            $sheetData = $writer->generateHtmlAll();
            $sheetFooter = $writer->generateHTMLFooter();
        }

        return view( 'projects.external', ['project' => $project, 'sheetHeader' => $sheetHeader, 'sheetData' => $sheetData, 'sheetFooter' => $sheetFooter] );
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

        if ( $request->has( 'file' ) ) {
            $fname = time() . "_" . $request->file->getClientOriginalName();

            // store new file
            $filePath = $request->file( 'file' )->storeAs( 'external_files', $fname, 'uploads' );

            // delete previous file
            if ( isset( $externalCost->file->file ) && Storage::disk( 'uploads' )->exists( $externalCost->file->file ) ) {
                Storage::disk( 'uploads' )->delete( $externalCost->file->file );
            }

            // update file path
            $externalCost->file()->updateOrCreate( ['file' => $filePath] );
        } else {
            return back()->with( 'failed', "External file did't fount" );
        }

        return redirect()->route( 'projects.external.index', ['project' => $project] )->with( 'success', 'External cost updated' );
    }

    // delete external cost
    public function delete( Project $project, ExternalCost $externalCost ) {
        $externalCost->delete();

        return redirect()->route( 'projects.external.index', ['project' => $project] )->with( 'success', 'External cost deleted' );
    }
}
