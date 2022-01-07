<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectActivityAttachmentTemp extends Model
{   
    protected $table = 'ProjectActivityAttachmentTemp';
    use HasFactory;

    protected $fillable = [
            'ID','GUID','ActivityGUID','Description','FileName','Directory','FilePath','FileSizeInKB','CreatedBy','CreatedDate'
    ];
}
