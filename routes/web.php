<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\login_ctrl;
use App\Http\Controllers\register_ctrl;

use App\Http\Controllers\dashboard_ctrl;
use App\Http\Controllers\modul_informasiUmum_ctrl;
use App\Http\Controllers\modul_komponenInti_ctrl;
use App\Http\Controllers\modul_Lampiran_ctrl;
use App\Http\Controllers\profil_ctrl;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Login
Route::get('/masuk',[login_ctrl::class,'login'])->name('login');
Route::post('/loginAction',[login_ctrl::class,'aksi_login']);

// Register
Route::get('/daftar',[register_ctrl::class,'register']);
Route::post('/registerAction',[register_ctrl::class,'aksi_register']);

Route::get('/lupaPassword',function(){
    return view('auth.resetPWD');
});
Route::post('/resetAction',[login_ctrl::class,'aksi_reset']);
Route::get('/resetPassword/{token}',[login_ctrl::class,'reset_view']);
Route::post('/resetPasswordAksi',[login_ctrl::class,'reset_view_aksi']);

// grup fungsi
Route::middleware('auth')->group(function(){
    // dashboard
    Route::get('/dashboard',[dashboard_ctrl::class,'index']);
    Route::get('/',function(){
        return redirect('/dashboard');
    });

    // modul
    Route::get('/modul/buat',[dashboard_ctrl::class,'modul_buat']);
    Route::post('/modul/hapus',[dashboard_ctrl::class,'modul_hapus']);
    Route::post('/modul/buat-aksi',[dashboard_ctrl::class,'modul_buat_aksi']);

    Route::get('/modul/buat/informasiUmum',function(){
        return redirect()->back();
    });
    Route::get('/modul/buat/informasiUmum/{step}',[modul_informasiUmum_ctrl::class,'index']);

    Route::post('/modul/buat/informasiUmum/identitas-aksi',[modul_informasiUmum_ctrl::class,'identitas']);
    Route::post('/modul/buat/informasiUmum/komponenAwal-aksi',[modul_informasiUmum_ctrl::class,'komponenAwal']);
    Route::post('/modul/buat/informasiUmum/ppp-aksi',[modul_informasiUmum_ctrl::class,'profilPancasila']);
    Route::post('/modul/buat/informasiUmum/sarana-aksi',[modul_informasiUmum_ctrl::class,'sarana']);
    Route::post('/modul/buat/informasiUmum/target-aksi',[modul_informasiUmum_ctrl::class,'target']);
    Route::post('/modul/buat/informasiUmum/model-aksi',[modul_informasiUmum_ctrl::class,'model']);
    Route::get('/modul/buat/InformasiUmum/Selesai',[modul_informasiUmum_ctrl::class,'selesai']);

    Route::get('/modul/buat/komponenInti/{step}',[modul_komponenInti_ctrl::class,'index']);

    Route::post('/modul/buat/komponenInti/tujuan-aksi',[modul_komponenInti_ctrl::class,'tujuan']);
    Route::post('/modul/buat/komponenInti/asasmen-aksi',[modul_komponenInti_ctrl::class,'asasmen']);
    Route::post('/modul/buat/komponenInti/pemahaman-aksi',[modul_komponenInti_ctrl::class,'pemahaman']);
    Route::post('/modul/buat/komponenInti/pemantik-aksi',[modul_komponenInti_ctrl::class,'pemantik']);
    Route::post('/modul/buat/komponenInti/pembukaan-aksi',[modul_komponenInti_ctrl::class,'pembukaan']);
    Route::post('/modul/buat/komponenInti/kegiatanInti-aksi',[modul_komponenInti_ctrl::class,'kegiatanInti']);
    Route::post('/modul/buat/komponenInti/penutup-aksi',[modul_komponenInti_ctrl::class,'penutup']);
    Route::post('/modul/buat/komponenInti/refleksi-aksi',[modul_komponenInti_ctrl::class,'refleksi']);
    Route::get('/modul/buat/KomponenInti/Selesai',[modul_komponenInti_ctrl::class,'selesai']);

    Route::get('/modul/buat/lampiran/{step}',[modul_Lampiran_ctrl::class,'index']);
    Route::post('/modul/buat/lampiran/lampiran1-aksi',[modul_Lampiran_ctrl::class,'lampiran1']);
    Route::post('/modul/buat/lampiran/lampiran2-aksi',[modul_Lampiran_ctrl::class,'lampiran2']);
    Route::post('/modul/buat/lampiran/lampiran3-aksi',[modul_Lampiran_ctrl::class,'lampiran3']);
    Route::get('/modul/buat/Lampiran/selesai',[modul_Lampiran_ctrl::class,'selesai']);

    route::get('/modul',[dashboard_ctrl::class,'daftar_modul']);
    route::post('/modul/lihat',[dashboard_ctrl::class,'lihat_modul']);
    route::post('/modul/print',[dashboard_ctrl::class,'print_modul']);

    route::get('/profil',[profil_ctrl::class,'index']);
    route::post('/profil/update',[profil_ctrl::class,'update']);
    route::get('/profil/ubahPassword',function(){
        return view('users.ubahpass');
    });
    route::post('/profil/ubahPassword-aksi',[profil_ctrl::class,'ubahPassword']);

    Route::get('/keluar',[login_ctrl::class,'aksi_logout']);
});
