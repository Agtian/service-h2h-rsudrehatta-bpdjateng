<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogServiceController extends Controller
{
    public function index()
    {
        return view("template-dashboard.layouts.log-service.index");
    }
}
