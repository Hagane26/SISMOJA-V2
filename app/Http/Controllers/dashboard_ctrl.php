<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\dataModul;

use App\Models\infoUmum;
use App\Models\i_identitas;
use App\Models\i_ppp;
use App\Models\i_modelp;

use App\Models\komponen_inti;
use App\Models\ki_pembuka;
use App\Models\ki_kegiatan;
use App\Models\ki_penutup;

use App\Models\lampiran;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use Ibnuhalimm\LaravelPdfToHtml\Facades\PdfToHtml;


class dashboard_ctrl extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function modul_buat(){
        return view('modul.1buat');
    }

    public function modul_hapus(Request $req){
        $mod = dataModul::where('id',$req->mod_id)->get()->first();
        // informasi umum
        if($mod->informasi_id != ''){
            $info = infoUmum::where('id',$mod->informasi_id)->get()->first();
        }
            // identitas
        if($info->identitas_id != ''){
            i_identitas::where('id',$info->identitas_id)->delete();
        }

            // model
        i_modelp::where('informasi_id',$info->id)->delete();


        // profil pelajar pancasila
        i_ppp::where('informasi_id',$info->id)->delete();


        // komponen inti
        if($mod->komponen_id != ''){
            $ki = komponen_inti::where('id',$mod->komponen_id)->get()->first();
        }

        // pembukaan
        ki_pembuka::where('ki_id',$ki->id)->delete();


        // kegiatan
        ki_kegiatan::where('ki_id',$ki->id)->delete();


        // penutup
        ki_penutup::where('ki_id',$ki->id)->delete();

        $sf = 'lampiran/'.$mod['users_id'].'/'.$mod['mod_id'] . '/';
        $bn = $mod['mod_id']. '-'. $mod['users_id']. '.pdf';
        $fname = $sf.'L1-'. $bn;
        if(file_exists($fname)){
            Storage::delete($fname);
        }

        $fname = $sf.'L2-'. $bn;
        if(file_exists($fname)){
            Storage::delete($fname);
        }

        $fname = $sf.'L3-'. $bn;
        if(file_exists($fname)){
            Storage::delete($fname);
        }

        komponen_inti::where('id',$mod->komponen_id)->delete();
        $info = infoUmum::where('id',$mod->informasi_id)->delete();

        // Lampiran
        $lam = lampiran::where('id',$mod->lampiran_id)->delete();
        $mod = dataModul::where('id',$req->mod_id)->delete();
    }

    public function modul_buat_aksi(Request $req){
        Auth::check();
        session()->forget('modul');
        $req->validate([
            'judul' => 'required',
        ],[
            'judul.required' => 'Silahkan Isi Judul terlebih dahulu!',
        ]);

        $infoUmum = infoUmum::create();
        $parcel = dataModul::create(['judul'=>$req->judul,'informasi_id'=>$infoUmum->id,'users_id'=>Auth::user()->id]);
        if($parcel){
            $data_iu = infoUmum::where('id',$infoUmum->id)->get()->first();
            $data = [
                'mod_id'=>$parcel->id,
                'judul' => $parcel->judul,
                'i1' => $data_iu,
                'i2' => 0,
                'i3' => 0,
                'i4' => 0,
                'k1' => 0,
                'k2' => 0,
                'k3' => 0,
                'k4' => 0,
                'l1' => 0,
                'l2' => 0,
                'l3' => 0,
                'waktu' => 0,
                'waktu_n' => 0,
                'wpembuka' => 0,
                'winti' => 0,
                'wpenutup' => 0,
                'i4t' => 0,
            ];
            session(['modul'=>$data]);
            return redirect('/modul/buat/informasiUmum/1');
        }else{
            return redirect()->back()->withErrors('Gagal Membuat Modul!');
        }
    }

    public function daftar_modul(){
        $identitas = "";
        $data_modul = dataModul::where('users_id',Auth::user()->id)->get()->all();
        for($i=0;$i<(count($data_modul));$i++){
            $identitas = i_identitas::where('id',$data_modul[$i]->id)->get()->first();
            $data_modul[$i]['identitas'] = $identitas;
        }
        //echo json_encode($data_modul[0]);
        //echo $data_modul[0]->identitas->nama;
        return view('modul.index',['modul'=>$data_modul]);
    }

    public function lihat_modul(Request $req){
        $mod = dataModul::where('id',$req->mod_id)->get()->first();
        $msg_default = "Data Belum Dibuat";
        $info = "";
        $identitas = "";
        $model = "";

        $ppp = "";
        $ki = "";
        $lam = "";

        // informasi umum
        if($mod->informasi_id == ''){
            $info = $msg_default;
        }else{
            $info = infoUmum::where('id',$mod->informasi_id)->get()->first();
        }
            // identitas
        if($info->identitas_id == ''){
            $identitas = $msg_default;
        }else{
            $identitas = i_identitas::where('id',$info->identitas_id)->get()->first();
        }

            // model
        $model = i_modelp::where('informasi_id',$info->id)->get();
        if(count($model) == 0){
            $ppp = $msg_default;
        }

        // profil pelajar pancasila
        $ppp = i_ppp::where('informasi_id',$info->id)->get();
        if(count($ppp) == 0){
            $ppp = $msg_default;
        }

        // komponen inti
        if($mod->komponen_id == ''){
            $ki = $msg_default;
        }else{
            $ki = komponen_inti::where('id',$mod->komponen_id)->get()->first();
        }

        // pembukaan
        $pembukaan = ki_pembuka::where('ki_id',$ki->id)->get();
        if(count($pembukaan) == 0){
            $pembukaan = $msg_default;
        }

        // kegiatan
        $kegiatan = ki_kegiatan::where('ki_id',$ki->id)->get();
        if(count($kegiatan) == 0){
            $kegiatan = $msg_default;
        }

        // penutup
        $penutup = ki_penutup::where('ki_id',$ki->id)->get();
        if(count($penutup) == 0){
            $penutup = $msg_default;
        }

        // Lampiran
        $lam = lampiran::where('id',$mod->lampiran_id)->get();
        if(count($lam) == 0){
            $lam = $msg_default;
        }

        $mod['lampiran'] = $lam;
        $info['identitas'] = $identitas;
        $info['model'] = $model;
        $mod['ki_pembukaan'] = $pembukaan;
        $mod['ki_kegiatan'] = $kegiatan;
        $mod['ki_penutup'] = $penutup;
        $mod['data_informasi'] = $info;
        $mod['data_ppp'] = $ppp;
        $mod['data_komponen_inti'] = $ki;
        $mod['mod_id'] = $req->mod_id;
        //echo json_encode($mod);
        //echo asset('lampiran/1/1/L1.pdf');

        $sf = 'lampiran/'.$mod['users_id'].'/'.$mod['mod_id'] . '/';
        $bn = $mod['mod_id']. '-'. $mod['users_id']. '.pdf';
        $fname = $sf.'L1-'. $bn;

        return view('modul.modulLihat',['res'=>$mod]);
    }

    public function print_modul(Request $req){
        $mod = dataModul::where('id',$req->mod_id)->get()->first();
        $msg_default = "Data Belum Dibuat";
        $info = "";
        $identitas = "";
        $model = "";

        $ppp = "";
        $ki = "";
        $lam = "";

        // informasi umum
        if($mod->informasi_id == ''){
            $info = $msg_default;
        }else{
            $info = infoUmum::where('id',$mod->informasi_id)->get()->first();
        }
            // identitas
        if($info->identitas_id == ''){
            $identitas = $msg_default;
        }else{
            $identitas = i_identitas::where('id',$info->identitas_id)->get()->first();
        }

            // model
        $model = i_modelp::where('informasi_id',$info->id)->get();
        if(count($model) == 0){
            $ppp = $msg_default;
        }

        // profil pelajar pancasila
        $ppp = i_ppp::where('informasi_id',$info->id)->get();
        if(count($ppp) == 0){
            $ppp = $msg_default;
        }

        // komponen inti
        if($mod->komponen_id == ''){
            $ki = $msg_default;
        }else{
            $ki = komponen_inti::where('id',$mod->komponen_id)->get()->first();
        }

        // pembukaan
        $pembukaan = ki_pembuka::where('ki_id',$ki->id)->get();
        if(count($pembukaan) == 0){
            $pembukaan = $msg_default;
        }

        // kegiatan
        $kegiatan = ki_kegiatan::where('ki_id',$ki->id)->get();
        if(count($kegiatan) == 0){
            $kegiatan = $msg_default;
        }

        // penutup
        $penutup = ki_penutup::where('ki_id',$ki->id)->get();
        if(count($penutup) == 0){
            $penutup = $msg_default;
        }

        // Lampiran
        $lam = lampiran::where('id',$mod->lampiran_id)->get()->first();
        if(!$lam){
            $lam = $msg_default;
        }

        $mod['lampiran'] = $lam;
        $info['identitas'] = $identitas;
        $info['model'] = $model;
        $mod['ki_pembukaan'] = $pembukaan;
        $mod['ki_kegiatan'] = $kegiatan;
        $mod['ki_penutup'] = $penutup;
        $mod['data_informasi'] = $info;
        $mod['data_ppp'] = $ppp;
        $mod['data_komponen_inti'] = $ki;
        $mod['mod_id'] = $req->mod_id;

        $nama = $mod['mod_id'] . " - " . $identitas['nama'] . ".pdf";
        $folout = 'lampiran/' . $mod['users_id'] .'/' . $mod['id'] .'/' ;
        $pdf = Pdf::loadView('support.print', ['res'=>$mod]);
        $pdf->render();
        $nfile = $folout.'Fix-'.$req->mod_id.'.pdf';
        Storage::put($nfile, $pdf->output());
        $merge = PDFMerger::init();
        $merge->addPDF($nfile,'all');

        $bn = $mod['mod_id']. '-'. $mod['users_id']. '.pdf';

        if(file_exists($folout . 'L1-'.$bn)){
            $merge->addPDF($folout . 'L1-'.$bn,'all');
        }

        if(file_exists($folout . 'L2-'.$bn)){
            $merge->addPDF($folout . 'L2-'.$bn,'all');
        }

        if(file_exists($folout . 'L3-'.$bn)){
            $merge->addPDF($folout . 'L3-'.$bn,'all');
        }

        $merge->merge();

        return $merge->stream($nama);

    }

}
