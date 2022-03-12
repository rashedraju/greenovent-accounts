<?php

namespace App\Exports;

use App\Models\InternalCost;
use Maatwebsite\Excel\Concerns\FromCollection;

class InternalCostExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return InternalCost::all([
            'title',
            'description',
            'quantity',
            'rate',
            'costs',
            'created_at',
        ]);
    }
}
