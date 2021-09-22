<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspnetMembership extends Model
{
    protected $table = 'aspnet_membership';
    use HasFactory;

    protected $fillable = [
        'ApplicationId',
        'UserId',
        'Password',
        'PasswordFormat',
        'PasswordSalt',
        'MobilePIN',
        'Email',
        'LoweredEmail',
        'PasswordQuestion',
        'PasswordAnswer',
        'IsApproved',
        'IsLockedOut',
        'CreateDate',
        'LastLoginDate',
        'LastPasswordChangedDate',
        'LastLockoutDate',
        'FailedPasswordAttemptCount',
        'FailedPasswordAttemptWindowStart',
        'FailedPasswordAnswerAttemptCount',
        'FailedPasswordAnswerAttemptWindowStart',
        'Comment',
        'PasswordOld'
    ];
}
