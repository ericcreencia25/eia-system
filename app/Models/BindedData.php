<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BindedData extends Model
{
    use HasFactory;

    protected $table = 'binded_data';

    protected $fillable = [
        'ID', 'ProponentGUID', 'EmbID', 'CompanyName', 'ProponentName', 'UserId', 'UserCode'
    ];
}
