<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class ExpensesExport implements FromCollection, WithHeadings, WithEvents, WithMapping, ShouldAutoSize {
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
        return Expense::whereYear( 'date', $this->year )->whereMonth( 'date', $this->month )->get( ['id', 'head', 'date', 'user_id', 'project_id', 'description', 'expense_type_id', 'transaction_type_id', 'amount', 'note'] );
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
     * @var Expense $expense
     */
    public function map( $expense ): array
    {
        return [
            $expense->id,
            $expense->head,
            $expense->date,
            $expense->billingPerson->name,
            $expense->project->name,
            $expense->description,
            $expense->expenseType->name,
            $expense->transactionType->name,
            $expense->amount,
            $expense->note
        ];
    }

    public function headings(): array
    {
        return [
            ["Expense Records Month of {$this->formatedMonth} - {$this->year}"],
            [
                '#', "Head", "Date", "Billing Person", "Project Name", "Description", "Expense Type", "Transaction Type", "Amount(৳)", "Note"
            ]
        ];
    }

}
