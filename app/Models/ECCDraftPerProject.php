<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ECCDraftPerProject extends Model
{   
    protected $table = 'ecc_draft_per_project';
    use HasFactory;

    protected $fillable = [
            'ID',
            'GUID',
            'ProjectGUID',
            'Template',
            'ProjectType',
            'Subject',
            'Body',
            'ThisIsToCertify',
            'ProjectDescription',
            'ProjectComponents',
            'ThisCertificateIsIssued',
            'SwornAccountabilityStatement',
            'EMConditions',
            'SubEMConditions',
            'Restrictions'
    ];
}
