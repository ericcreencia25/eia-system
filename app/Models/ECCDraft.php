<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ECCDraft extends Model
{   
    protected $table = 'ecc_draft';
    use HasFactory;

    protected $fillable = [
            'ID',
            'Template',
            'Type',
            'ProjectType',
            'Subject',
            'Body',
            'ThisIsToCertify',
            'ProjectDescription',
            'ProjectComponents',
            'ThisCertificateIsIssued',
            'SwornAccountabilityStatement',
            'EnvironmentalManagement',
            'GeneralConditions',
            'Restrictions',
            'PAPT'
    ];
}
