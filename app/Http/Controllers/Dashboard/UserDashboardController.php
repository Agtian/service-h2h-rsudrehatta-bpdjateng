<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ApiEventHistories;
use App\Models\ApiKey;
use App\Models\LogPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function index()
    {
        $apiKey = ApiKey::where([
            ['project_id', 1],
            ['user_id', Auth::user()->id]
        ])->first();

        $getHistoryApiAll = DB::select("SELECT MONTHNAME(created_at) as bulan, COUNT(id) AS used_quantity
                    FROM api_event_histories
                    WHERE YEAR(created_at) = YEAR(CURDATE())
                        AND api_key_id = $apiKey->id
                    GROUP BY MONTHNAME(created_at)");

        return view('template-dashboard.layouts.dashboard.user', [
            'countBillData'                 => LogPayment::where('api_key_id', $apiKey->id)->whereYear('created_at', date('Y'))->count(),
            'countPaymentCompleted'         => LogPayment::where('api_key_id', $apiKey->id)->whereYear('created_at', date('Y'))->where('status_payment', 1)->count(),
            'countResponseConnected'        => LogPayment::where('api_key_id', $apiKey->id)->whereYear('created_at', date('Y'))->where('status_reversal', 1)->count(),
            'countResponseConnectionFailed' => LogPayment::where('api_key_id', $apiKey->id)->whereYear('created_at', date('Y'))->where('status_reversal', 0)->count(),
            'getHistoryApiAll'              => $getHistoryApiAll,
            'getCountHistoryApiAll'         => ApiEventHistories::where('api_key_id', $apiKey->id)->whereYear('created_at', date('Y'))->count(),
            'detailApiKey'                  => $apiKey,
        ]);
    }
}
