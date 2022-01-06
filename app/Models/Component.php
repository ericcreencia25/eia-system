<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'Component';
    use HasFactory;

    protected $fillable = [
        'ID',
        'GUID',
        'ProjectType',
        'ProjectSubType',
        'ProjectSpecificType',
        'ProjectSpecificSubType',
        'Parameter',
        'UnitOfMeasure',
        'Active',
        'IEEChecklist'
    ];
}
