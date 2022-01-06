<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{   
    protected $table = 'municipality';
    use HasFactory;

    protected $fillable = [
            'ID',
            'Municipality',
            'Province',
    ];
}
