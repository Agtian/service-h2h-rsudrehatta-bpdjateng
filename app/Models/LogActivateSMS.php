<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivateSMS extends Model
{
    use HasFactory;

    protected $table = 'log_activation_sms';

    protected $guarded = [];
}
