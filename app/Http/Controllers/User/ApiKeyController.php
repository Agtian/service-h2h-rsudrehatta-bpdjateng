<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiKeyController extends Controller
{
    public function index()
    {
        return view("template-dashboard.layouts.api-key.index", [
            'detailApiKey' => ApiKey::where('user_id', Auth::user()->id)->first(),
        ]);
    }
}
