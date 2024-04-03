<?php

namespace App\Http\Controllers;

use App\Models\dataModul;
use Illuminate\Http\Request;

use App\Models\infoUmum;
use App\Models\i_identitas;
use App\Models\i_ppp;
use App\Models\i_modelp;

use App\Models\komponen_inti;
use Illuminate\Support\Facades\Auth;

class modul_informasiUmum_ctrl extends Controller
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
                $go = "identitas";
                break;
            case 2:
                $s_a = "border-2 border-primary";
                $go = "komponenAwal";
                break;
            case 3:
                $s_a = "border-2 border-primary";
                $go = "ppp";
                break;
            case 4:
                $s_a = "border-2 border-primary";
                $go = "sarana";
                break;
            case 5:
                $s_a = "border-2 border-primary";
                $go = "target";
                break;
            case 6:
                $s_a = "border-2 border-primary";
                $go = "model";
                break;
            case 7:
                $s_a = "bg-success text-white";
                $go = "selesai";
                break;
        }

        $data = [
            'judul' => $modul['judul'],
            'aksi' => 'informasiUmum/' . $go . '-aksi',
            'pos' => $step - 1,
            'progress' => ($step-1) * (100 / 5),
            'view' => 'modul.1'.$go,

            'step1' => "$s_a",
            'step2' => '',
            'step3' => '',

            'batal' => '/modul'
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

        $data = [
            'nama' => $req->penyusun,
            'institusi' => $req->institusi,
            'mapel' => $req->mapel,
            'fase' => $req->fase,
            'kelas' => $req->kelas,
            'TAwal' => $req->TA_awal,
            'TAkhir' => $req->TA_akhir,
            'kali' => $req->kali,
            'waktu' => $req->waktu,
        ];

        $waktu = $req->waktu * $req->kali;

        if($modul['i2'] == ""){
            $parcel = i_identitas::create($data);
        }else{
            $parcel = i_identitas::where('id',$modul['i1']['id'])->update($data);
        }

        if($parcel){
            $infoUmum = infoUmum::where('id',$modul['i1']['id'])->update(['identitas_id'=>$parcel->id]);
            $data_iu = infoUmum::where('id',$modul['i1']['id'])->get()->first();
            $modul['i1'] = $data_iu;
            $modul['i2'] = $parcel;
            $modul['waktu'] = $waktu;
            session(['modul'=>$modul]);
            return redirect('/modul/buat/informasiUmum/2');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function komponenAwal(Request $req){
        $modul = session()->get('modul');

        $req->validate([
            'komponen' => 'required'
        ]);

        $parcel = infoUmum::where('id',$modul['i1']['id'])->update(['komponenAwal'=>$req->komponen]);

        if($parcel){
            $data = infoUmum::where('id',$modul['i1']['id'])->get()->first();
            $modul['i1'] = $data;
            session(['modul'=>$modul]);
            return redirect('/modul/buat/informasiUmum/3');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function profilPancasila(Request $req){
        $modul = session()->get('modul');

        $subjudul = [
            'Beriman, Bertakwa kepada Tuhan Yang Maha Esa dan Berakhlak Mulia',
            'Berkebhinekaan Global',
            'Bergotong Royong',
            'Mandiri',
            'Bernalar Kritis',
            'Kreatif',
        ];

        if($modul['i3'] == ""){
            for($i = 0;$i < count($req->all()) - 1;$i++){
                $s = "in_" . ($i + 1);
                $parcel = i_ppp::create([
                    'subjudul' => $subjudul[$i],
                    'isi' => $req[$s],
                    'informasi_id' => $modul['i1']['id'],
                ]);
            }
        }else{
            for($i = 0;$i < count($subjudul);$i++){
                $s = "in_" . ($i);
                $parcel = i_ppp::where('id',$modul['i3'][$i]['id'])->update([
                    'isi' => $req[$s],
                ]);
            }
        }

        if($parcel){
            $data = i_ppp::where('informasi_id',$modul['i1']['id'])->get()->all();
            $modul['i3'] = $data;
            session(['modul'=>$modul]);
            return redirect('/modul/buat/informasiUmum/4');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function sarana(Request $req){
        $modul = session()->get('modul');

        $req ->validate([
            'sarana' => 'required',
            'prasarana' => 'required'
        ]);

        $parcel = infoUmum::where('id',$modul['i1']['id'])->update([
            'sarana' => $req->sarana,
            'prasarana' => $req->prasarana
        ]);

        if($parcel){
            $data = infoUmum::where('id',$modul['i1']['id'])->get()->first();
            $modul['i1'] = $data;
            session(['modul'=>$modul]);
            return redirect('/modul/buat/informasiUmum/5');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function target(Request $req){
        $modul = session()->get('modul');

        $req ->validate([
            'target' => 'required',
        ]);

        $parcel = infoUmum::where('id',$modul['i1']['id'])->update([
            'target' => $req->target,
        ]);

        if($parcel){
            $data = infoUmum::where('id',$modul['i1']['id'])->get()->first();
            $modul['i1'] = $data;
            session(['modul'=>$modul]);
            return redirect('/modul/buat/informasiUmum/6');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function model(Request $req){
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

        if($modul['i4'] == ""){
            for( $i = 0;$i < $total;$i++){
                $parcel = i_modelp::create([
                    'metode' => $data[$i],
                    'kategori' => $kat[$i],
                    'btn' => $btn[$i],
                    'pertemuan' => 1,
                    'informasi_id' => $modul['i1']['id'],
                ]);
                if($data[$i] != ""){
                    $wt +=1;
                }
            }
        }else{
            for( $i = 0;$i < $total;$i++){
                $parcel = i_modelp::where('id',$modul['i4'][$i]['id'])->update([
                    'metode' => $data[$i],
                    'kategori' => $kat[$i],
                    'btn' => $btn[$i],
                ]);
                if($data[$i] != ""){
                    $wt +=1;
                }
            }
        }

        if($parcel){
            $data = i_modelp::where('informasi_id',$modul['i1']['id'])->get()->all();
            $modul['i4'] = $data;
            $modul['i4t'] = $wt;
            session(['modul'=>$modul]);
            return redirect('/modul/buat/informasiUmum/7');
        }else{
            return back()->withErrors('Terjadi Kesalahan Input!');
        }
    }

    public function selesai(){
        $modul = session()->get('modul');

        if($modul['k1'] == ""){
            $ki = komponen_inti::create();
            dataModul::where('id',$modul['mod_id'])->update(['komponen_id'=>$ki->id]);
            $modul['k1'] = komponen_inti::where('id',$ki->id)->get()->first();
            session(['modul'=>$modul]);
            return redirect('/modul/buat/komponenInti/1');
        }else{
            return redirect('/modul/buat/komponenInti/1');
        }
    }

    //1
    public function identitas_edit(Request $req){
        $mod = dataModul::where('id',$req->mod_id)->get()->first();
        $infoumum = infoUmum::where('id',$mod->informasi_id)->get()->first();
        $i2 = i_identitas::where('id',$infoumum->identitas_id)->get()->first();

        $data = [
            'judul' => $mod->judul,
            'aksi' => 'edit/informasiumum/identitas-aksi',
            'view' => 'modul.1identitas',
        ];

        $modul = ['id'=>$req->mod_id];
        $modul['i2'] = $i2;

        session(['modul'=> $modul]);

        return view('modul.1edit_informasiUmum',['res'=>$data]);
    }

    public function identitas_edit_aksi(Request $req){
        $s = session()->get('modul');
        $mod = dataModul::where('id',$s['id'])->get()->first();
        $infoumum = infoUmum::where('id',$mod->informasi_id)->get()->first();

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

        $data = [
            'nama' => $req->penyusun,
            'institusi' => $req->institusi,
            'mapel' => $req->mapel,
            'fase' => $req->fase,
            'kelas' => $req->kelas,
            'TAwal' => $req->TA_awal,
            'TAkhir' => $req->TA_akhir,
            'kali' => $req->kali,
            'waktu' => $req->waktu,
        ];

        $parcel = i_identitas::where('id',$infoumum->identitas_id)->update($data);

        if($parcel){
            return redirect('/modul');
        }

        session()->forget('modul');
    }

    //2
    public function ppp_edit(Request $req){
        $mod = dataModul::where('id',$req->mod_id)->get()->first();
        $infoumum = infoUmum::where('id',$mod->informasi_id)->get()->first();
        $i3 = i_ppp::where('informasi_id',$infoumum->id)->get();

        $data = [
            'judul' => $mod->judul,
            'aksi' => 'edit/informasiumum/ppp-aksi',
            'view' => 'modul.1ppp',
        ];

        $modul = ['id'=>$req->mod_id];
        $modul['i3'] = $i3;

        session(['modul'=> $modul]);

        return view('modul.1edit_informasiUmum',['res'=>$data]);
    }

    public function ppp_edit_aksi(Request $req){
        $s = session()->get('modul');

        $subjudul = [
            'Beriman, Bertakwa kepada Tuhan Yang Maha Esa dan Berakhlak Mulia',
            'Berkebhinekaan Global',
            'Bergotong Royong',
            'Mandiri',
            'Bernalar Kritis',
            'Kreatif',
        ];

        for($i = 0;$i < count($subjudul);$i++){
            $st = "in_" . $i;
            $parcel = i_ppp::where('id',$s['i3'][$i]['id'])->update([
                'isi' => $req[$st],
            ]);
        }

        if($parcel){
            return redirect('/modul');
        }

        session()->forget('modul');
    }

    //3
    public function sarana_edit(Request $req){
        $mod = dataModul::where('id',$req->mod_id)->get()->first();
        $infoumum = infoUmum::where('id',$mod->informasi_id)->get()->first();

        $data = [
            'judul' => $mod->judul,
            'aksi' => 'edit/informasiumum/sarana-aksi',
            'view' => 'modul.1sarana',
        ];

        $modul = ['id'=>$req->mod_id];
        $modul['i1'] = $infoumum;

        session(['modul'=> $modul]);

        return view('modul.1edit_informasiUmum',['res'=>$data]);
    }

    public function sarana_edit_aksi(Request $req){
        $s = session()->get('modul');
        $mod = dataModul::where('id',$s['id'])->get()->first();

        $req->validate([
            'sarana'=>'required',
            'prasarana'=>'required',
        ],[
            //untuk custom pesan gagal nya
            'penyusun.required' => "Nama Penyusun Kosong",
            'institusi.required' => "Institusi Kosong",
        ]);

        $data = [
            'sarana' => $req->sarana,
            'prasarana' => $req->prasarana,
        ];

        $parcel = infoUmum::where('id',$mod->informasi_id)->update($data);

        if($parcel){
            return redirect('/modul');
        }

        session()->forget('modul');
    }

    //4
    public function target_edit(Request $req){
        $mod = dataModul::where('id',$req->mod_id)->get()->first();
        $infoumum = infoUmum::where('id',$mod->informasi_id)->get()->first();

        $data = [
            'judul' => $mod->judul,
            'aksi' => 'edit/informasiumum/target-aksi',
            'view' => 'modul.1target',
        ];

        $modul = ['id'=>$req->mod_id];
        $modul['i1'] = $infoumum;

        session(['modul'=> $modul]);

        return view('modul.1edit_informasiUmum',['res'=>$data]);
    }

    public function target_edit_aksi(Request $req){
        $s = session()->get('modul');
        $mod = dataModul::where('id',$s['id'])->get()->first();

        $req->validate([
            'target'=>'required',
        ],[
            //untuk custom pesan gagal nya
            'target.required' => "Nama Penyusun Kosong",
        ]);

        $data = [
            'target' => $req->target
        ];

        $parcel = infoUmum::where('id',$mod->informasi_id)->update($data);

        if($parcel){
            return redirect('/modul');
        }

        session()->forget('modul');
    }

}
