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
        $query = ApiEventHistories::select('api_address', 'url', 'user_agent', 'api_event_histories.created_at as histories_created_ad', 'users.company', 'users.name', 'users.email', 'users.no_hp')
            ->leftJoin('api_keys', 'api_event_histories.api_key_id', '=', 'api_keys.id')
            ->leftJoin('users', 'api_keys.user_id', '=', 'users.id')
            ->where('api_keys.user_id', Auth::user()->id)
            ->paginate(10);

        return view("template-dashboard.layouts.log-service.index", [
            'resultLogServices' => $query
        ]);
    }
}
