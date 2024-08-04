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
                @if (Auth::user()->status_info == 0)
                    <p class="bi bi-info-circle-fill"> Anda Belum Melengkapi Profil</p>
                @endif
                <div class="row">
                    <div class="col-8">
                        <input type="text" class="form-control mb-3" name="judul" id="judul">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-success bi-pencil-square"
                        @if (Auth::user()->status_info == 0)
                            {{ "disabled" }}
                        @endif> Mulai Buat Modul </button>
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

    @if ($tampil == 'show')

                <div class="modal fade" id="modal_lanjut" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Lanjutkan Modul</h1>
                            </div>
                            <div class="modal-body">
                                Ada Modul Ajar dengan judul "{{ $modul['judul'] }}" Yang belum anda selesaikan, Apakah Anda Ingin Melanjutkannya?
                            </div>
                            <div class="modal-footer">
                                <a href="{{ $action }}"><button button type="button" class="btn btn-success">Ya, Saya Ingin Melanjutkannya</button></a>
                                <form action="{{ config('app.url') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="mod_id" value="{{ $modul['mod_id'] }}">
                                    <button type="submit" formaction="/modul/hapus"
                                    class="btn btn-danger"
                                    data-bs-dismiss="modal">
                                        Tidak, Hapus Saja
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function(){
                        $("#modal_lanjut").modal('{{ $tampil }}');
                    });
                </script>
            @endif
@endsection
