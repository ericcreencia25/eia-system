<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proponent extends Model
{   
    protected $table = 'proponent';
    use HasFactory;

    protected $fillable = [
            'ID',
            'GUID',
            'ProponentName',
            'MailingAddress',
            'ContactPerson',
            'Designation',
            'ContactPersonNo',
            'MobileNo',
            'ContactPersonEmailAddress',
            'LineOfBusiness',
            'SECRegistrationNo',
            'DTIRegistrationNo',
            'UpdatedBy',
            'UpdatedDate',
            'CreatedBy',
            'CreatedDate'
    ];
}
