@extends('support.layout')

@section('judul','Lampiran Selesai')

@section('nav')
    @include('users.navbarUser')
@endsection

@section('isi')

        <div class="card border-primary" style="width:60rem">
            <div class="card-body">

                <center>
                    <h4 class="card-title">Anda Telah Menyelesaikan Pembuatan Modul!</h4>
                    <a href="/modul" class="btn btn-success">Lihat Modul</a>
                </center>

            </div>
        </div>

@endsection

