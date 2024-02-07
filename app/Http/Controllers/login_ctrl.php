<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class login_ctrl extends Controller
{
    public function login(){
        if(Auth::check()){
            return redirect()->back();
        }else{
            return view('auth.login');
        }
    }

    public function aksi_login(Request $req){
        $data = array(
            'email' => $req->email,
            'password' => $req->password,
        );

        if(Auth::attempt($data)){
            return redirect('/');
        }else{
            return redirect()->back()->withErrors(['msg'=>'Email atau Password Salah!!']);
        }
    }

    public function aksi_logout(){
        Auth::logout();
        session()->flush();
        return back();
    }
}
