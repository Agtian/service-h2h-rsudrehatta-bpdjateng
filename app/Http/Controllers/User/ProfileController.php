<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view("template-dashboard.layouts.profile.index", [
            'detailUser'    => User::find(Auth::user()->id),
            'detailApiKey'  => ApiKey::where('user_id', Auth::user()->id)->first(),
        ]);
    }
}
