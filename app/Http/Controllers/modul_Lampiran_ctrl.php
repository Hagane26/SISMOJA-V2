<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\lampiran;
use App\Models\dataModul;

use App\Models\logs;

class modul_Lampiran_ctrl extends Controller
{
    public function index($step){
        Auth::check();

        if(!is_numeric($step) || session()->has('modul') == 0){
            return redirect()->back();
        }

        $modul = session()->get('modul');
        $su = '';
        switch($step){
            case 1:
                $s_a = "border-2 border-primary";
                $su = "enctype=multipart/form-data";
                $go = "lampiran1";
                break;
            case 2:
                $s_a = "border-2 border-primary";
                $go = "lampiran2";
                break;
            case 3:
                $s_a = "border-2 border-primary";
                $go = "lampiran3";
                break;
            case 4:
                $s_a = "bg-success text-white";
                $go = "selesai";
                break;
        }

        $data = [
            'judul' => $modul['judul'],
            'aksi' => 'lampiran/' . $go . '-aksi',
            'pos' => $step - 1,
            'progress' => ($step-1) * (100 / 2),
            'view' => 'modul.3'.$go,
            's_upload' => $su,

            'step1' => 'bg-success text-white',
            'step2' => 'bg-success text-white',
            'step3' => $s_a,

            'batal' => '/modul'
        ];

        return view('modul.3lampiran',['res'=>$data,$modul]);
    }

    public function lampiran1(Request $req){
        $modul = session()->get('modul');
        $req->validate([
            'LKPD' => 'mimes:pdf|max:5048',
            'BB' => 'mimes:pdf|max:5048',
            'PR' => 'mimes:pdf|max:5048',
        ],[
            'LKPD.mimes' => "File Bukan Berformat PDF",
            'LKPD.max' => "Ukuran Melebihi 5MB",
            'BB.max' => "Ukuran Melebihi 5MB",
        ]);

        $loc = 'lampiran/' . Auth::user()->id . '/' . $modul['mod_id'];

        if($req->LKPD != '' ){

            $file1 = $req->file("LKPD");
            $fname1 = "L1-".$modul['mod_id']."-".Auth::user()->id.".".$file1->getClientOriginalExtension();

            Storage::putFileAs($loc,$file1,$fname1);
        }

        if($req->PR != ''){
            $file2 = $req->file("PR");
            $fname2 = "L2-".$modul['mod_id']."-".Auth::user()->id.".".$file2->getClientOriginalExtension();

            Storage::putFileAs($loc,$file2,$fname2);
        }

        if( $req->BB != ''){
            $file3 = $req->file("BB");
            $fname3 = "L3-".$modul['mod_id']."-".Auth::user()->id.".".$file3->getClientOriginalExtension();

            Storage::putFileAs($loc,$file3,$fname3);
        }
        logs::create([
            'user_id' => Auth::user()->id,
            'mod_id' => $modul['mod_id'],
            'action' => '/modul/buat/lampiran/2',
            'modul_session' => 'lampiran file',
            'status' => 'create'
        ]);
        return redirect('/modul/buat/lampiran/2');
    }

    public function lampiran2(Request $req){
        $modul = session()->get('modul');

        $req->validate([
            'glossarium' => 'required',
        ],[
            'glossarium.required' => 'Glossarium Masih Kosong, Harap Diisi Terlebih Dahulu!',
        ]);

        lampiran::where('id',$modul['l1']['id'])->update([
            'glossarium' => $req->glossarium,
        ]);

        $data = lampiran::where('id',$modul['l1']['id'])->get()->first();
        $modul['l1'] = $data;
        logs::create([
            'user_id' => Auth::user()->id,
            'mod_id' => $modul['mod_id'],
            'action' => '/modul/buat/lampiran/3',
            'modul_session' =>  serialize($modul),
            'status' => 'create'
        ]);
        session(['modul'=>$modul]);
        return redirect('/modul/buat/lampiran/3');
    }

