<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SalaryExpenseImport implements ToCollection, WithStartRow, WithMapping, WithValidation {
    public function startRow(): int {
        return 3;
    }

    public function map( $row ): array
    {
        return [
            Date::excelToDateTimeObject( $row[0] ),
            $row[1],
            $row[2],
            $row[3]
        ];
    }

    public function rules(): array
    {
        return [
            0 => 'required|date',
            1 => 'required|string',
            2 => 'required|string',
            3 => 'required|string'

        ];
    }

    public function collection( Collection $rows ) {
        foreach ( $rows as $row ) {
            dd( $row );
        }
    }
}
