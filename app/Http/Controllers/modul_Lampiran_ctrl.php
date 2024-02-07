<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\lampiran;

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
            'progress' => $step * 20,
            'view' => 'modul.3'.$go,
            's_upload' => $su,

            'step1' => 'bg-success text-white',
            'step2' => 'bg-success text-white',
            'step3' => $s_a,
        ];

        return view('modul.3lampiran',['res'=>$data,$modul]);
    }

    public function lampiran1(Request $req){
        $req->validate([
            'LKPD' => 'required|mimes:pdf|max:5048',
            'BB' => 'required|mimes:pdf|max:5048',
            'PR' => 'required|mimes:pdf|max:5048',
        ],[
            'LKPD.mimes' => "File Bukan Berformat PDF",
            'LKPD.max' => "Ukuran Melebihi 5MB",
            'BB.max' => "Ukuran Melebihi 5MB",
        ]);


        $loc = 'lampiran/' . Auth::user()->id . '/' . session()->get('mod_id');

        $file1 = $req->file("LKPD");
        $fname1 = "L1.".$file1->getClientOriginalExtension();

        $file2 = $req->file("BB");
        $fname2 = "L2.".$file2->getClientOriginalExtension();

        $file3 = $req->file("PR");
        $fname3 = "L3.".$file1->getClientOriginalExtension();

        Storage::putFileAs($loc,$file1,$fname1);
        Storage::putFileAs($loc,$file2,$fname2);
        Storage::putFileAs($loc,$file3,$fname3);

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

        $modul['l1'] = lampiran::where('id',$modul['l1']['id'])->get()->first();
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

        $modul['l1'] = lampiran::where('id',$modul['l1']['id'])->get()->first();
        session(['modul'=>$modul]);
        return redirect('/modul/buat/Lampiran/selesai');
    }

    public function selesai(){
        $modul = session()->get('modul');
        //dd($modul);
        //echo $modul['l1']['dapus'];
        return view('modul.3selesai');
    }
}
