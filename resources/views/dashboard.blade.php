@extends('support.layout')

@section('judul')
    Dashboard
@endsection

@section('nav')
    @include('users.navbarUser')
@endsection

@section('isi')
    <p class="fs-1">
        Selamat Datang di {{ config('app.name') }}
    </p>
@endsection
