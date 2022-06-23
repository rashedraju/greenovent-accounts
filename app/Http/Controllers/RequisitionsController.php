<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRequisitionRequest;
use App\Models\Project;
use App\Models\Requisition;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class RequisitionsController extends Controller {
    public function index( Project $project ) {
        $requisitions = [];

        foreach ( $project->requisitions as $requisition ) {
            if ( $requisition->file && Storage::disk( 'uploads' )->exists( $requisition->file->file ) ) {
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

                $requisitions[] = [
                    'total' => $requisition->total,
                    'sheet' => [
                        $sheetHeader,
                        $sheetData,
                        $sheetFooter
                    ]
                ];
            } else {
                $requisitions[] = [
                    'total' => $requisition->total,
                    'sheet' => null
                ];
            }
        }

        return view( 'projects.requisitions', ['project' => $project, 'requisitions' => $requisitions] );
    }

    public function store( Project $project, AddRequisitionRequest $request ) {
        $attrs = $request->validated();

        $requisition = Requisition::create( [
            'project_id' => $project->id,
            'total'      => $attrs['total']
        ] );

        if ( $request->has( 'file' ) ) {
            $fname = time() . "_" . $request->file->getClientOriginalName();
            $filePath = $request->file( 'file' )->storeAs( 'requisition_files', $fname, 'uploads' );

            $requisition->file()->create( ['file' => $filePath] );
        }

        return back()->with( 'success', "Requisition added successfully" );
    }

    public function delete() {

    }
}
