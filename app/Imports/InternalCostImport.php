<?php

namespace App\Imports;

use App\Models\InternalCost;
use Maatwebsite\Excel\Concerns\ToModel;

class InternalCostImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $project = request()->project;
        
        return new InternalCost([
            'project_id' => $project->id,
            'title'       => $row[0],
            'description' => $row[1],
            'quantity'    => $row[2],
            'rate'        => $row[3],
            'costs'       => $row[4],
            'created_at'  => $row[5] ?? now()
        ]);
    }
}
