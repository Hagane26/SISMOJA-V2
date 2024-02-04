<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\infoUmum;
use App\Models\i_identitas;
use App\Models\i_ppp;
use App\Models\i_modelp;
use Illuminate\Support\Facades\Auth;

class modul_informasiUmum_ctrl extends Controller
{

    public function infoUmum($step){
        Auth::check();

        if(!is_numeric($step) || session()->has('modul') == 0){
            return redirect()->back();
        }

        $modul = session()->get('modul');

        switch($step){
            case 1:
                $go = "identitas";
                break;
            case 2:
                $go = "komponenAwal";
                break;
            case 3:
                $go = "ppp";
                break;
            case 4:
                $go = "sarana";
                break;
            case 5:
                $go = "target";
                break;
            case 6:
                $go = "model";
                break;
            case 'selesai':
                $go = "selesai";
                break;
        }

        $s_a = "border-2 border-primary";

        $data = [
            'judul' => $modul['judul'],
            'aksi' => 'informasiUmum/' . $go . '-aksi',
            'pos' => $step - 1,
            'progress' => $step * 20,
            'view' => 'modul.1'.$go,

            'step1' => $s_a,
            'step2' => '',
            'step3' => '',
        ];

        return view('modul.1informasiUmum',['res'=>$data,$modul]);
    }

    public function identitas(Request $req){

        $modul = session()->get('modul');

        $req->validate([
            'penyusun'=>'required',
            'institusi'=>'required',
            'mapel'=>'required',
            'fase'=>'required',
            'kelas'=>'required',
            'TA_awal'=>'required',
            'TA_akhir'=>'required',
            'kali'=>'required',
            'waktu'=>'required'
        ],[
            //untuk custom pesan gagal nya
            'penyusun.required' => "Nama Penyusun Kosong",
            'institusi.required' => "Institusi Kosong",
        ]);

        if($modul['i1'] == 0){
            
        }
    }

}
