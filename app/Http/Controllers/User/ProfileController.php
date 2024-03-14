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
            'formInputKodeActivate' => $users->level_user == 3 ? true : false,
            'formModalActivate'     => $users->level_user != 0 && $users->level_user != 5 ? true : false,
        ]);
    }

    public function activateAccount()
    {
        $users          = User::find(Auth::user()->id);
        $kode_activate  = SMSHelper::randomString(6);

        User::find(Auth::user()->id)->update([
            'level_user'        => 3,
        ]);

        LogActivateSMS::create([
            'user_id'           => Auth::user()->id,
            'kode_activation'   => $kode_activate,
            'status'            => 1
        ]);

        SMSHelper::shortsms($users->no_hp, "Kode aktivasi REHATTA SERVICE : $kode_activate. Hanya berlaku 10 menit. by RSUD dr Rehatta");
        return redirect(request()->segment(1))->with(['success' => 'Kode verifikasi kami kirim melalu SMS ke nomor anda.']);
    }
}
