<?php

namespace App\Exports;

use App\Models\Credit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class CreditsExport implements FromCollection, WithHeadings, WithEvents, WithMapping, ShouldAutoSize {
    public $year, $month, $formatedMonth;

    public function __construct( $year, $month ) {
        $this->year = $year;
        $this->month = $month;
        $this->formatedMonth = now()->month( $month )->format( 'F' );
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {
        return Credit::whereYear( 'date', $this->year )->whereMonth( 'date', $this->month )->get( ['id', 'date', 'user_id', 'category_id', 'project_id', 'loan_lender_id', 'investor_id', 'amount', 'transaction_type_id', 'note'] );
    }

    public function registerEvents(): array{

        return [
            AfterSheet::class => function ( AfterSheet $event ) {
                /** @var Sheet $sheet */
                $sheet = $event->sheet;

                $sheet->mergeCells( 'A1:J1' );

                $styleArray = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    ],
                    'font'      => [
                        'bold' => true
                    ]
                ];

                $cellRange = 'A1:J1'; // All headers
                $event->sheet->getDelegate()->getStyle( $cellRange )->applyFromArray( $styleArray );
            }
        ];
    }

    /**
     * @var Credit $credit
     */
    public function map( $credit ): array
    {
        return [
            $credit->id,
            $credit->date,
            $credit->receivedPerson->name,
            $credit->category->name,
            $credit->project->name ?? "--",
            $credit->loanLender->name ?? "--",
            $credit->investor->name ?? "--",
            $credit->transactionType->name,
            $credit->amount,
            $credit->note
        ];
    }

    public function headings(): array
    {
        return [
            ["Credit Records Month of {$this->formatedMonth} - {$this->year}"],
            [
                '#', "Date", "Received by", "Category", "Project Name", "Loan Lender", "Investor", "Transaction Type", "Amount(৳)", "Note"
            ]
        ];
    }

}
