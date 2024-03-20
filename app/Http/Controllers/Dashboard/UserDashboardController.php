<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\LogPayment;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('template-dashboard.layouts.dashboard.user', [
            'countBillData'                 => LogPayment::whereYear('created_at', date('Y'))->count(),
            'countPaymentCompleted'         => LogPayment::whereYear('created_at', date('Y'))->where('status_payment', 1)->count(),
            'countResponseConnected'        => LogPayment::whereYear('created_at', date('Y'))->where('status_reversal', 1)->count(),
            'countResponseConnectionFailed' => LogPayment::whereYear('created_at', date('Y'))->where('status_reversal', 0)->count(),
        ]);
    }
}
