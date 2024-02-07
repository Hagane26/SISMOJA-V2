@extends('support.layout')

@section('judul','Buat Modul')

@section('nav')
    @include('users.navbarUser')
@endsection

@section('isi')
    <div class="card border-primary start-50 top-50 translate-middle" style="width:100%">
        <div class="card-body">
            <h4 class="card-title">Masukan Judul Modul</h4>

            <form action="/modul/buat-aksi" method="post" class="ms-5 mt-3">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <input type="text" class="form-control mb-3" name="judul" id="judul">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-success bi-pencil-square"> Mulai Buat Modul</button>
                    </div>
                </div>
            </form>

            @if ($errors->any())
            <div class="alert alert-danger text-center" role="alert">
                <i class="bi bi-info"></i> {{ $errors->first() }}
            </div>
            @endif
        </div>
    </div>
@endsection
