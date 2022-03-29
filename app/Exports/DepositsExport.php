<?php

namespace App\Exports;

use App\Models\Deposit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class DepositsExport implements FromCollection, WithHeadings, WithEvents, WithMapping, ShouldAutoSize {
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
        return Deposit::whereYear( 'date', $this->year )->whereMonth( 'date', $this->month )->get( ['id', 'date', 'user_id', 'bank_name', 'slip_number', 'amount', 'note'] );
    }

    public function registerEvents(): array{

        return [
            AfterSheet::class => function ( AfterSheet $event ) {
                /** @var Sheet $sheet */
                $sheet = $event->sheet;

                $sheet->mergeCells( 'A1:G1' );

                $styleArray = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    ],
                    'font'      => [
                        'bold' => true
                    ]
                ];

                $cellRange = 'A1:G1'; // All headers
                $event->sheet->getDelegate()->getStyle( $cellRange )->applyFromArray( $styleArray );
            }
        ];
    }

    /**
     * @var Deposit $deposit
     */
    public function map( $deposit ): array
    {
        return [
            $deposit->id,
            $deposit->date,
            $deposit->depositPerson->name,
            $deposit->bank_name,
            $deposit->slip_number,
            $deposit->amount,
            $deposit->note
        ];
    }

    public function headings(): array
    {
        return [
            ["Deposit Records Month of {$this->formatedMonth} - {$this->year}"],
            [
                '#', "Date", "Deposit By", "Bank Name", "Slip Number", "Amount(৳)", "Note"
            ]
        ];
    }

}
