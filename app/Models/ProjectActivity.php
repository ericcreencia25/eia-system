<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectActivity extends Model
{   
    protected $table = 'Projectactivity';
    use HasFactory;

    protected $fillable = [
            'ID', 'GUID', 'ProjectGUID', 'Status', 'Details', 'RoutedFrom', 'RoutedFromOffice', 'RoutedTo', 'RoutedToOffice', 'Routing', 'Remarks', 'TotWorkDays', 'TotHolidays', 'TotElapsedDays', 'TotAccumulatedDays', 'TotComputed', 'FromDate', 'UpdatedBy', 'UpdatedDate', 'CreatedBy', 'CreatedDate', 'ExpiryProcTime', 'TotAccumulatedHrs'
    ];
}
