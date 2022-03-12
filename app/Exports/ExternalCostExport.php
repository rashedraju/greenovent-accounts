<?php

namespace App\Exports;

use App\Models\ExternalCost;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExternalCostExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ExternalCost::all([
            'title',
            'description',
            'quantity',
            'rate',
            'costs',
            'created_at',
        ]);
    }
}
