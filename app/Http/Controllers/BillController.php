<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectBillAddRequest;
use App\Models\Bill;
use App\Models\Project;

class BillController extends Controller {
    // show internal costs
    public function index( Project $project ) {
        return view( 'projects.bill', ['project' => $project] );
    }

    // Store internal cost
    public function store( Project $project, ProjectBillAddRequest $request ) {
        $request->validated();

        $internal = $project->internal()->create( $request->only( ['total', 'note'] ) );

        if ( $request->has( 'file' ) ) {
            $fname = time() . $request->file->getClientOriginalName();
            $filePath = $request->file( 'file' )->storeAs( 'internal_files', $fname, 'uploads' );

            $internal->file()->create( ['file' => $filePath] );
        } else {
            return back()->with( 'failed', "internal file did't found" );
        }

        return redirect()->route( 'projects.internal.index', $project )->with( 'success', 'internal Added' );
    }

    // update internal cost
    public function update( Project $project, Bill $bill, ProjectBillAddRequest $request, ) {
        $request->validated();

        $bill->update( $request->only( ['total', 'note'] ) );

        if ( $request->has( 'file' ) ) {
            $fname = time() . $request->file->getClientOriginalName();
            $filePath = $request->file( 'file' )->storeAs( 'project_bill_files', $fname, 'uploads' );

            $bill->file()->update( ['file' => $filePath] );
        }

        return redirect()->route( 'projects.internal.index', ['project' => $project] )->with( 'success', 'Project bill updated' );
    }

    // delete project bill
    public function delete( Project $project, Bill $bill ) {
        $bill->delete();

        return redirect()->route( 'projects.bill.index', ['project' => $project] )->with( 'success', 'Project bill deleted' );
    }
}
