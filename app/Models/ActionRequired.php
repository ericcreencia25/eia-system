<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionRequired extends Model
{
    protected $connection = 'mysql';
    
    protected $table = 'actionrequired';
    use HasFactory;

    protected $fillable = [
        'ID',
        'Action',
        'Office'
    ];
}
