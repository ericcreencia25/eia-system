<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{   
    protected $table = 'office';
    use HasFactory;

    protected $fillable = [
            'ID',
            'Location',
            'Location 1',
    ];
}
