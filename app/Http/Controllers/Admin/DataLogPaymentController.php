<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataLogPaymentController extends Controller
{
    public function index()
    {
        return view('template-dashboard.layouts.data-log-payment.index');
    }
}
