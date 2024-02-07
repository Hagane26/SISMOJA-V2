<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Penutup</h4>
        <h6 class="card-subtitle bi-exclamation-triangle-fill m-3" style="color: red"> Harus di Isi 5 Kegiatan Tersebut</h6>

        @if (session()->has('modul'))
            @php
                $modul = session()->get('modul');
                $waktu = $modul['waktu'];
                $def = 10 / 5;
            @endphp
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row">
                        <label class="col-5 form-label">Total Waktu : {{ $modul['waktu'] }} Menit</label>
                        <div class="col">
                            <label for="basic-url" class="form-label">Waktu Untuk Penutup</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" value="10" name="waktu">
                                <span class="input-group-text">Menit dari total waktu ({{ $modul['waktu'] }} menit).</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif

        <div class="card mb-2">
            <div class="card-body">
                <div class="row g-2 align-items-center ms-5 mb-4">
                    <label class="form-label">Kegiatan 1 : Kesimpulan</label>

                    <textarea name="p-1a" class="form-control"></textarea>

                    <div class="mb-3 row mt-2">
                        <label class="col-sm-3 col-form-label">Alokasi Waktu</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" name="p-1b" value="{{ $def }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Menit</label>
                    </div>
                    <input type="hidden" name="p-1c" value="Kesimpulan">
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <div class="row g-2 align-items-center ms-5 mb-4">
                    <label class="form-label">Kegiatan 2 : Evaluasi</label>

                    <textarea name="p-2a" class="form-control"></textarea>

                    <div class="mb-3 row mt-2">
                        <label class="col-sm-3 col-form-label">Alokasi Waktu</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" name="p-2b" value="{{ $def }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Menit</label>
                    </div>
                    <input type="hidden" name="p-2c" value="Evaluasi">
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <div class="row g-2 align-items-center ms-5 mb-4">
                    <label class="form-label">Kegiatan 3 : Refleksi</label>

                    <textarea name="p-3a" class="form-control"></textarea>

                    <div class="mb-3 row mt-2">
                        <label class="col-sm-3 col-form-label">Alokasi Waktu</label>
                        <div class="col-sm-7">
                        <input type="number" class="form-control" name="p-3b" value="{{ $def }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Menit</label>
                    </div>
                    <input type="hidden" name="p-3c" value="Refleksi">
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <div class="row g-2 align-items-center ms-5 mb-4">
                    <label class="form-label">Kegiatan 4 : Penyampaian Tujuan Pembelajaran Pertemuan Selanjutnya</label>

                    <textarea name="p-4a" class="form-control"></textarea>

                    <div class="mb-3 row mt-2">
                        <label class="col-sm-3 col-form-label">Alokasi Waktu</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" name="p-4b" value="{{ $def }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Menit</label>
                    </div>
                    <input type="hidden" name="p-4c" value="Penyampaian Tujuan Pembelajaran Pertemuan Selanjutnya">
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <div class="row g-2 align-items-center ms-5 mb-4">
                    <label class="form-label">Kegiatan 5 : Salam Penutup</label>

                    <textarea name="p-5a" class="form-control"></textarea>

                    <div class="mb-3 row mt-2">
                        <label class="col-sm-3 col-form-label">Alokasi Waktu</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" name="p-5b" value="{{ $def }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Menit</label>
                    </div>
                    <input type="hidden" name="p-5c" value="Salam Penutup">
                </div>
            </div>
        </div>

        <div class="position-relative bottom-0 start-50 translate-middle-x mt-3" style="width:50%">
            <div class="row">
                <button type="submit" class="btn btn-success col me-3 bi-check-square"> Simpan </button>
                <a href="" class="btn btn-danger col bi-x-square"> Batalkan </a>
            </div>
        </div>

    </div>
</div>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

