<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePerformance extends Model
{
    use HasFactory;

    // employee performance
    public function employee(){
        return $this->belongsTo(User::class);
    }

    // employe performance name
    public function performanceName(){
        return $this->belongsTo(EmployeePerformanceName::class, 'performance_name_id');
    }

    // employe performance status
    public function performanceStatus(){
        return $this->belongsTo(EmployeePerformanceStatus::class, 'performance_status_id');
    }
}
