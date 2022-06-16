<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorCostRequest;
use App\Models\Project;
use App\Models\VendorCost;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class VendorController extends Controller {
    // show vendor costs
    public function index( Project $project ) {
        $sheetHeader = null;
        $sheetData = null;
        $sheetFooter = null;

        if ( $project->vendor?->file ) {
            $reader = new Xlsx();
            $spreadsheet = $reader->load( 'public/uploads/' . $project->vendor->file->file );

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

        return view( 'projects.vendor', ['project' => $project, 'sheetHeader' => $sheetHeader, 'sheetData' => $sheetData, 'sheetFooter' => $sheetFooter] );
    }

    // Store vendor cost
    public function store( Project $project, VendorCostRequest $request ) {
        $request->validated();

        $vendor = $project->vendor()->create( $request->only( ['total', 'due', 'note'] ) );

        if ( $request->has( 'file' ) ) {
            $fname = time() . "_" . $request->file->getClientOriginalName();
            $filePath = $request->file( 'file' )->storeAs( 'vendor_files', $fname, 'uploads' );

            $vendor->file()->create( ['file' => $filePath] );
        } else {
            return back()->with( 'failed', "vendor file did't found" );
        }

        return redirect()->route( 'projects.vendor.index', $project )->with( 'success', 'vendor Added' );
    }

    // update vendor cost
    public function update( Project $project, VendorCost $vendorCost, VendorCostRequest $request, ) {
        $request->validated();

        $vendorCost->update( $request->only( ['total', 'due', 'note'] ) );

        if ( $request->has( 'file' ) ) {
            $fname = time() . "_" . $request->file->getClientOriginalName();

            // store new file
            $filePath = $request->file( 'file' )->storeAs( 'vendor_files', $fname, 'uploads' );

            // delete old file
            if ( isset( $vendorCost->file->file ) && Storage::disk( 'uploads' )->exists( $vendorCost->file->file ) ) {
                Storage::disk( 'uploads' )->delete( $vendorCost->file->file );
            }

            // save new file path
            $vendorCost->file()->updateOrCreate( ['file' => $filePath] );
        }

        return redirect()->route( 'projects.vendor.index', ['project' => $project] )->with( 'success', 'vendor cost updated' );
    }

    // delete vendor cost
    public function delete( Project $project, VendorCost $vendorCost ) {
        $vendorCost->delete();

        return redirect()->route( 'projects.vendor.index', ['project' => $project] )->with( 'success', 'vendor cost deleted' );
    }
}
