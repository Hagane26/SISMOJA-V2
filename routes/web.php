<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\login_ctrl;
use App\Http\Controllers\register_ctrl;

use App\Http\Controllers\dashboard_ctrl;
use App\Http\Controllers\modul_informasiUmum_ctrl;
use App\Http\Controllers\modul_kegiatanInti_ctrl;
use App\Http\Controllers\modul_Lampiran_ctrl;

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
Route::get('/login',[login_ctrl::class,'login'])->name('login');
Route::post('/loginAction',[login_ctrl::class,'aksi_login']);

// Register
Route::get('/register',[register_ctrl::class,'register']);
Route::post('/registerAction',[register_ctrl::class,'aksi_register']);

// grup fungsi
Route::middleware('auth')->group(function(){
    // dashboard
    Route::get('/dashboard',[dashboard_ctrl::class,'index']);
    Route::get('/',function(){
        return redirect('/dashboard');
    });

    // modul
    Route::get('/modul/buat',[dashboard_ctrl::class,'modul_buat']);
    Route::post('/modul/buat-aksi',[dashboard_ctrl::class,'modul_buat_aksi']);

    Route::get('/modul/buat/informasiUmum',function(){
        return redirect()->back();
    });
    Route::get('/modul/buat/informasiUmum/{step}',[modul_informasiUmum_ctrl::class,'infoUmum']);

    Route::post('/modul/buat/informasiUmum/identitas-aksi',[modul_informasiUmum_ctrl::class,'identitas']);
    //Route::post('/modul/informasiUmum/identitas-aksi',[modul_informasiUmum_ctrl::class,'identitas']);
});
