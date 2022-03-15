<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holidays_ extends Model
{
    protected $connection = 'mysql';
    
    protected $table = 'holidays_';
    use HasFactory;

    protected $fillable = [
        'ID',
        'Region',
        'Holiday',
        'Scope',
        'Description',
        'UpdatedBy',
        'UpdatedDate',
        'UpdatedDate',
        'CreatedBy',
        'CreatedDate'
    ];
}
