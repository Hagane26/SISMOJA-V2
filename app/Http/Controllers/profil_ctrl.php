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
            ]);
            $new = User::where('id',$request->id)->update($parcel[0]);
            if($new){
                Auth::logout();
                return Redirect::to('masuk');
            }
        }
    }
}
