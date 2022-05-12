<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectBillAddRequest;
use App\Http\Requests\ProjectBillEditRequest;
use App\Models\Bill;
use App\Models\BillStatus;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectBillController extends Controller {
    // show internal costs
    public function index( Project $project ) {
        $billStatuses = BillStatus::all();

        $bills = $project->bill_type == 1 ? $project->bills->take(1) : $project->bills;

        return view( 'projects.bill', ['project' => $project, 'bills' => $bills, 'billStatuses' => $billStatuses] );
    }

    // Store internal cost
    public function store( Project $project, ProjectBillAddRequest $request ) {
        $request->validated();

        if ( $request->hasFile( 'file' ) ) {
            $fname = time() . "_" . $request->file->getClientOriginalName();

            // store bill file
            $filePath = $request->file( 'file' )->storeAs( 'project_bill_files', $fname, 'uploads' );

            // create bill
            $bill = $project->bills()->create( $request->only( ['date', 'bill_no', 'subject', 'bill_status_id', 'total', 'asf', 'vat'] ) );

            // save fill file path to bill
            $bill->file()->create( ['file' => $filePath] );

            // add supporting
            if ( $request->hasFile( 'supporting_file' ) ) {
                // store supporting file
                $supportingFileName = time() . "_" . $request->supporting_file->getClientOriginalName();
                $supportingFilePath = $request->file( 'supporting_file' )->storeAs( 'project_supporting_files', $supportingFileName, 'uploads' );

                // save supporting to bill
                $bill->supporting()->create( [
                    'file' => $supportingFilePath
                ] );
            }

        } else {
            return redirect()->route( 'projects.bill.index', $project )->with( 'failed', "Bill file did't found" );
        }

        return redirect()->route( 'projects.bill.index', $project )->with( 'success', 'bill Added' );
    }

    // update internal cost
    public function update( Project $project, Bill $bill, ProjectBillEditRequest $request, ) {
        $attr = $request->validated();

        if ( $request->has( 'file' ) ) {
            $fname = time() . "_" . $request->file->getClientOriginalName();

            // store new file
            $filePath = $request->file( 'file' )->storeAs( 'project_bill_files', $fname, 'uploads' );

            // delete previous file
            if ( isset( $bill->file->file ) && Storage::disk( 'uploads' )->exists( $bill->file->file ) ) {
                Storage::disk( 'uploads' )->delete( $bill->file->file );
            }

            // save file to bill
            $bill->file()->update( ['file' => $filePath] );

        }

        // update supporting file
        if ( $request->hasFile( 'supporting_file' ) ) {
            // store supporting file
            $supportingFileName = time() . "_" . $request->supporting_file->getClientOriginalName();
            $supportingFilePath = $request->file( 'supporting_file' )->storeAs( 'project_supporting_files', $supportingFileName, 'uploads' );

            // delete previous supporting file
            if ( isset( $bill->supporting->file ) && Storage::disk( 'uploads' )->exists( $bill->supporting->file ) ) {
                Storage::disk( 'uploads' )->delete( $bill->supporting->file );
            }

            // save supporting to bill
            $bill->supporting->update( [
                'file' => $supportingFilePath
            ] );
        }

        $bill->update( $request->only( ['date', 'bill_no', 'subject', 'bill_status_id', 'total', 'asf', 'vat'] ) );

        return redirect()->route( 'projects.bill.index', ['project' => $project] )->with( 'success', 'Project bill updated' );
    }
}
