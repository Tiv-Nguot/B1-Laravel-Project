<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForgotResetPassword extends Model
{
    protected $fillable = ['email', 'token'];
    public $timestamps = false;
}
