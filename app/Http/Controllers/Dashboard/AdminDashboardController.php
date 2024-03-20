<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\SMSHelper;
use App\Http\Controllers\Controller;
use App\Models\ApiEventHistories;
use App\Models\LogActivateSMS;
use App\Models\LogPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

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

        $getQuantityRequestUser = ApiEventHistories::select('api_keys.project_name', 'api_keys.company_name', DB::raw('count(api_event_histories.id) as used_quantity'))
            ->leftJoin('api_keys', 'api_event_histories.api_key_id', '=', 'api_keys.id')
            ->where('api_keys.status_api_key', 1)
            ->whereYear('api_event_histories.created_at', date('Y'))
            ->groupBy('api_keys.project_name', 'api_keys.company_name')
            ->get();

        return view('template-dashboard.layouts.dashboard.admin', [
            'countBillData'                 => LogPayment::whereYear('created_at', date('Y'))->count(),
            'countPaymentCompleted'         => LogPayment::whereYear('created_at', date('Y'))->where('status_payment', 1)->count(),
            'countResponseConnected'        => LogPayment::whereYear('created_at', date('Y'))->where('status_reversal', 1)->count(),
            'countResponseConnectionFailed' => LogPayment::whereYear('created_at', date('Y'))->where('status_reversal', 0)->count(),
            'getHistoryApiAll'              => $getHistoryApiAll,
            'getCountHistoryApiAll'         => ApiEventHistories::whereYear('created_at', date('Y'))->count(),
            'getHistoryApiUsersH2HBPDJateng' => $getHistoryApiUsersH2HBPDJateng,
            'getQuantityRequestUser'        => $getQuantityRequestUser,
            'resultUserRequestActivate'     => User::whereIn('level_user', [3])->orderBy('id', 'DESC')->get()
        ]);
    }

    public function activatingUser(String $id)
    {
        $id             = Crypt::decryptString($id);
        $users          = User::find($id);
        $kode_activate  = SMSHelper::randomString(6);

        User::find($id)->update([
            'level_user'        => 4,
        ]);

        LogActivateSMS::create([
            'user_id'           => $id,
            'kode_activation'   => $kode_activate,
            'status'            => 1
        ]);

        SMSHelper::shortsms($users->no_hp, "Kode aktivasi REHATTA SERVICE : $kode_activate. Hanya berlaku 10 menit. by RSUD dr Rehatta");
        return redirect(request()->segment(1))->with(['success' => "Kode verifikasi kami kirim melalu SMS ke nomor user $users->name."]);
    }
}
