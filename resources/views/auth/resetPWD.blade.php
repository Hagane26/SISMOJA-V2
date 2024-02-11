@extends('support.layout')

@section('judul')
    Lupa Password
@endsection

@section('isi')

    <div class="position-absolute top-0 end-0 mt-3 me-5">
        @if ($errors->any())
        <div class="alert alert-danger text-center" role="alert">
            <i class="bi bi-info"></i> {{ $errors->first() }}
        </div>
        @endif
    </div>

    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="card border-primary" style="width: 30rem">
            <div class="card-header bg-primary">
                <h4 class="card-title text-center text-bold text-white">Lupa Password</h4>
            </div>
            <div class="card-body">
                    <form action="/resetAction" method="POST">

                        @csrf
                        <!-- Email -->
                        <div class="row g-2 align-items-center ms-5 mb-2">
                            <div class="col-3">
                                <label class="col-form-label">Email</label>
                            </div>
                            <div class="col-auto">
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                        </div>

                        <div class="col g-2 align-items-center ms-5 mb-2 mt-3">
                            <center>
                                <div class="row-auto mb-2">
                                    <input type="submit" class="btn btn-primary fw-bold" style="width: 15rem"
                                        value="Reset Password">
                                </div>
                                <p class="mt-3"><a href="/masuk">Kembali Masuk</a></p>
                            </center>
                        </div>
                    </form>
                </div>

        </div>
    </div>
    <div class="fixed-bottom ms-3 mb-3">

    </div>
@endsection
