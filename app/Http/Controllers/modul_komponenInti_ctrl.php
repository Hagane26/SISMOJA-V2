<?php

namespace App\Http\Controllers;

use App\Models\dataModul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\komponen_inti;
use App\Models\ki_pembuka;
use App\Models\ki_kegiatan;
use App\Models\ki_penutup;

use App\Models\lampiran;

class modul_komponenInti_ctrl extends Controller
{
    public function index($step){
        Auth::check();

        if(!is_numeric($step) || session()->has('modul') == 0){
            return redirect()->back();
        }

        $modul = session()->get('modul');

        switch($step){
            case 1:
                $s_a = "border-2 border-primary";
                $go = "tujuan";
                break;
            case 2:
                $s_a = "border-2 border-primary";
                $go = "asasmen";
                break;
            case 3:
                $s_a = "border-2 border-primary";
                $go = "pemahaman";
                break;
            case 4:
                $s_a = "border-2 border-primary";
                $go = "pemantik";
                break;
            case 5:
                $s_a = "border-2 border-primary";
                $go = "pembukaan";
                break;
            case 6:
                $s_a = "border-2 border-primary";
                $go = "kegiatanInti";
                break;
            case 7:
                $s_a = "border-2 border-primary";
                $go = "penutup";
                break;
            case 8:
                $s_a = "border-2 border-primary";
                $go = "refleksi";
                break;
            case 9:
                $s_a = "bg-success text-white";
                $go = "selesai";
                break;
        }

        $data = [
            'judul' => $modul['judul'],
            'aksi' => 'komponenInti/' . $go . '-aksi',
            'pos' => $step - 1,
            'progress' => $step * 11,
            'view' => 'modul.2'.$go,

            'step1' => 'bg-success text-white',
            'step2' => $s_a,
            'step3' => '',
        ];

        return view('modul.2komponenInti',['res'=>$data,$modul]);
    }

