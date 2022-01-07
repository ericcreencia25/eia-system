<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentThreshold extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ComponentThreshold';
    use HasFactory;

    protected $fillable = [
        'ID','GUID','ComponentGUID','Category','ReportType','Minimum','Maximum','MinimumAdjusted','ReferenceID', 
        'Grouping','ParameterOrig','Ranking','DecisionDocumentDefault','ProcessingAuthority','DecidingAuthority','TagRef'
    ];
}
