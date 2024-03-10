<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataApiKeyController extends Controller
{
    public function index()
    {
        return view('template-dashboard.layouts.data-api-key.index');
    }
}
