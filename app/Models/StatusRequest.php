<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusRequest extends Model
{
    use HasFactory;

    protected $table = 'status_request_seeders';

    public $timestamps = true;

    protected $fillable = [
        'request_status',
    ];
}
