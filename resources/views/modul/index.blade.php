@extends('support.layout')

@section('judul','Informasi Umum')

@section('nav')
    @include('users.navbarUser')
@endsection

@section('isi')
        <div class="card" style="width: 55rem">
            <div class="card-body">
                <h4 class="card-title">Modul Saya</h4>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" style="width: 20%">Materi</th>
                            <th scope="col" style="width: 20%">Nama Penyusun</th>
                            <th scope="col">Terakhir Diperbaharui</th>
                            <th scope="col" style="width: 30%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($modul as $m)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $m->judul }}</td>
                            <td>{{ $m->identitas != "" ? $m->identitas->nama : "" }}</td>
                            <td>{{ $m->updated_at->format('d F Y') }}</td>
                            <td>
                                <form action="{{ config('app.url') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="mod_id" value="{{ $m->id }}">
                                    <button type="submit" formaction="/modul/lihat" class="btn btn-primary">
                                        Lihat
                                    </button>

                                    <button type="submit" formaction="/modul/print" class="btn btn-primary bi-printer">
                                        Print
                                    </button>

                                    <!--
                                    <button type="submit" formaction="/modul/hapus" class="btn btn-danger bi-trash3">
                                    </button>
                                    -->
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#msg{{ $i++ }}"
                                    class="btn btn-danger bi-trash3">
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        @php
            $i = 1;
        @endphp
        @foreach ($modul as $m)
            <!-- Modal -->
            <div class="modal fade" id="msg{{ $i++ }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Modul</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    Apakah Anda Yakin Ingin Menghapus Modul Ajar {{ $m->judul }}, yang disusun oleh {{ $m->identitas != "" ? $m->identitas->nama : "" }}?
                    </div>
                    <div class="modal-footer">
                        <button button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak Jadi</button>
                        <form action="{{ config('app.url') }}" method="post">
                            @csrf
                            <input type="hidden" name="mod_id" value="{{ $m->id }}">
                            <button type="submit" formaction="/modul/hapus"
                            class="btn btn-danger">
                                Tetap Hapus
                            </button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        @endforeach
@endsection
