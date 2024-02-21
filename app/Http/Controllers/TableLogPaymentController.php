<?php

namespace App\Http\Controllers;

use App\Models\LogPayment;
use Illuminate\Http\Request;

class TableLogPaymentController extends Controller
{
    public function index()
    {
        return view('layouts.table-log-payment.index', [
            'resultLogPayments' => LogPayment::paginate(10),
        ]);
    }
}
