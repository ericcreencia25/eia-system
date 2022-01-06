<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspnetUser extends Model
{
    protected $connection = 'mysql';
    
    protected $table = 'aspnet_users';
    use HasFactory;

    protected $fillable = [
        'ApplicationId',
        'UserId',
        'Title',
        'UserName',
        'LoweredUserName',
        'GovernmentID',
        'AuthorizationLetter',
        'SecDTIRegistration',
        'Designation',
        'AlternateEmail',
        'MobileAlias',
        'UserOffice',
        'Department',
        'UserRole',
        'DefaultRecipient',
        'DefaultRecipientCMR',
        'DefaultRecipientCNC',
        'IsAnonymous',
        'LastActivityDate',
        'CreatedDate',
        'ProponentGUID',
        'BirthDate',
        'InECCOAS',
        'InCMROS',
        'InCNCOAS',
        'OnLeave',
        'OnLeaveReceiver',
        'Screened'
    ];
}
