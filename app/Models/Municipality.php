<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{   
    protected $table = 'Municipality';
    use HasFactory;

    protected $fillable = [
            'ID',
            'Municipality',
            'Province',
    ];
}
