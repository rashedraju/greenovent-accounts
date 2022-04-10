<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorCostRequest;
use App\Models\Project;
use App\Models\VendorCost;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller {
    // show vendor costs
    public function index( Project $project ) {
        return view( 'projects.vendor', ['project' => $project] );
    }

    // Store vendor cost
    public function store( Project $project, VendorCostRequest $request ) {
        $request->validated();

        $vendor = $project->vendor()->create( $request->only( ['total', 'note'] ) );

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

        $vendorCost->update( $request->only( ['total', 'note'] ) );

        if ( $request->has( 'file' ) ) {
            $fname = time() . "_" . $request->file->getClientOriginalName();

            // store new file
            $filePath = $request->file( 'file' )->storeAs( 'vendor_files', $fname, 'uploads' );

            // delete old file
            if ( isset( $vendorCost->file->file ) && Storage::disk( 'uploads' )->exists( $vendorCost->file->file ) ) {
                Storage::disk( 'uploads' )->delete( $vendorCost->file->file );
            }

            // save new file path
            $vendorCost->file()->update( ['file' => $filePath] );
        }

        return redirect()->route( 'projects.vendor.index', ['project' => $project] )->with( 'success', 'vendor cost updated' );
    }

    // delete vendor cost
    public function delete( Project $project, VendorCost $vendorCost ) {
        $vendorCost->delete();

        return redirect()->route( 'projects.vendor.index', ['project' => $project] )->with( 'success', 'vendor cost deleted' );
    }
}
