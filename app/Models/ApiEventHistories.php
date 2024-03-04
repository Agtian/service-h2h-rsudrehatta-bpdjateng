<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiEventHistories extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'api_key_id');
    }
}
