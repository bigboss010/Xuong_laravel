<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Email không đúng định dạng!',
            'password.required' => 'Vui lòng nhập password!'
        ]);
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $remember = $request->remember;
        if(Auth::attempt($data, $remember)) {
            if(Auth::user()->chuc_vu_id == 1){
                return redirect()->route('admin.index');
            }else if(Auth::user()->chuc_vu_id == 2){
                return redirect()->route('/.index');
            }else{
                return redirect()->route('/.index');
            }
        }else{
            return redirect()->back()->with('msgErrors', 'Email hoặc mật khẩu không chính xác!');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('/.index');
    }

    public function register() {
        return view('login.register');
    }

    public function postRegister(Request $request) {
        $check = User::where('email', $request->email)->exists();
        if($check){
            return redirect()->back()->with('errors', 'Email đã tồn tại!');
        }else{
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ];
            $newUser = User::create($data);
            // Auth::login($newUser);
            return redirect()->route('login')
            ->with('success', 'Đăng ký thành công! Hãy đăng nhập nào!');
        }
    }

    // public function getAuth(){
    //     $auth = Auth::user();
    //     return view('layouts.clients.partials.header-top', compact('auth'));
    // }
}
