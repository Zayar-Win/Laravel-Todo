<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ViewController extends Controller
{
    public function home(Request $request)
    {

        $user = auth()->user();


        $todos = $user->todos;

        return view('welcome', [
            'todos' => $todos,
        ]);
    }

    public function about(Request $request)
    {

        $name = $request->session()->get('name');
        $email = cache('email');
        dd($email);

        return view('about');
    }

    public function register(UserRegister $request)
    {


        return redirect(route('home'));
    }

    public function login(Request $request) {}
}
