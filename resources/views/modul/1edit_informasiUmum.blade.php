@extends('support.layout')

@section('judul','Informasi Umum')

@section('nav')
    @include('users.navbarUser')
@endsection

@section('isi')
    <div class="position-absolute top-0 start-50 translate-middle-x mt-3">

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
                <h6 class="card-subtitle"> Informasi Umum </h6>
                <form action="/modul/{{ $res['aksi'] }}" method="post">
                    @csrf
                    @include($res['view'])
                </form>
            </div>
        </div>
    </div>
@endsection

@section('sidemenu')

@endsection
