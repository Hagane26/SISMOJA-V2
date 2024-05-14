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

use App\Models\i_modelp;

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
            'status' => '',
            'pos' => $step - 1,
            'progress' => ($step-1) * (100 / 7),
            'view' => 'modul.2'.$go,

            'step1' => 'bg-success text-white',
            'step2' => $s_a,
            'step3' => '',

            'batal' => '/modul',
            'pertemuan' => 1
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

        if($modul['k2']==""){
            for($i = 1;$i <= 7 ;$i++){
                $s = "p-". $i;
                $parcel = ki_pembuka::create([
                    'langkah' => 'kegiatan '. $i,
                    'isi' => $req[$s],
                    'pertemuan' => 1,
                    'waktu' => $req['waktu'],
                    'ki_id' => $modul['k1']['id']
                ]);
            }
        }else{
            for($i = 1;$i <= 7 ;$i++){
                $s = "p-". $i;
                $parcel = ki_pembuka::where('id',$modul['k2'][$i-1]['id'])->update([
                    'langkah' => 'kegiatan '. $i,
                    'isi' => $req[$s],
                    'waktu' => $req['waktu'],
                ]);
            }
        }

        if($parcel){
            $data = ki_pembuka::where('ki_id',$modul['k1']['id'])->get()->all();
            $modul['k2'] = $data;
            $modul['wpembuka'] = $req['waktu'];
            session(['modul'=>$modul]);
            return redirect('/modul/buat/komponenInti/6');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function kegiatanInti(Request $req){
        $modul = session()->get('modul');

        $data = array();

        $req->validate([
            'kegiataninti' => 'required',
        ]);

        if($req['waktu'] <= 0 || $req['waktu'] == ""){
            return back()->withErrors("Waktu Tidak Valid");
        }

        if($modul['k3'] == ""){
            $parcel = ki_kegiatan::create([
                'metode' => "",
                'isi' => $req['kegiataninti'],
                'status' => '',
                'waktu' => $req['waktu'],
                'pertemuan' => 1,
                'ki_id' => $modul['k1']['id']
            ]);
        }else{
            $parcel = ki_kegiatan::where('id',$modul['k3']['id'])->update([
                'metode' => "",
                'isi' => $req['kegiataninti'],
                'waktu' => $req['waktu'],
            ]);
        }

        if($parcel){
            $data = ki_kegiatan::where('ki_id',$modul['k1']['id'])->get()->first();
            $modul['k3'] = $data;
            $modul['winti'] = $req->waktu;
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

        ]);

        $data = array();

        if($modul['k4']==""){
            for($i = 1;$i <= 5 ;$i++){
                $s = "p-". $i;
                $parcel = ki_penutup::create([
                    'langkah' => $req[$s .'c'],
                    'isi' => $req[$s.'a'],
                    'status' => '',
                    'waktu' => $req[$s.'b'],
                    'pertemuan' => 1,
                    'ki_id' => $modul['k1']['id']
                ]);
            }
        }else{
            for($i = 1;$i <= 5 ;$i++){
                $s = "p-". $i;
                $parcel = ki_penutup::where('id',$modul['k4'][$i]['id'])->update([
                    'langkah' => $req[$s .'c'],
                    'isi' => $req[$s.'a'],
                    'waktu' => $req[$s.'b'],
                ]);
            }
        }

        if($parcel){
            $data = ki_penutup::where('ki_id',$modul['k1']['id'])->get()->all();
            $modul['k4'] = $data;
            $modul['wpenutup'] = $req->total_waktu;
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
            'refleksi' => $req->refleksi,
            'pertemuan_total' => 1,
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

        if($modul['l1'] == ""){
            $l = lampiran::create();
            dataModul::where('id',$modul['mod_id'])->update(['lampiran_id'=>$l->id]);
            $modul['l1'] = lampiran::where('id',$l->id)->get()->first();
            session(['modul'=>$modul]);
            return redirect('/modul/buat/lampiran/1');
        }else{
            return redirect('/modul/buat/lampiran/1');
        }
    }

    //1
    public function tujuan_edit(Request $req){
        $mod = dataModul::where('id',$req->mod_id)->get()->first();
        $ki = komponen_inti::where('id',$mod->komponen_id)->get()->first();

        $data = [
            'judul' => $mod->judul,
            'aksi' => 'edit/komponeninti/tujuan-aksi',
            'view' => 'modul.2tujuan',
        ];

        $modul = ['id'=>$req->mod_id];
        $modul['k1'] = $ki;

        session(['modul'=> $modul]);

        return view('modul.1edit_informasiUmum',['res'=>$data]);
    }

    public function tujuan_edit_aksi(Request $req){
        $s = session()->get('modul');
        $mod = dataModul::where('id',$s['id'])->get()->first();

        $req->validate([
            'tujuan'=>'required',
        ],[
            //untuk custom pesan gagal nya
            'tujuan.required' => "Nama Penyusun Kosong",
        ]);

        $data = [
            'tujuan' => $req->tujuan
        ];

        $parcel = komponen_inti::where('id',$mod->komponen_id)->update($data);

        if($parcel){
            return redirect('/modul');
        }

        session()->forget('modul');
    }

    //2
    public function asasmen_edit(Request $req){
        $mod = dataModul::where('id',$req->mod_id)->get()->first();
        $ki = komponen_inti::where('id',$mod->komponen_id)->get()->first();

        $data = [
            'judul' => $mod->judul,
            'aksi' => 'edit/komponeninti/asasmen-aksi',
            'view' => 'modul.2asasmen',
        ];

        $modul = ['id'=>$req->mod_id];
        $modul['k1'] = $ki;

        session(['modul'=> $modul]);

        return view('modul.1edit_informasiUmum',['res'=>$data]);
    }

    public function asasmen_edit_aksi(Request $req){
        $s = session()->get('modul');
        $mod = dataModul::where('id',$s['id'])->get()->first();

        $data = [
            'asasmen_diagnostik' => $req->ad,
            'asasmen_formatif' => $req->af,
            'asasmen_sumatif' => $req->as,
        ];

        $parcel = komponen_inti::where('id',$mod->komponen_id)->update($data);

        if($parcel){
            return redirect('/modul');
        }

        session()->forget('modul');
    }

    //3
    public function pemahaman_edit(Request $req){
        $mod = dataModul::where('id',$req->mod_id)->get()->first();
        $ki = komponen_inti::where('id',$mod->komponen_id)->get()->first();

        $data = [
            'judul' => $mod->judul,
            'aksi' => 'edit/komponeninti/pemahaman-aksi',
            'view' => 'modul.2pemahaman',
        ];

        $modul = ['id'=>$req->mod_id];
        $modul['k1'] = $ki;

        session(['modul'=> $modul]);

        return view('modul.1edit_informasiUmum',['res'=>$data]);
    }

    public function pemahaman_edit_aksi(Request $req){
        $s = session()->get('modul');
        $mod = dataModul::where('id',$s['id'])->get()->first();

        $req->validate([
            'pemahaman' => 'required',
        ]);

        $data = [
            'pemahaman_bermakna' => $req->pemahaman
        ];

        $parcel = komponen_inti::where('id',$mod->komponen_id)->update($data);

        if($parcel){
            return redirect('/modul');
        }

        session()->forget('modul');
    }

    //3
    public function pemantik_edit(Request $req){
        $mod = dataModul::where('id',$req->mod_id)->get()->first();
        $ki = komponen_inti::where('id',$mod->komponen_id)->get()->first();

        $data = [
            'judul' => $mod->judul,
            'aksi' => 'edit/komponeninti/pemantik-aksi',
            'view' => 'modul.2pemantik',
        ];

        $modul = ['id'=>$req->mod_id];
        $modul['k1'] = $ki;

        session(['modul'=> $modul]);

        return view('modul.1edit_informasiUmum',['res'=>$data]);
    }

    public function pemantik_edit_aksi(Request $req){
        $s = session()->get('modul');
        $mod = dataModul::where('id',$s['id'])->get()->first();

        $req->validate([
            'pemantik' => 'required',
        ]);

        $data = [
            'pemantik' => $req->pemantik
        ];

        $parcel = komponen_inti::where('id',$mod->komponen_id)->update($data);

        if($parcel){
            return redirect('/modul');
        }

        session()->forget('modul');
    }

    public function PertemuanIndex($step){
        Auth::check();
        $modul = session()->get('modul');
        switch($step){
            case 1:
                $go = 'modul.1model';
                break;
            case 2:
                $go = 'modul.2pembukaan';
                break;
            case 3:
                $go = 'modul.2kegiatanInti';
                break;
            case 4:
                $go = 'modul.2penutup';
                break;
            default:
                echo "tidak ada";
                break;
        }

        if($step != "selesai"){
            $pertemuan = $modul['data_komponen_inti']->pertemuan_total + 1;
            $data = [
                'judul' => $modul['judul'],
                'nav' => '/modul/tambah/pertemuan/',
                'status' => 'Tambah',
                'pertemuan' => $pertemuan,
                'aksi' => 'p'.$step,
                'pos' => $step - 1,
                'progress' => ($step-1) * (99 / 3),
                'view' => $go,
                'batal' => '/modul'
            ];
            $identitas = $modul['data_informasi']['identitas'];
            $modul['waktu'] = $identitas->waktu * $identitas->kali;
            $modul['pertemuan'] = $pertemuan;
            return view('modul.4pertemuan',['res'=>$data,$modul]);
        }
    }

    public function pertemuan1_aksi(Request $req){
        $modul = session()->get('modul');

        $pec = 4;
        $moc = 4;
        $mec = 7;
        $tec = 7;

        $data = array();
        $btn = array();
        $kat = array();

        $wt = 0;
        $total = $pec + $moc + $mec + $tec;

        for($i = 0; $i < $pec;$i++){
            $s = "pe-" . $i + 1;
            if($i+1 == $pec){
                array_push($data,$req[$s.'i']);
            }else{
                array_push($data,$req[$s]);
            }
            array_push($btn,$s);
            array_push($kat,'Pendekatan');
        }

        for($i = 0; $i < $moc;$i++){
            $s = "mo-" . $i + 1;
            if($i+1 == $moc){
                array_push($data,$req[$s.'i']);
            }else{
                array_push($data,$req[$s]);
            }
            array_push($btn,$s);
            array_push($kat,'Model');
        }

        for($i = 0; $i < $mec;$i++){
            $s = "me-" . $i + 1;
            if($i+1 == $mec){
                array_push($data,$req[$s.'i']);
            }else{
                array_push($data,$req[$s]);
            }
            array_push($btn,$s);
            array_push($kat,'Metode');
        }

        for($i = 0; $i < $tec;$i++){
            $s = "te-" . $i + 1;
            if($i+1 == $tec){
                array_push($data,$req[$s.'i']);
            }else{
                array_push($data,$req[$s]);
            }
            array_push($btn,$s);
            array_push($kat,'Teknik');
        }

        for( $i = 0;$i < $total;$i++){
            $parcel = i_modelp::create([
                'metode' => $data[$i],
                'kategori' => $kat[$i],
                'btn' => $btn[$i],
                'pertemuan' => $modul['pertemuan'],
                'informasi_id' => $modul['informasi_id'],
            ]);
            if($data[$i] != ""){
                $wt +=1;
            }
        }

        if($parcel){
            $data = i_modelp::where('informasi_id',$modul['data_informasi']->id)->get()->all();
            session(['modul'=>$modul]);
            return redirect('/modul/tambah/pertemuan/2');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }

    }

    public function pertemuan2_aksi(Request $req){
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

        for($i = 1;$i <= 7 ;$i++){
            $s = "p-". $i;
            $parcel = ki_pembuka::create([
                'langkah' => 'kegiatan '. $i,
                'isi' => $req[$s],
                'waktu' => $req['waktu'],
                'pertemuan' => $modul['pertemuan'],
                'ki_id' => $modul['data_komponen_inti']->id
            ]);
        }

        if($parcel){
            $data = ki_pembuka::where('ki_id',$modul['data_komponen_inti']->id)->get()->all();
            $modul['k2'] = $data;
            $modul['wpembuka'] = $req['waktu'];
            session(['modul'=>$modul]);
            return redirect('/modul/tambah/pertemuan/3');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function pertemuan3_aksi(Request $req){
        $modul = session()->get('modul');

        $data = array();

        $req->validate([
            'kegiataninti' => 'required',
        ]);

        if($req['waktu'] <= 0 || $req['waktu'] == ""){
            return back()->withErrors("Waktu Tidak Valid");
        }

        $parcel = ki_kegiatan::create([
            'metode' => "",
            'isi' => $req['kegiataninti'],
            'waktu' => $req['waktu'],
            'pertemuan' => $modul['pertemuan'],
            'ki_id' => $modul['data_komponen_inti']->id
        ]);

        if($parcel){
            $data = ki_kegiatan::where('ki_id',$modul['data_komponen_inti']->id)->get()->first();
            $modul['k3'] = $data;
            $modul['winti'] = $req->waktu;
            session(['modul'=>$modul]);
            return redirect('/modul/tambah/pertemuan/4');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function pertemuan4_aksi(Request $req){
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

        ]);

        $data = array();

        for($i = 1;$i <= 5 ;$i++){
            $s = "p-". $i;
            $parcel = ki_penutup::create([
                'langkah' => $req[$s .'c'],
                'isi' => $req[$s.'a'],
                'waktu' => $req[$s.'b'],
                'pertemuan' => $modul['pertemuan'],
                'ki_id' => $modul['data_komponen_inti']->id
            ]);
        }

        if($parcel){
            $data = ki_penutup::where('ki_id',$modul['data_komponen_inti']->id)->get()->all();
            $modul['k4'] = $data;
            $modul['wpenutup'] = $req->total_waktu;
            session(['modul'=>$modul]);
            return redirect('/modul/pertemuan/ditambahkan');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function pertemuanditambahkan_aksi(){
        $modul = session()->get('modul');
        $ki = $modul['data_komponen_inti'];
        $kidb = komponen_inti::where('id',$ki->id)->get()->first();
        if($modul['pertemuan'] != $kidb['pertemuan_total']){
            komponen_inti::where('id',$ki->id)->update([
                'pertemuan_total'=> $kidb['pertemuan_total'] + 1
            ]);
        }
        return view('modul.4selesai');
    }

    public function PertemuanEditIndex($id, $step){
        Auth::check();
        $modul = session()->get('modul');
        switch($step){
            case 1:
                $go = 'modul.1model';
                break;
            case 2:
                $go = 'modul.2pembukaan';
                break;
            case 3:
                $go = 'modul.2kegiatanInti';
                break;
            case 4:
                $go = 'modul.2penutup';
                break;
            default:
                echo "tidak ada";
                break;
        }

        if($step != "selesai"){
            $pertemuan = $modul['data_komponen_inti']->pertemuan_total + 1;
            $data = [
                'judul' => $modul['judul'],
                'nav' => '/modul/edit/pertemuan/'.$id.'/',
                'status' => 'Edit',
                'pid' => $id,
                'pertemuan' => $id,
                'aksi' => 'p'.$step,
                'pos' => $step - 1,
                'progress' => ($step-1) * (99 / 3),
                'view' => $go,
                'batal' => '/modul'
            ];
            $identitas = $modul['data_informasi']['identitas'];
            $modul['waktu'] = $identitas->waktu * $identitas->kali;
            $modul['pertemuan'] = $pertemuan;
            return view('modul.4pertemuan',['res'=>$data,$modul]);
        }
    }

    public function pertemuan1_aksi_edit(Request $req){
        $modul = session()->get('modul');

        $pec = 4;
        $moc = 4;
        $mec = 7;
        $tec = 7;

        $data = array();
        $btn = array();
        $kat = array();

        $wt = 0;
        $total = $pec + $moc + $mec + $tec;

        for($i = 0; $i < $pec;$i++){
            $s = "pe-" . $i + 1;
            if($i+1 == $pec){
                array_push($data,$req[$s.'i']);
            }else{
                array_push($data,$req[$s]);
            }
            array_push($btn,$s);
            array_push($kat,'Pendekatan');
        }

        for($i = 0; $i < $moc;$i++){
            $s = "mo-" . $i + 1;
            if($i+1 == $moc){
                array_push($data,$req[$s.'i']);
            }else{
                array_push($data,$req[$s]);
            }
            array_push($btn,$s);
            array_push($kat,'Model');
        }

        for($i = 0; $i < $mec;$i++){
            $s = "me-" . $i + 1;
            if($i+1 == $mec){
                array_push($data,$req[$s.'i']);
            }else{
                array_push($data,$req[$s]);
            }
            array_push($btn,$s);
            array_push($kat,'Metode');
        }

        for($i = 0; $i < $tec;$i++){
            $s = "te-" . $i + 1;
            if($i+1 == $tec){
                array_push($data,$req[$s.'i']);
            }else{
                array_push($data,$req[$s]);
            }
            array_push($btn,$s);
            array_push($kat,'Teknik');
        }
        
        for( $i = 0;$i < $total;$i++){
            $k = "k-".$i;
            $parcel = i_modelp::where('id',$req[$k])->update([
                'metode' => $data[$i],
                'kategori' => $kat[$i],
                'btn' => $btn[$i],
            ]);
            if($data[$i] != ""){
                $wt +=1;
            }
        }

        if($parcel){
            $data = i_modelp::where('informasi_id',$modul['data_informasi']->id)->get()->all();
            session(['modul'=>$modul]);
            return redirect('/modul/tambah/pertemuan/2');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }

    }

    public function pertemuan2_aksi_edit(Request $req){
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

        for($i = 1;$i <= 7 ;$i++){
            $s = "p-". $i;
            $k = "k-".$i-1;
            $parcel = ki_pembuka::where('id',$req[$k])->update([
                'isi' => $req[$s],
                'waktu' => $req['waktu'],
            ]);
        }

        if($parcel){
            $data = ki_pembuka::where('ki_id',$modul['data_komponen_inti']->id)->get()->all();
            $modul['k2'] = $data;
            $modul['wpembuka'] = $req['waktu'];
            session(['modul'=>$modul]);
            return redirect('/modul/edit/pertemuan/'.$req['pertemuan'].'/3');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function pertemuan3_aksi_edit(Request $req){
        $modul = session()->get('modul');

        $data = array();

        $req->validate([
            'kegiataninti' => 'required',
        ]);

        if($req['waktu'] <= 0 || $req['waktu'] == ""){
            return back()->withErrors("Waktu Tidak Valid");
        }

        $parcel = ki_kegiatan::where('id',$req['k-kid'])->update([
            'isi' => $req['kegiataninti'],
            'waktu' => $req['waktu'],
        ]);

        if($parcel){
            $data = ki_kegiatan::where('ki_id',$modul['data_komponen_inti']->id)->get()->first();
            $modul['k3'] = $data;
            $modul['winti'] = $req->waktu;
            session(['modul'=>$modul]);
            return redirect('/modul/edit/pertemuan/'.$req['pertemuan'].'/4');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function pertemuan4_aksi_edit(Request $req){
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

        ]);

        $data = array();

        for($i = 1;$i <= 5 ;$i++){
            $s = "p-". $i;
            $k = "k-".$i-1;
            $parcel = ki_penutup::where('id',$req[$k])->update([
                'isi' => $req[$s.'a'],
                'waktu' => $req[$s.'b'],
            ]);
        }

        if($parcel){
            $data = ki_penutup::where('ki_id',$modul['data_komponen_inti']->id)->get()->all();
            $modul['k4'] = $data;
            $modul['wpenutup'] = $req->total_waktu;
            session(['modul'=>$modul]);
            return redirect('/modul/pertemuan/ditambahkan');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function pertemuandiedit_aksi(){
        $modul = session()->get('modul');
        $ki = $modul['data_komponen_inti'];
        $kidb = komponen_inti::where('id',$ki->id)->get()->first();
        if($modul['pertemuan'] != $kidb['pertemuan_total']){
            komponen_inti::where('id',$ki->id)->update([
                'pertemuan_total'=> $kidb['pertemuan_total'] + 1
            ]);
        }
        return view('modul.4selesai');
    }

    public function pertemuanck(){
        $modul = session()->get('modul');
        dd($modul);
    }
}
