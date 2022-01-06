<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRequirements extends Model
{   
    protected $table = 'projectrequirement';
    use HasFactory;

    protected $fillable = [
            'ID', 'ProjectGUID', 'Description', 'Required', 'Compliant', 'Remarks', 'NotDefault', 'UpdatedDate', 'CreatedDate'  
    ];
}
