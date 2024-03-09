<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    public function index()
    {
        return view("template-dashboard.layouts.api-key.index");
    }
}