    public function tujuan(Request $req){
        $modul = session()->get('modul');

        $req->validate([
            'tujuan' => 'required'
        ]);

        $parcel = komponen_inti::where('id',$modul['k1']['id'])->update([
            'tujuan' => $req->tujuan
        ]);

        if($parcel){
            $modul['k1'] = komponen_inti::where('id',$modul['k1']['id'])->get()->first();
            session(['modul'=>$modul]);
            return redirect('/modul/buat/komponenInti/2');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function asasmen(Request $req){
        $modul = session()->get('modul');

        $parcel = komponen_inti::where('id',$modul['k1']['id'])->update([
            'asasmen_diagnostik' => $req->ad,
            'asasmen_formatif' => $req->af,
            'asasmen_sumatif' => $req->as,
        ]);

        if($parcel){
            $modul['k1'] = komponen_inti::where('id',$modul['k1']['id'])->get()->first();
            session(['modul'=>$modul]);
            return redirect('/modul/buat/komponenInti/3');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function pemahaman(Request $req){
        $modul = session()->get('modul');

        $req->validate([
            'pemahaman' => 'required'
        ]);

        $parcel = komponen_inti::where('id',$modul['k1']['id'])->update([
            'pemahaman_bermakna' => $req->pemahaman
        ]);

        if($parcel){
            $modul['k1'] = komponen_inti::where('id',$modul['k1']['id'])->get()->first();
            session(['modul'=>$modul]);
            return redirect('/modul/buat/komponenInti/4');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function pemantik(Request $req){
        $modul = session()->get('modul');

        $req->validate([
            'pemantik' => 'required'
        ]);

        $parcel = komponen_inti::where('id',$modul['k1']['id'])->update([
            'pemantik' => $req->pemantik
        ]);

        if($parcel){
            $modul['k1'] = komponen_inti::where('id',$modul['k1']['id'])->get()->first();
            session(['modul'=>$modul]);
            return redirect('/modul/buat/komponenInti/5');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function pembukaan(Request $req){
        $modul = session()->get('modul');

        $req->validate([
            'p-1' => 'required',
            'p-2' => 'required',
            'p-3' => 'required',
            'p-4' => 'required',
            'p-5' => 'required',
            'p-6' => 'required',
            'p-7' => 'required',
            'waktu' => 'required'
        ]);

        $data = array();

        if($modul['k2']==0){
            for($i = 1;$i <= 7 ;$i++){
                $s = "p-". $i;
                $parcel = ki_pembuka::create([
                    'langkah' => 'kegiatan '. $i,
                    'isi' => $req[$s],
                    'waktu' => $req['waktu'],
                    'ki_id' => $modul['k1']['id']
                ]);
                $d = ki_pembuka::where('id',$parcel->id)->get()->first();
                array_push($data,$d);
            }
        }

        if($parcel){
            $modul['k2'] = $data;
            session(['modul'=>$modul]);
            return redirect('/modul/buat/komponenInti/6');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function kegiatanInti(Request $req){
        $modul = session()->get('modul');
        $len = (count($req->all()) - 1)/3;

        $data = array();

        for($i = 0; $i < $len; $i++){
            if($req['i_'.$i] == ""){
                return back()->withErrors($req['metode_'.$i] . " masih kosong, Silahkan Di isi terlebih dahulu!");
            }
        }

        if($modul['k3'] == 0){
            for($i = 0; $i < $len; $i++){
                $parcel = ki_kegiatan::create([
                    'metode' => $req['metode_'.$i],
                    'isi' => $req['i_'.$i],
                    'waktu' => $req['w_'.$i],
                    'ki_id' => $modul['k1']['id']
                ]);
                $d = ki_kegiatan::where('id',$parcel->id)->get()->first();
                array_push($data,$d);
            }
        }else{

        }

        if($parcel){
            $modul['k3'] = $data;
            session(['modul'=>$modul]);
            return redirect('/modul/buat/komponenInti/7');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }

    }

    public function penutup(Request $req){
        $modul = session()->get('modul');

        $req->validate([
            'p-1a' => 'required',
            'p-2a' => 'required',
            'p-3a' => 'required',
            'p-4a' => 'required',
            'p-5a' => 'required',

            'p-1b' => 'required',
            'p-2b' => 'required',
            'p-3b' => 'required',
            'p-4b' => 'required',
            'p-5b' => 'required',

            'waktu' => 'required'
        ]);

        $data = array();

        if($modul['k4']==0){
            for($i = 1;$i <= 5 ;$i++){
                $s = "p-". $i;
                $parcel = ki_penutup::create([
                    'langkah' => $req[$s .'c'],
                    'isi' => $req[$s.'a'],
                    'waktu' => $req[$s.'b'],
                    'ki_id' => $modul['k1']['id']
                ]);
                $d = ki_penutup::where('id',$parcel->id)->get()->first();
                array_push($data,$d);
            }
        }else{

        }

        if($parcel){
            $modul['k4'] = $data;
            session(['modul'=>$modul]);
            return redirect('/modul/buat/komponenInti/8');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function refleksi(Request $req){
        $modul = session()->get('modul');

        $req->validate([
            'refleksi' => 'required'
        ]);

        $parcel = komponen_inti::where('id',$modul['k1']['id'])->update([
            'refleksi' => $req->refleksi
        ]);

        if($parcel){
            $modul['k1'] = komponen_inti::where('id',$modul['k1']['id'])->get()->first();
            session(['modul'=>$modul]);
            return redirect('/modul/buat/komponenInti/9');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function selesai(){
        $modul = session()->get('modul');

        if($modul['l1'] == 0){
            $l = lampiran::create();
            dataModul::where('id',$modul['mod_id'])->update(['lampiran_id'=>$l->id]);
            $modul['l1'] = lampiran::where('id',$l->id)->get()->first();
            session(['modul'=>$modul]);
            return redirect('/modul/buat/lampiran/1');
        }else{
            return redirect('/modul/buat/lampiran/1');
        }
    }
}
