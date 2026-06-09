<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {

        $name = $request->session()->get('name');
        dd($name);
        return view('admin.dashboard');
    }
}
