<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HolidaysNational extends Model
{
    protected $connection = 'mysql';
    
    protected $table = 'holidaysnational';
    use HasFactory;

    protected $fillable = [
        'ID',
        'Description',
        'OnDate',
        'Coverage',
        'Scope',
    ];
}