    public function lampiran3(Request $req){
        $modul = session()->get('modul');
        $req->validate([
            'dapus' => 'required',
        ],[
            'dapus.required' => 'Daftar Pustaka Masih Kosong, Harap Diisi Terlebih Dahulu!',
        ]);

        lampiran::where('id',$modul['l1']['id'])->update([
            'dapus' => $req->dapus,
        ]);
        $data = lampiran::where('id',$modul['l1']['id'])->get()->first();
        $modul['l1'] = $data;
        logs::create([
            'user_id' => Auth::user()->id,
            'mod_id' => $modul['mod_id'],
            'action' => '/modul/buat/lampiran/3',
            'modul_session' =>  serialize($modul),
            'status' => 'create'
        ]);
        session(['modul'=>$modul]);
        return redirect('/modul/buat/Lampiran/selesai');
    }

    public function selesai(){
        $modul = session()->get('modul');
        //dd($modul);
        //echo $modul['l1']['dapus'];
        logs::create([
            'user_id' => Auth::user()->id,
            'mod_id' => $modul['mod_id'],
            'action' => '/modul/buat/lampiran/3',
            'modul_session' => 'Selesai',
            'status' => 'finish'
        ]);

        return view('modul.3selesai');
    }

    public function get_kbbi($teks){
        $client = new Client();
        $url = 'http://kateglo.lostfocus.org/api.php?format=json&phrase=' . $teks;
        $response = $client->request('GET',$url);
        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        $definitions = $data->kateglo->definition;
        $arr = [];
        $i = 0;

        foreach ($definitions as $definition) {
            array_push($arr,$definition->def_text);
        }
        return json_encode(array('result'=>$arr));
    }

    public function lampiran2_edit(Request $req){
        $mod = dataModul::where('id',$req->mod_id)->get()->first();
        $lam = lampiran::where('id',$mod->lampiran_id)->get()->first();

        $su = "";

        $data = [
            'judul' => $mod->judul,
            'aksi' => 'edit/lampiran/lampiran2-aksi',
            'view' => 'modul.3lampiran2',
            's_upload' => $su,
            'batal' => '/modul',
        ];

        $modul = ['id'=>$req->mod_id];
        $modul['lampiran'] = $lam;

        session(['modul'=> $modul]);

        return view('modul.3edit_lampiran',['res'=>$data]);
    }

    public function lampiran2_edit_aksi(Request $req){
        $s = session()->get('modul');
        $mod = dataModul::where('id',$s['id'])->get()->first();

        $req->validate([
            'glossarium'=>'required',
        ],[
            //untuk custom pesan gagal nya
            'glossarium.required' => "Dapus Masih Kosong.",
        ]);

        $data = [
            'glossarium' => $req->glossarium
        ];

        $parcel = lampiran::where('id',$mod->lampiran_id)->update($data);

        if($parcel){
            return redirect('/modul');
        }

        session()->forget('modul');
    }

    public function lampiran3_edit(Request $req){
        $mod = dataModul::where('id',$req->mod_id)->get()->first();
        $lam = lampiran::where('id',$mod->lampiran_id)->get()->first();

        $su = "";

        $data = [
            'judul' => $mod->judul,
            'aksi' => 'edit/lampiran/lampiran3-aksi',
            'view' => 'modul.3lampiran3',
            's_upload' => $su,
            'batal' => '/modul',
        ];

        $modul = ['id'=>$req->mod_id];
        $modul['lampiran'] = $lam;

        session(['modul'=> $modul]);

        return view('modul.3edit_lampiran',['res'=>$data]);
    }

    public function lampiran3_edit_aksi(Request $req){
        $s = session()->get('modul');
        $mod = dataModul::where('id',$s['id'])->get()->first();

        $req->validate([
            'dapus'=>'required',
        ],[
            //untuk custom pesan gagal nya
            'dapus.required' => "Dapus Masih Kosong.",
        ]);

        $data = [
            'dapus' => $req->dapus
        ];

        $parcel = lampiran::where('id',$mod->lampiran_id)->update($data);

        if($parcel){
            return redirect('/modul');
        }

        session()->forget('modul');
    }
}
