<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class register_ctrl extends Controller
{
    public function register(){
        if(Auth::check()){
            return redirect()->back();
        }else{
            return view('auth.register');
        }
    }

    public function aksi_register(Request $req){
        session()->flush();

        $req->validate([
            'password'=>'min:8',
            'passwordC'=>'min:8',
        ],[
            'password.min' => "Password Minimal 8 Karakter",
            'passwordC.min' => "Password Minimal 8 Karakter"
        ]);

        $pass = $req->password;
        $cpass = $req->passwordC;
        $email = $req->email;
        $ce = count(user::where('email',$email)->get());

        if ($ce < 1){
            if($pass != $cpass){
                return redirect()->back()->withErrors(['msg'=>'Password Tidak Sama!!','bx1'=>'border']);
            }else{
                $parcel = [
                    'email' => $req->email,
                    'status_info' => 0,
                    'password'=>password_hash($pass,PASSWORD_DEFAULT)
                ];
                $send = User::create($parcel);
                if($send){
                    $data = array(
                        'email' => $req->email,
                        'password' => $req->password,
                    );
                    Auth::attempt($data);
                    return redirect('/');
                }else{
                    return redirect()->back()->withErrors(['msg'=>'Register Error!!']);
                }
            }
        }else{
            return redirect()->back()->withErrors(['msg'=>'Email Telah Ada!']);
        }
    }
}
