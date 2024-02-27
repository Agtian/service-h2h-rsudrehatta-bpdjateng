<?php

namespace App\Http\Controllers;

use App\Models\ApiEventHistories;
use Illuminate\Http\Request;

class ApiEventHistoriesController extends Controller
{
    public function index()
    {
        return view('layouts.api-event-histories.index', [
            'resultApiEventHistories'   => ApiEventHistories::paginate(10),
        ]);
    }
}
