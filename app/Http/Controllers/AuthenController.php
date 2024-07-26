<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenController extends Controller
{
    public function login() {
        return view('login.login');
    }

    public function postLogin(Request $request) {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập password'
        ]);

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect()->route('/.index');
        }else{
            return redirect()->back()->with('msgErrors', 'Email hoặc mật khẩu không chính xác!');
        }
    }
}
