<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectApplicationRequirements extends Model
{   
    protected $table = 'Project_ApplicationRequirements';
    use HasFactory;

    protected $fillable = [
            'ID', 'Description', 
    ];
}
