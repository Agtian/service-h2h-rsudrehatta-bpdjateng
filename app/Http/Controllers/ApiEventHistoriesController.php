<?php

namespace App\Http\Controllers;

use App\Models\ApiEventHistories;
use Illuminate\Http\Request;

class ApiEventHistoriesController extends Controller
{
    public function index()
    {
        return view('layouts.api-event-histories.index', [
            'resultApiEventHistories'   => ApiEventHistories::select('api_event_histories.id', 'api_address', 'url', 'user_agent', 'api_event_histories.created_at', 'users.company')
                ->join('users', 'api_event_histories.api_key_id', '=', 'users.id')
                ->whereYear('api_event_histories.created_at', date('Y'))
                ->orderBy('api_event_histories.created_at', 'DESC')
                ->limit(250)
                ->paginate(10)
        ]);
    }
}
