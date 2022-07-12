<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvironmentalManagementPerProject extends Model
{   
    protected $table = 'environmental_management_per_project';
    use HasFactory;

    protected $fillable = [
            'ID',
            'ConstructionPhase',
            'OperationPhase',
            'ProjectGUID',
            'CreatedDate',
    ];
}
