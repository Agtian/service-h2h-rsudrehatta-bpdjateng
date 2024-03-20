<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiEventHistories extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'api_event_histories';

    public function getApiKey()
    {
        return $this->belongsTo(ApiKey::class, 'api_key_id', 'id');
    }
}
