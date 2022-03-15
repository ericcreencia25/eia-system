<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holidays extends Model
{
    protected $connection = 'mysql';
    
    protected $table = 'holidays';
    use HasFactory;

    protected $fillable = [
        'ID',
        'Description',
        'OnDate',
        'Coverage',
        'Scope',
        'Notes',
        'UpdatedBy',
        'UpdatedDate',
        'CreatedBy',
        'CreatedDate'
    ];
}
