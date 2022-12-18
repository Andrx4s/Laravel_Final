<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegisterValidation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        return view('users.login');
    }

    public function loginPost(LoginValidation $loginValidation)
    {
        if (Auth::attempt($loginValidation->validated())){
            $loginValidation->session()->regenerate();
            return redirect()->route('welcome')->with(['successlogin' => true]);
        }
        return back()->withErrors(['errorlogin' => true]);
    }

    public function register()
    {
        return view('users.register');
    }

    public function registerPost(RegisterValidation $registerValidation)
    {
        $registerValidations = $registerValidation->validated();
        $registerValidations['password'] = Hash::make($registerValidations['password']);
        User::create($registerValidations);
        return redirect()->route('login')->with(['success' => true]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('login');
    }

    public function find()
    {
        return view('pages.find');
    }
}
