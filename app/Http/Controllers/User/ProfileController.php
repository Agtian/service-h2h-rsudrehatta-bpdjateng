<?php

namespace App\Http\Controllers\User;

use App\Helpers\SMSHelper;
use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use App\Models\LogActivateSMS;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $users = User::find(Auth::user()->id);

        return view("template-dashboard.layouts.profile.index", [
            'detailUser'            => User::find(Auth::user()->id),
            'detailApiKey'          => ApiKey::where('user_id', Auth::user()->id)->first(),
            'formInputKodeActivate' => $users->level_user,
            'formModalActivate'     => $users->level_user != 0 && $users->level_user != 5 ? true : false,
        ]);
    }

    public function activateAccount()
    {
        User::find(Auth::user()->id)->update([
            'level_user'        => 3,
        ]);

        SMSHelper::shortsms('085799099380', "Hai bro, segera konfirmasi akun baru di REHATTA SERVICE");

        return redirect(request()->segment(1))->with(['success' => 'Silahkan tunggu, admin akan memproses akun anda dan kode verifikasi akan kami kirim melalu SMS ke nomor anda.']);
    }

    public function validatedSuccess($kode_activation)
    {
        LogActivateSMS::where([
            ['kode_activation', $kode_activation],
            ['user_id', Auth::user()->id],
            ['status', 1]
        ])->update([
            'status' => 2 // not active
        ]);

        ApiKey::where('user_id', Auth::user()->id)->update([
            'status_api_key' => 1, // developer
        ]);

        User::find(Auth::user()->id)->update([
            'level_user' => 1 // user
        ]);

        return redirect()->route('blankPage')->with(['success' => 'Akun dan key developer anda sudah aktif. Silahkan Log Out dan Login kembali']);
    }

    public function verificationCode(Request $request)
    {
        $validated = $request->validate([
            'kode_activation'  => 'required|max:6|min:6'
        ]);

        $logActivateSMS = LogActivateSMS::where([
            ['kode_activation', $validated['kode_activation']],
            ['user_id', Auth::user()->id],
            ['status', 1]
        ])->first();

        if ($logActivateSMS == null) {
            return redirect(request()->segment(1))->with(['warning' => 'Kode verifikasi salah.']);
        }

        $selisihDetik = SMSHelper::differenceTime($logActivateSMS->created_at, date('H:i:s'));
        $maxDetik     = 600;
        $day          = SMSHelper::differenceDay(date('Y-m-d'), date('Y-m-d', strtotime($logActivateSMS->created_at)));

        if ($day == 0) {
            if (date('H', strtotime($logActivateSMS->created_at)) == date('H')) {
                if ($selisihDetik < $maxDetik) {
                    return $this->validatedSuccess($validated['kode_activation']);
                }
            }
        }

        LogActivateSMS::find($logActivateSMS->id)->update(['status' => 2]); // not active
        User::find(Auth::user()->id)->update(['level_user' => 0]); // user tidak aktif
        return redirect(request()->segment(1))->with(['warning' => 'Kode verifikasi sudah kadaluarsa, silahkan aktivasi lagi']);
    }
}
