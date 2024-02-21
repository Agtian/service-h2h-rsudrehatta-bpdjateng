<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TableUserAccountController extends Controller
{
    public function index()
    {
        return view('layouts.table-user-account.index', [
            'resultUserAccount' => User::paginate(10),
        ]);
    }
}
