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
        $getHistoryApiBPDTesting = DB::select("SELECT MONTHNAME(created_at) as bulan, COUNT(id) AS used_quantity, api_key_id
                    FROM api_event_histories
                    WHERE YEAR(created_at) = YEAR(CURDATE())
                    AND api_key_id = 1
                    GROUP BY MONTHNAME(created_at), api_key_id");

        $getHistoryApiRunningRunning = DB::select("SELECT MONTHNAME(created_at) as bulan, COUNT(id) AS used_quantity, api_key_id
                    FROM api_event_histories
                    WHERE YEAR(created_at) = YEAR(CURDATE())
                    AND api_key_id = 2
                    GROUP BY MONTHNAME(created_at), api_key_id");

        $actionData = [
            'getHistoryApiBPDTesting'       => $getHistoryApiBPDTesting,
            'getHistoryApiRunningRunning'   => $getHistoryApiRunningRunning
        ];

        return $actionData;
    }

    public function index()
    {
        $index = 0;
        $usedQuantityArr = [];
        foreach ($this->getPerformance()['getHistoryApiBPDTesting'] as $item) {
            array_push($usedQuantityArr, $item->used_quantity);
            $index++;
        }

        return view('layouts.dashboard', [
            'resultHistoryAPI'          => ApiEventHistories::paginate(8),
            'resultPersonalAccessToken' => PersonalAccessToken::take(8)->get(),
            'usedQuantityArr'           => $usedQuantityArr,
        ]);
    }
}
