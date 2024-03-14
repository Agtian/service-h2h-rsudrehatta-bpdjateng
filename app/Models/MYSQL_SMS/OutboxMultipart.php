<?php

namespace App\Models\MYSQL_SMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutboxMultipart extends Model
{
    use HasFactory;

    protected $connection = 'mysql_sms';
    protected $table = 'outbox_multipart';

    protected $guarded = [];
}
