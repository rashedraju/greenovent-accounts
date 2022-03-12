<?php

namespace App\Imports;

use App\Models\VendorCost;
use Maatwebsite\Excel\Concerns\ToModel;

class VendorCostImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $project = request()->project;
        return new VendorCost([
            'project_id' => $project->id,
            'title'       => $row[0],
            'name' => $row[1],
            'advance'    => $row[2],
            'due'        => $row[3],
            'created_at'  => $row[4] ?? now()
        ]);
    }
}
