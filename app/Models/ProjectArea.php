<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectArea extends Model
{   
    protected $table = 'projectarea';
    use HasFactory;

    protected $fillable = [
            'ID', 'GUID', 'ProjectGUID', 'Area', 'AreaType',
    ];
}
