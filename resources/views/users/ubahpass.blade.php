@extends('support.layout')

@section('judul')
    Ubah Password
@endsection

@section('nav')
    @include('users.navbarUser')
@endsection

@section('isi')

    <div class="position-absolute top-0 end-0 mt-3 me-5">
        @if ($errors->any())
        <div class="alert alert-danger text-center" role="alert">
            <i class="bi bi-info"></i> {{ $errors->first() }}
        </div>
        @endif
    </div>


        <div class="card border-primary ms-5" style="width: 50rem">
            <div class="card-header bg-primary">
                <h4 class="card-title text-center text-bold text-white">Ubah Password</h4>
            </div>
            <div class="card-body ms-5">
                    <form action="/profil/ubahPassword-aksi" method="POST">

                        @csrf
                        <input type="hidden" name="email" value={{ Auth::user()->email }}>

                        <div class="row g-2 align-items-center ms-5 mb-2">
                            <div class="col-3">
                                <label class="col-form-label">Password Lama</label>
                            </div>
                            <div class="col-auto">
                                <input type="password" id="inputPassword" class="form-control" name="pLama"
                                    aria-describedby="passwordHelpInline">
                            </div>
                        </div>

                        <div class="row g-2 align-items-center ms-5 mb-2">
                            <div class="col-3">
                                <label class="col-form-label">Password Baru</label>
                            </div>
                            <div class="col-auto">
                                <input type="password" id="inputPassword" class="form-control" name="pBaru"
                                    aria-describedby="passwordHelpInline">
                            </div>
                        </div>

                        <div class="row g-2 align-items-center ms-5 mb-2">
                            <div class="col-3">
                                <label class="col-form-label">Konfirmasi Password</label>
                            </div>
                            <div class="col-auto">
                                <input type="password" id="inputPassword" class="form-control" name="konfirmasi"
                                    aria-describedby="passwordHelpInline">
                            </div>
                        </div>

                        <div class="col g-2 align-items-center mb-2 mt-3 ms-5">
                                <div class="row-auto mb-2">
                                    <input type="submit" class="btn btn-primary fw-bold" style="width: 15rem"
                                        value="Ubah Password">
                                </div>
                        </div>
                    </form>
                </div>

        </div>

@endsection
