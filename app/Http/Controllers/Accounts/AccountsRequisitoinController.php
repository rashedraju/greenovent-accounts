<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class AccountsRequisitoinController extends Controller {
    public function index( $year, $month ) {
        $projects = Project::orderBy( 'id', 'desc' )->paginate( 10 );
        return view( 'accounts.requisitions.index', ['year' => $year, 'month' => $month, 'projects' => $projects] );
    }

    public function show( $year, $month, Project $project ) {
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

        return view( 'accounts.requisitions.show', ['year' => $year, 'month' => $month, 'requisitions' => $requisitions] );
    }
}
