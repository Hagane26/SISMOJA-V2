<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\dataModul;
use Illuminate\Support\Facades\Auth;

class dashboard_ctrl extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function modul_buat(){
        return view('modul.1buat');
    }

    public function modul_buat_aksi(Request $req){
        Auth::check();
        $req->validate([
            'judul' => 'required',
        ],[
            'judul.required' => 'Silahkan Isi Judul terlebih dahulu!',
        ]);

        $parcel = dataModul::create(['judul'=>$req->judul,'users_id'=>Auth::user()->id]);
        if($parcel){
            $data = [
                'mod_id'=>$parcel->id,
                'judul' => $parcel->judul,
                'i1' => 0,
                'i2' => 0,
                'i3' => 0,
                'k1' => 0,
                'k2' => 0,
                'k3' => 0,
                'l' => 0,
            ];
            session(['modul'=>$data]);
            return redirect('/modul/buat/informasiUmum/1');
        }else{
            return redirect()->back()->withErrors('Gagal Membuat Modul!');
        }
    }
}
