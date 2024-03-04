<?php

namespace App\Http\Controllers;

use App\Models\ApiEventHistories;
use App\Models\PersonalAccessToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getPerformance()
    {
        $getCountAllRequest = ApiEventHistories::whereYear('created_at', date('Y'))->get();
        $getHistoryApiAll = DB::select("SELECT MONTHNAME(created_at) as bulan, COUNT(id) AS used_quantity
                    FROM api_event_histories
                    WHERE YEAR(created_at) = YEAR(CURDATE())
                    GROUP BY MONTHNAME(created_at)");

        $getHistoryByUser = DB::select("SELECT COUNT(id) AS used_quantity, api_key_id
                    FROM api_event_histories
                    WHERE YEAR(created_at) = YEAR(CURDATE())
                    GROUP BY api_key_id");

        $getHistoryApiBPDUnlisted = DB::select("SELECT MONTHNAME(created_at) as bulan, COUNT(id) AS used_quantity, api_key_id
                    FROM api_event_histories
                    WHERE YEAR(created_at) = YEAR(CURDATE())
                    AND api_key_id = 0
                    GROUP BY MONTHNAME(created_at), api_key_id");

        $getHistoryApiBPDTesting = DB::select("SELECT MONTHNAME(created_at) as bulan, COUNT(id) AS used_quantity, api_key_id
                    FROM api_event_histories
                    WHERE YEAR(created_at) = YEAR(CURDATE())
                    AND api_key_id = 1
                    GROUP BY MONTHNAME(created_at), api_key_id");

        $getHistoryApiBPDRunning = DB::select("SELECT MONTHNAME(created_at) as bulan, COUNT(id) AS used_quantity, api_key_id
                    FROM api_event_histories
                    WHERE YEAR(created_at) = YEAR(CURDATE())
                    AND api_key_id = 2
                    GROUP BY MONTHNAME(created_at), api_key_id");

        $getCompletePayment = DB::select("SELECT MONTHNAME(created_at) as bulan, count(id) AS complete_payment
                    FROM log_payments
                    WHERE status_payment = 1
                        AND YEAR(created_at) = YEAR(CURDATE())
                    GROUP BY MONTHNAME(created_at)");

        $actionData = [
            'getCountAllRequest'        => count($getCountAllRequest),
            'getHistoryByUser'          => $getHistoryByUser,
            'getHistoryApiAll'          => $getHistoryApiAll,
            'getHistoryApiBPDTesting'   => $getHistoryApiBPDTesting,
            'getHistoryApiBPDRunning'   => $getHistoryApiBPDRunning,
            'getHistoryApiBPDUnlisted'  => $getHistoryApiBPDUnlisted,
            'getCompletePayment'        => $getCompletePayment
        ];

        return $actionData;
    }

    public function index()
    {
        // dd($this->getPerformance()['getHistoryByUser']);
        $index = 0;
        $usedQuantityArr = [];
        foreach ($this->getPerformance()['getHistoryApiBPDRunning'] as $item) {
            array_push($usedQuantityArr, $item->used_quantity);
            $index++;
        }

        $xx = $this->getPerformance()['getHistoryApiBPDRunning'];

        // dd($xx);

        return view('layouts.dashboard', [
            'resultHistoryAPI'          => ApiEventHistories::paginate(8),
            'resultPersonalAccessToken' => PersonalAccessToken::take(8)->get(),
            'usedQuantityArr'           => $usedQuantityArr,

            'getCountAllRequest'        => $this->getPerformance()['getCountAllRequest'],
            'getHistoryByUser'          => $this->getPerformance()['getHistoryByUser'],
            'getHistoryApiAll'          => $this->getPerformance()['getHistoryApiAll'],
            'getHistoryApiBPDTesting'   => $this->getPerformance()['getHistoryApiBPDTesting'],
            'getHistoryApiBPDRunning'   => $this->getPerformance()['getHistoryApiBPDRunning'],
            'getHistoryApiBPDUnlisted'  => $this->getPerformance()['getHistoryApiBPDUnlisted'],
            'getCompletePayment'        => $this->getPerformance()['getCompletePayment']
        ]);
    }
}
