<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(){
        return view('register');
    }

    public function store(Request $request){
        $user = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'=> 'required|min:8|confirmed',
        ]);

        $user['password'] = Hash::make($user['password']);

        User::create($user);

        $request->session()->regenerate();

        return redirect('/login');
    }
}
