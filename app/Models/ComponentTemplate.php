<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentTemplate extends Model
{
    protected $connection = 'mysql2';
    protected $table = '_componenttemplate';
    use HasFactory;

    protected $fillable = [
        'GUID',
        'ProjectType',
        'ProjectSubType',
        'ProjectSpecificType',
        'ProjectSpecificSubType',
        'F7',
        'F8',
        'F9',
        'TemplateAcronym',
        'ComponentPDF',
        'MgtPlanPDF',
        'AbandonementPDF',
    ];
}
