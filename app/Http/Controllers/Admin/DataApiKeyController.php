<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use Illuminate\Http\Request;

class DataApiKeyController extends Controller
{
    public function index()
    {
        return view('template-dashboard.layouts.data-api-key.index', [
            'resultAPIKEY'  => ApiKey::paginate(10),
        ]);
    }
}
