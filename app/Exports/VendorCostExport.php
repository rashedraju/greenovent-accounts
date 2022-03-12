<?php

namespace App\Exports;

use App\Models\VendorCost;
use Maatwebsite\Excel\Concerns\FromCollection;

class VendorCostExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return VendorCost::all([
            'title',
            'name',
            'advance',
            'due',
            'created_at'
        ]);
    }
}
