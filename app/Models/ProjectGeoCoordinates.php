<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGeoCoordinates extends Model
{   
    protected $table = 'projectgeocoordinates';
    use HasFactory;

    protected $fillable = [
        'ID',
        'AreaGUID',
        'LongDeg',
        'LongMin',
        'LongSec',
        'LatDeg',
        'LatMin',
        'LatSec',
        'Longitude',
        'Latitude',
        'Sorter'
    ];
}
