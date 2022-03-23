<?php

namespace App\Exports;

use App\Models\Withdrawal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class WithdrawalsExport implements FromCollection, WithHeadings, WithEvents, WithMapping, ShouldAutoSize {
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
        return Withdrawal::whereYear( 'date', $this->year )->whereMonth( 'date', $this->month )->get( ['id', 'date', 'user_id', 'bank_name', 'slip_number', 'amount', 'note'] );
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
     * @var Withdrawal $withdrawal
     */
    public function map( $withdrawal ): array
    {
        return [
            $withdrawal->id,
            $withdrawal->date,
            $withdrawal->withdrawalPerson->name,
            $withdrawal->bank_name,
            $withdrawal->slip_number,
            $withdrawal->amount,
            $withdrawal->note
        ];
    }

    public function headings(): array
    {
        return [
            ["Withdrawal Records Month of {$this->formatedMonth} - {$this->year}"],
            [
                '#', "Date", "Withdrawal By", "Bank Name", "Slip Number", "Amount(৳)", "Note"
            ]
        ];
    }

}
