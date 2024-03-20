<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPayment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getApiKey()
    {
        return $this->belongsTo(ApiKey::class, 'api_key_id', 'id');
    }
}
