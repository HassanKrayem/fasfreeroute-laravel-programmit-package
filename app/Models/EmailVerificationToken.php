<?php

namespace Programmit\Models;

use Illuminate\Database\Eloquent\Model;

class EmailVerificationToken extends Model
{
    protected $table = 'email_verification_tokens';
    protected $fillable = [
        'email',
        'token'
    ];
    
}
