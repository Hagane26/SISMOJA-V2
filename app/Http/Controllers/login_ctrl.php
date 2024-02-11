<?php

namespace App\Http\Controllers;

use App\Mail\sendMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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

    public function aksi_reset(Request $req){
        $req->validate([
            'email'=> 'required|email',
        ]);
        $em = DB::table('password_reset_tokens')->where('email',$req->email)->first();
        if($em == true){
            return back()->withErrors('Sudah Terkirim, Silahkan Cek Email.');
        }else{
            $token = Str::random(64);

            DB::table('password_reset_tokens')->insert([
                'email' => $req->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            $url = url('') . "/resetPassword/" . $token;

            Mail::to($req->email)->send(new sendMail($req->email,$token,$url));
            return redirect('/masuk')->withErrors('Silahkan Cek Email!');
        }
    }

    public function reset_view($token){
        $em = DB::table('password_reset_tokens')->where('token',$token)->first();
        if($em == true){
            return view('auth.resetPWD2',array('token'=>$token));
        }else{
            return redirect('/masuk')->withErrors('Tidak Valid!');
        }
    }

    public function reset_view_aksi(Request $req){
        $em = DB::table('password_reset_tokens')->where('token',$req->tokenReset)->get()->first();
        if($em == true){
            if($req->password != $req->konfirmasi){
                return back()->withErrors('Password Tidak Sama!');
            }else{
                $parcel = User::where('email',$em->email)->update([
                    'password'=>password_hash($req->password,PASSWORD_DEFAULT)
                ]);
                if($parcel){
                    DB::table('password_reset_tokens')->where('token',$req->tokenReset)->delete();
                    return redirect('/masuk')->withErrors('Password Telah diubah, silahkan Login.');
                }else{
                    return back()->withErrors('Terjadi Kesalahan Input, Coba lagi!');
                }
            }
        }else{
            return redirect('/masuk')->withErrors('Tidak Valid!');
        }
    }
}
