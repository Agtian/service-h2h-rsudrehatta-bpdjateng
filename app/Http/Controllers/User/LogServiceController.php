<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ApiEventHistories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogServiceController extends Controller
{
    public function index()
    {
        return view("template-dashboard.layouts.log-service.index", [
            'resultLogServices' => ApiEventHistories::where('api_key_id', Auth::user()->id)->paginate()
        ]);
    }
}
