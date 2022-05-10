<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\ApprovalStatus;
use App\Models\Client;
use App\Models\Project;
use App\Models\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ApprovalsController extends Controller {
    public function index() {
        $user = auth()->user();
        $approvals = $user->approvalRequests()->orderBy( 'id', 'desc' )->paginate( 15 );

        return view( 'approvals.index', ['approvals' => $approvals] );
    }

    public function show( Approval $approval ) {
        $user = auth()->user();
        $approvals = $user->approvalRequests()->orderBy( 'id', 'desc' )->paginate( 15 );
        $approvalable = $approval->approvalable;
        $approvalStatuses = ApprovalStatus::all();
        $preview = null;

        if ( $approvalable instanceof Client ) {
            $preview = View::make( 'components.approval-preview.new-client-preview', ['client' => $approvalable] );
        } else if ( $approvalable instanceof Project ) {
            $preview = View::make( 'components.approval-preview.new-project-preview', ['project' => $approvalable] );
        } else if ( $approvalable instanceof Requisition ) {
            $preview = View::make( 'components.requisition', ['requisition' => $approvalable] );
        }

        return view( 'approvals.show', ['approvals' => $approvals, 'approval' => $approval, 'approvalStatuses' => $approvalStatuses, 'preview' => $preview] );
    }

    public function update( Approval $approval, Request $request ) {
        $attrs = $request->validate( [
            'approval_status_id' => 'required|exists:approval_statuses,id',
            'note'               => 'sometimes'
        ] );

        $approval->update( $attrs );

        return back()->with( 'success', 'Approval request has been updated.' );
    }
}
