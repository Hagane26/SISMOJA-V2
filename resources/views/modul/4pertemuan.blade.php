@extends('support.layout')

@section('judul','Pertemuan')

@section('nav')
    @include('users.navbarUser')
@endsection

@section('isi')
    <div class="position-absolute top-0 start-50 translate-middle-x mt-3">

        <div class="position-relative mt-4 mb-5">
            <div class="progress" style="height: 5px;">
                <div class="progress-bar bg-success" role="progressbar" aria-label="Progress" style="width: {{ $res['progress'] }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <a href="/modul/tambah/pertemuan/1" type="button" class="position-absolute top-0 translate-middle btn btn-sm btn-{{ $res['pos'] == 0 ? 'primary' : ($res['pos'] > 0 ? 'success' : 'secondary') }} rounded-pill" style="width: 2rem; height:2rem; margin-left:0%;">1</a>
            <a href="/modul/tambah/pertemuan/2" type="button" class="position-absolute top-0 translate-middle btn btn-sm btn-{{ $res['pos'] == 1 ? 'primary' : ($res['pos'] > 1 ? 'success' : 'secondary') }} rounded-pill" style="width: 2rem; height:2rem; margin-left:33%;">2</a>
            <a href="/modul/tambah/pertemuan/3" type="button" class="position-absolute top-0 translate-middle btn btn-sm btn-{{ $res['pos'] == 2 ? 'primary' : ($res['pos'] > 2 ? 'success' : 'secondary') }} rounded-pill" style="width: 2rem; height:2rem; margin-left:66%;">3</a>
            <a href="/modul/tambah/pertemuan/4" type="button" class="position-absolute top-0 translate-middle btn btn-sm btn-{{ $res['pos'] == 3 ? 'primary' : ($res['pos'] > 3 ? 'success' : 'secondary') }} rounded-pill" style="width: 2rem; height:2rem; margin-left:99%;">4</a>
        </div>

        @if (session()->has('modul') == 0)
            {{ route('/') }}
        @endif

        @php
            $modul = session()->get('modul');
        @endphp

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card border-primary" style="width:50rem">
            <div class="card-body">
                <h4 class="card-title" style="font-weight:bold">Judul Modul : {{ $res['judul'] }}</h4>
                <h6 class="card-subtitle"> Pertemuan {{ $res['pertemuan'] }} </h6>
                <form action="/modul/tambah/pertemuan/{{ $res['aksi'] }}" method="post">
                    @csrf
                    @include($res['view'])
                </form>
            </div>
        </div>
    </div>
@endsection

