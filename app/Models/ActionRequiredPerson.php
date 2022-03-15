<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionRequiredPerson extends Model
{
    protected $connection = 'mysql';
    
    protected $table = 'actionrequiredperson';
    use HasFactory;

    protected $fillable = [
        'ID',
        'UserName',
        'Action',
        'Active',
        'InECCOAS',
        'InCMROS',
        'InCNCOAS'
    ];
}
