<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $connection = 'mysql';
    
    protected $table = 'attachment';
    use HasFactory;

    protected $fillable = [
        'ID',
        'Description',
        'Sorter',
        'Type',
        'UserRole'
    ];
}
