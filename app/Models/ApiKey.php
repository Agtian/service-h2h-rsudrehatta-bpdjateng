<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'api_keys';

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
