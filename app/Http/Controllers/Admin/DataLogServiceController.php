<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiEventHistories;
use Illuminate\Http\Request;

class DataLogServiceController extends Controller
{
    public function index()
    {
        return view('template-dashboard.layouts.data-log-service.index', [
            'resultLogService'  => ApiEventHistories::paginate(10)
        ]);
    }
}
