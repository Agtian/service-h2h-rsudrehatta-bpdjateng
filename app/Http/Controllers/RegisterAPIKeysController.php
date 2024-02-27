<?php

namespace App\Http\Controllers;

class RegisterAPIKeysController extends Controller
{
    public function index()
    {
        return view('layouts.register-api-keys.index');
    }
}
