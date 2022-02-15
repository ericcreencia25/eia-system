<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectActivityAttachment extends Model
{   
    protected $table = 'projectactivityattachment';
    use HasFactory;

    protected $fillable = [
            'ID','GUID','ActivityGUID','Description','FileName','Directory','FilePath','FileSizeInKB','CreatedBy','CreatedDate'
    ];
}
