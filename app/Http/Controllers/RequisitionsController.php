<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRequisitionRequest;
use App\Models\Project;
use App\Models\Requisition;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class RequisitionsController extends Controller {
    public function index( Project $project ) {
        $requisitionsSheets = [];

        foreach ( $project->requisitions as $requisition ) {
            if ( $requisition->file ) {
                $reader = new Xlsx();
                $spreadsheet = $reader->load( 'public/uploads/' . $requisition->file->file );

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

                $requisitionsSheets[] = [
                    $sheetHeader,
                    $sheetData,
                    $sheetFooter
                ];
            }
        }

        return view( 'projects.requisitions', ['project' => $project, 'requisitionsSheets' => $requisitionsSheets] );
    }

    public function store( Project $project, AddRequisitionRequest $request ) {
        $attrs = $request->validated();

        $requisition = Requisition::create( [
            'project_id' => $project->id
        ] );

        if ( $request->has( 'file' ) ) {
            $fname = time() . "_" . $request->file->getClientOriginalName();
            $filePath = $request->file( 'file' )->storeAs( 'requisition_files', $fname, 'uploads' );

            $requisition->file()->create( ['file' => $filePath] );
        } else {
            return back()->with( 'failed', "Requisition file did't fount" );
        }

        return back()->with( 'success', "Requisition added successfully" );
    }

    public function delete() {

    }
}
