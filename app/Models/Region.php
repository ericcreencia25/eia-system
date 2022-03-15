<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{   
    protected $table = 'region';
    use HasFactory;

    protected $fillable = [
            'ID',
            'RegionGUID',
            'Region',
            'Description',
            'Address',
            'TelephoneNo',
            'FaxNo',
            'EmailAddress',
            'Website',
            'EIAChief',
            'EIAChiefSignature',
            'CPDChief',
            'CPDChiefSignature',
            'Director',
            'Designation',
            'DirectorSignature',
            'EIAChiefDesignation',
            'DirectorEmail',
            'Sorter',
            'ECCTemplate',
            'DenialTemplate',
            'Active',
    ];
}
