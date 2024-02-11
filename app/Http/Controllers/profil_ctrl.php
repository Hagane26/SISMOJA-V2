<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class profil_ctrl extends Controller
{

    public function index(){
        return view('users.profile');
    }
    public function update(Request $request){

        $request->validate([
            'nama' => 'required',
            'nik' => 'required|size:16',
            'tanggal_lahir' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'telepon' => 'required',
        ]);

        $data = User::where('id',$request->id)->get()->first();
        if($data){
            $parcel = array([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'tanggal_lahir' => $request->tglLahir,
                'gender' => $request->gender,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'status_info' => 1
            ]);
            $new = User::where('id',$request->id)->update($parcel[0]);
            if($new){
                Auth::logout();
                return Redirect::to('masuk');
            }
        }
    }

    public function ubahPassword(Request $req){

        $req->validate([
            'pLama' => 'min:8',
        ]);

        $arr = array(
            'email' => $req->email,
            'password' => $req->pLama,
        );

        if(Auth::attempt($arr)){

            if($req->pBaru == $req->konfirmasi){
                $parcel = User::where('email',$req->email)->update([
                    'password'=>password_hash($req->pBaru,PASSWORD_DEFAULT)
                ]);
                if($parcel){
                    return redirect('/profil')->withErrors('Password Telah Diubah!');
                }else{
                    return redirect('/profil')->withErrors('Password Gagal Diubah!');
                }
            }
        }else{
            return redirect()->back()->withErrors(['msg'=>'Email atau Password Salah!!']);
        }
    }
}
