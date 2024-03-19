<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\SMSHelper;
use App\Http\Controllers\Controller;
use App\Models\ApiEventHistories;
use App\Models\LogPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $getHistoryApiAll = DB::select("SELECT MONTHNAME(created_at) as bulan, COUNT(id) AS used_quantity
                    FROM api_event_histories
                    WHERE YEAR(created_at) = YEAR(CURDATE())
                    GROUP BY MONTHNAME(created_at)");

        $getHistoryApiUsersH2HBPDJateng = DB::select("SELECT api_event_histories.api_key_id, month(api_event_histories.created_at) as bulanAngka,  MONTHNAME(api_event_histories.created_at) as bulan, COUNT(api_event_histories.id) AS used_quantity, api_keys.company_name, api_keys.color
                    FROM api_event_histories
                    JOIN api_keys ON api_event_histories.api_key_id = api_keys.id
                    WHERE YEAR(api_event_histories.created_at) = YEAR(CURDATE())
                        AND api_keys.project_id = 1
                    GROUP BY api_event_histories.api_key_id, bulanAngka, MONTHNAME(api_event_histories.created_at), api_keys.company_name, api_keys.color");

        return view('template-dashboard.layouts.dashboard.admin', [
            'countBillData'                 => LogPayment::whereYear('created_at', date('Y'))->count(),
            'countPaymentCompleted'         => LogPayment::whereYear('created_at', date('Y'))->where('status_payment', 1)->count(),
            'countResponseConnected'        => LogPayment::whereYear('created_at', date('Y'))->where('status_reversal', 1)->count(),
            'countResponseConnectionFailed' => LogPayment::whereYear('created_at', date('Y'))->where('status_reversal', 0)->count(),
            'getHistoryApiAll'              => $getHistoryApiAll,
            'getCountHistoryApiAll'         => ApiEventHistories::whereYear('created_at', date('Y'))->count(),
            'getHistoryApiUsersH2HBPDJateng' => $getHistoryApiUsersH2HBPDJateng,
        ]);
    }
}
