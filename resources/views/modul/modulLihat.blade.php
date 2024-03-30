@extends('support.layout')

@section('judul', $res->judul)

@section('nav')
    @include('users.navbarUser')
@endsection

@section('isi')
        <div class="card mb-5" style="width: 50rem">
            <h3 class="card-header">MODUL AJAR : <b>{{ $res->judul }}</b></h3>
            <div class="card-body">

                <!-- -->
                <div class="card">
                    <div class="card-header fw-bold">
                        A. IDENTITAS MODUL
                    </div>
                    <div class="card-body">

                        <div class="mb-1 row mx-lg-5">
                            <label class="col-sm-4 col-form-label">Nama Penyusun</label>
                            <label class="col-sm-1 col-form-label">:</label>
                            <div class="col">
                                <input type="text" class="form-control" readonly value="{{ $res->data_informasi->identitas->nama }}">
                            </div>
                        </div>

                        <div class="mb-1 row mx-lg-5">
                            <label class="col-sm-4 col-form-label">Institusi</label>
                            <label class="col-sm-1 col-form-label">:</label>
                            <div class="col">
                                <input type="text" class="form-control" readonly value="{{ $res->data_informasi->identitas->institusi }}">
                            </div>
                        </div>

                        <div class="mb-1 row mx-lg-5">
                            <label class="col-sm-4 col-form-label">Tahun Ajaran</label>
                            <label class="col-sm-1 col-form-label">:</label>
                            <div class="col">
                                <input type="text" class="form-control" readonly value="{{ $res->data_informasi->identitas->TAwal . " / " . $res->data_informasi->identitas->TAkhir }}">
                            </div>
                        </div>

                        <div class="mb-1 row mx-lg-5">
                            <label class="col-sm-4 col-form-label">Mata Pelajaran</label>
                            <label class="col-sm-1 col-form-label">:</label>
                            <div class="col">
                                <input type="text" class="form-control" readonly value="{{ $res->data_informasi->identitas->mapel }}">
                            </div>
                        </div>

                        <div class="mb-1 row mx-lg-5">
                            <label class="col-sm-4 col-form-label">Kelas/Fase</label>
                            <label class="col-sm-1 col-form-label">:</label>
                            <div class="col">
                                <input type="text" class="form-control" readonly value="{{ $res->data_informasi->identitas->kelas }} / Fase {{ $res->data_informasi->identitas->fase }}">
                            </div>
                        </div>

                        <div class="mb-1 row mx-lg-5">
                            <label class="col-sm-4 col-form-label">Alokasi Waktu</label>
                            <label class="col-sm-1 col-form-label">:</label>
                            <div class="col">
                                <input type="text" class="form-control" readonly value="{{ $res->data_informasi->identitas->waktu *  $res->data_informasi->identitas->kali . " Menit ( " . $res->data_informasi->identitas->kali . " x " . $res->data_informasi->identitas->waktu . " Menit )"}}">
                            </div>
                        </div>
                    </div>

                    <center>
                        <form action="{{ config('app.url') }}" method="post">
                            @csrf
                            <input type="hidden" name="mod_id" value="{{ $res['mod_id'] }}">
                            <button type="submit" formaction="/modul/edit/informasiumum/identitas" class="form-control btn btn-success mb-3 bi-pencil" style="width: 50%">
                                Edit Identitas
                            </button>
                        </form>
                    </center>

                </div>

                <!-- -->
                <div class="card mt-2">
                    <div class="card-header fw-bold">
                    B. PROFIL PELAJAR PANCASILA
                    </div>
                    <div class="card-body">

                        @if ($res->data_ppp == 'Data Belum Dibuat')
                        <div class="mb-1 mx-lg-5">
                            <label class="form-label fw-bold">{{ $res->data_ppp }}</label>
                        </div>
                        @else
                            @foreach ($res->data_ppp as $dp)
                                @if($dp->isi != "")
                                    <div class="mb-4 mx-lg-5">
                                        <label class="form-label fw-bold">{{ $dp->subjudul }}</label>
                                        <div class="form-control">
                                            @php
                                                echo $dp->isi;
                                            @endphp
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                    </div>

                    <center>
                        <form action="{{ config('app.url') }}" method="post">
                            @csrf
                            <input type="hidden" name="mod_id" value="{{ $res['mod_id'] }}">
                            <button type="submit" formaction="/modul/edit/informasiumum/ppp" class="form-control btn btn-success mb-3 bi-pencil" style="width: 50%">
                                Edit Profil Pelajar Pancasila
                            </button>
                        </form>
                    </center>
                </div>

                <!-- -->
                <div class="card mt-2">
                    <div class="card-header fw-bold">
                    C. SARANA DAN PRASARANA
                    </div>
                    <div class="card-body">

                        <div class="mb-4 row mx-lg-5">
                            <label class="form-label fw-bold">Sarana</label>
                            <div class="form-control">
                                @php
                                    echo $res->data_informasi->sarana;
                                @endphp
                            </div>
                        </div>

                        <div class="mb-1 row mx-lg-5">
                            <label class="form-label fw-bold">Prasarana</label>
                            <div class="form-control">
                                @php
                                    echo $res->data_informasi->prasarana;
                                @endphp
                            </div>
                        </div>
                    </div>
                    <center>
                        <form action="{{ config('app.url') }}" method="post">
                            @csrf
                            <input type="hidden" name="mod_id" value="{{ $res['mod_id'] }}">
                            <button type="submit" formaction="/modul/edit/informasiumum/sarana"
                            class="form-control btn btn-success mb-3 bi-pencil" style="width: 50%">
                                Edit Sarana Dan Prasarana
                            </button>
                        </form>
                    </center>
                </div>

                    <!-- -->
                    <div class="card mt-2">
                        <div class="card-header fw-bold">
                        D. TARGET PESERTA DIDIK
                        </div>
                        <div class="card-body">

                            <div class="form-control">
                                @php
                                    echo $res->data_informasi->target;
                                @endphp
                            </div>
                        </div>
                        <center>
                            <form action="{{ config('app.url') }}" method="post">
                                @csrf
                                <input type="hidden" name="mod_id" value="{{ $res['mod_id'] }}">
                                <button type="submit" formaction="/modul/edit/informasiumum/target"
                                class="form-control btn btn-success mb-3 bi-pencil" style="width: 50%">
                                    Edit Target Peserta DIdik
                                </button>
                            </form>
                        </center>
                    </div>

                <!-- -->
                <div class="card mt-2">
                    <div class="card-header fw-bold">
                    E. PENDEKATAN, MODEL, METODE, DAN TEKNIK PEMBELAJARAN
                    </div>
                    <div class="card-body">

                        <div class="mb-4 row mx-lg-5">
                            <label class="form-label fw-bold">Pendekatan</label>
                            <ol class="list-group list-group-numbered">
                                @foreach ($res->data_informasi->model as $del)
                                    @if ($del->kategori == "Pendekatan" && $del->metode != "")
                                        <li class="list-group-item">{{ $del->metode }}</li>
                                    @endif
                                @endforeach
                            </ol>
                        </div>

                        <div class="mb-4 row mx-lg-5">
                            <label class="form-label fw-bold">Model</label>
                            <ol class="list-group list-group-numbered">
                                @foreach ($res->data_informasi->model as $del)
                                    @if ($del->kategori == "Model"  && $del->metode != "")
                                        <li class="list-group-item">{{ $del->metode }}</li>
                                    @endif
                                @endforeach
                            </ol>
                        </div>

                        <div class="mb-4 row mx-lg-5">
                            <label class="form-label fw-bold">Metode</label>
                            <ol class="list-group list-group-numbered">
                                @foreach ($res->data_informasi->model as $del)
                                    @if ($del->kategori == "Metode" && $del->metode != "")
                                        <li class="list-group-item">{{ $del->metode }}</li>
                                    @endif
                                @endforeach
                            </ol>
                        </div>

                        <div class="mb-4 row mx-lg-5">
                            <label class="form-label fw-bold">Teknik</label>
                            <ol class="list-group list-group-numbered">
                                @foreach ($res->data_informasi->model as $del)
                                    @if ($del->kategori == "Teknik" && $del->metode != "")
                                        <li class="list-group-item">{{ $del->metode }}</li>
                                    @endif
                                @endforeach
                            </ol>
                        </div>

                    </div>
                </div>

                <!-- -->
                <div class="card mt-2">
                    <div class="card-header fw-bold">
                        F. TUJUAN PEMBELAJARAN
                    </div>
                    <div class="card-body">

                        @if ($res->data_komponen_inti->Tujuan == '')
                        <div class="mb-1 mx-lg-5">
                            <label class="form-label fw-bold">Tidak Ada Data</label>
                        </div>
                        @else
                        <div class="mb-3 row mx-lg-5">
                            <div class="form-control">
                                @php
                                    echo $res->data_komponen_inti->Tujuan;
                                @endphp
                            </div>
                        </div>
                        @endif

                        <center>
                            <form action="{{ config('app.url') }}" method="post">
                                @csrf
                                <input type="hidden" name="mod_id" value="{{ $res['mod_id'] }}">
                                <button type="submit" formaction="/modul/edit/komponeninti/tujuan"
                                class="form-control btn btn-success mb-3 bi-pencil" style="width: 50%">
                                    Edit Tujuan
                                </button>
                            </form>
                        </center>
                    </div>
                </div>

                <!-- -->
                <div class="card mt-2">
                    <div class="card-header fw-bold">
                        G. Asasmen
                    </div>
                    <div class="card-body">

                        @if ($res->data_komponen_inti->asasmen_diagnostik != '')
                        <div class="mb-3 row mx-lg-5">
                            <label class="form-label fw-bold">Asasmen Diagnostik</label>
                            <div class="form-control">
                                @php
                                    echo $res->data_komponen_inti->asasmen_diagnostik;
                                @endphp
                            </div>
                        </div>
                        @endif

                        @if ($res->data_komponen_inti->asasmen_formatif != '')
                        <div class="mb-3 row mx-lg-5">
                            <label class="form-label fw-bold">Asasmen Formatif</label>
                            <div class="form-control">
                                @php
                                    echo $res->data_komponen_inti->asasmen_formatif;
                                @endphp
                            </div>
                        </div>
                        @endif

                        @if ($res->data_komponen_inti->asasmen_sumatif != '')
                        <div class="mb-3 row mx-lg-5">
                            <label class="form-label fw-bold">Asasmen Sumatif</label>
                            <div class="form-control">
                                @php
                                    echo $res->data_komponen_inti->asasmen_sumatif;
                                @endphp
                            </div>
                        </div>
                        @endif

                        <center>
                            <form action="{{ config('app.url') }}" method="post">
                                @csrf
                                <input type="hidden" name="mod_id" value="{{ $res['mod_id'] }}">
                                <button type="submit" formaction="/modul/edit/komponeninti/asasmen"
                                class="form-control btn btn-success mb-3 bi-pencil" style="width: 50%">
                                    Edit Asasmen
                                </button>
                            </form>
                        </center>
                    </div>
                </div>

                <!-- -->
                <div class="card mt-2">
                    <div class="card-header fw-bold">
                        H. Pemahaman Bermakna
                    </div>
                    <div class="card-body">

                        @if ($res->data_komponen_inti->pemahaman_bermakna != '')
                        <div class="mb-3 row mx-lg-5">

                            <div class="form-control">
                                @php
                                    echo $res->data_komponen_inti->pemahaman_bermakna;
                                @endphp
                            </div>
                        </div>
                        @endif

                        <center>
                            <form action="{{ config('app.url') }}" method="post">
                                @csrf
                                <input type="hidden" name="mod_id" value="{{ $res['mod_id'] }}">
                                <button type="submit" formaction="/modul/edit/komponeninti/pemahaman"
                                class="form-control btn btn-success mb-3 bi-pencil" style="width: 50%">
                                    Edit Pehaman Bermakna
                                </button>
                            </form>
                        </center>
                    </div>
                </div>

                <!-- -->
                <div class="card mt-2">
                    <div class="card-header fw-bold">
                        I. Pertanyaan Pemantik
                    </div>
                    <div class="card-body">

                        @if ($res->data_komponen_inti->pemantik != '')
                        <div class="mb-3 row mx-lg-5">

                            <div class="form-control">
                                @php
                                    echo $res->data_komponen_inti->pemantik;
                                @endphp
                            </div>
                        </div>
                        @endif

                        <center>
                            <form action="{{ config('app.url') }}" method="post">
                                @csrf
                                <input type="hidden" name="mod_id" value="{{ $res['mod_id'] }}">
                                <button type="submit" formaction="/modul/edit/komponeninti/pemantik"
                                class="form-control btn btn-success mb-3 bi-pencil" style="width: 50%">
                                    Edit Pertanyaan Pemantik
                                </button>
                            </form>
                        </center>

                    </div>
                </div>

                <!-- -->
                <div class="card mt-2">
                    <div class="card-header fw-bold">
                        J. Kegiatan Pembelajaran
                    </div>
                    <div class="card-body">

                        <div class="card">
                            <h3 class="text-center"> Pertemuan 1</h3>
                            <div class="card mb-2 border-2 border-primary">
                                <div class="card-body">
                                    <center>
                                        <h5 class="card-title">Pembukaan</h5>
                                        <p class="card-subtitle">Dilaksanakan Selama : {{ $res->ki_pembukaan[0]->waktu }} Menit</p>
                                    </center>
                                    @foreach ($res->ki_pembukaan as $buka)
                                    <label class="form-label fw-bold">{{ $buka->langkah }}</label>
                                    <div class="mb-3 row mx-lg-5">
                                        <div class="form-control">
                                            {{ $buka->isi }}
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>

                            <div class="card mb-2 border-2 border-primary">
                                <div class="card-body">
                                    <center><h5 class="card-title">Kegiatan Inti</h5></center>
                                    @foreach ($res->ki_kegiatan as $k)
                                    <label class="form-label fw-bold">{{ $k->metode }}</label>
                                    <div class="mb-3 row mx-lg-5">
                                        <div class="form-control col-4">
                                            @php
                                                echo $k->isi
                                            @endphp
                                        </div>

                                        <div class="form-control col-1 mt-2 ms-5">
                                            Waktu : {{ $k->waktu }} Menit
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>

                            <div class="card mb-2 border-2 border-primary">
                                <div class="card-body">
                                    <center><h5 class="card-title">Penutup</h5></center>
                                    @foreach ($res->ki_penutup as $pp)
                                    <label class="form-label fw-bold">{{ $pp->langkah }}</label>
                                    <div class="mb-3 row mx-lg-5">

                                            <div class="col-10 col-form-label card">
                                                @php
                                                    echo $pp->isi
                                                @endphp
                                            </div>

                                            <div class="col-sm-2 col-form-label card">
                                                {{ $pp->waktu }} Menit
                                            </div>

                                    </div>
                                    @endforeach

                                </div>
                            </div>
                            <center>
                                <form action="{{ config('app.url') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="mod_id" value="{{ $res['mod_id'] }}">
                                    <button type="submit" formaction="/modul/edit/lampiran/lampiran2" class="form-control btn btn-success mb-3 bi-pencil" style="width: 50%">
                                        Edit Pertemuan 1
                                    </button>
                                </form>
                            </center>
                        </div>
                        <center>
                            <form action="{{ config('app.url') }}" method="post">
                                @csrf
                                <input type="hidden" name="mod_id" value="{{ $res['mod_id'] }}">
                                <button type="submit" formaction="/modul/edit/lampiran/lampiran2" class="form-control btn btn-success mb-3 mt-3 bi-pencil" style="width: 50%">
                                    Tambah Pertemuan
                                </button>
                            </form>
                        </center>
                    </div>
                </div>

                <!-- -->
                <div class="card mt-2">
                    <div class="card-header fw-bold">
                    K. Lampiran
                    </div>
                    <div class="card-body">


                        <div class="card mb-4 border-2 border-primary">
                            <div class="card-body">
                                <center><h5 class="card-title">Lampiran LKPD</h5></center>
                                    @if(file_exists('lampiran/'.$res['users_id'].'/'.$res['id'].'/'.'L1-'.$res['id'].'-'.$res['users_id'].'.pdf'))
                                    <div class="ratio ratio-16x9">
                                        <embed
                                            src="{{asset('lampiran/'.$res['users_id']).'/'.$res['id'].'/'.'L1-'.$res['id'].'-'.$res['users_id'].'.pdf#toolbar=0'}}"
                                            type="application/pdf"
                                            width="700"
                                            height="500">
                                    </div>
                                    @else
                                        <Center>
                                            <p>Tidak Ada Lampiran</p>
                                        </Center>
                                    @endif
                            </div>
                        </div>

                        <div class="card mb-4 border-2 border-primary">
                            <div class="card-body">
                                <center><h5 class="card-title">Pengayaan Dan Remedial</h5></center>

                                    @if(file_exists('lampiran/'.$res['users_id'].'/'.$res['id'].'/'.'L2-'.$res['id'].'-'.$res['users_id'].'.pdf'))
                                    <div class="ratio ratio-16x9">
                                        <embed
                                            src="{{asset('lampiran/'.$res['users_id']).'/'.$res['id'].'/'.'L2-'.$res['id'].'-'.$res['users_id'].'.pdf#toolbar=0'}}"
                                            type="application/pdf"
                                            width="700"
                                            height="500">
                                    </div>
                                    @else
                                        <Center>
                                            <p>Tidak Ada Lampiran</p>
                                        </Center>
                                    @endif

                            </div>
                        </div>

                        <div class="card mb-4 border-2 border-primary">
                            <div class="card-body">
                                <center><h5 class="card-title">Bahan Bacaan Peserta Didik dan Pendidik</h5></center>
                                @if(file_exists('lampiran/'.$res['users_id'].'/'.$res['id'].'/'.'L3-'.$res['id'].'-'.$res['users_id'].'.pdf'))
                                <div class="ratio ratio-16x9">
                                    <embed
                                        src="{{asset('lampiran/'.$res['users_id']).'/'.$res['id'].'/'.'L3-'.$res['id'].'-'.$res['users_id'].'.pdf#toolbar=0'}}"
                                        type="application/pdf"
                                        width="700"
                                        height="500">
                                </div>
                                @else
                                    <Center>
                                        <p>Tidak Ada Lampiran</p>
                                    </Center>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <!-- -->
                <div class="card mt-2">
                    <div class="card-header fw-bold">
                        L. Glossarium
                    </div>
                    <div class="card-body">
                        @php
                            echo $res['lampiran'][0]['glossarium'];
                        @endphp
                    </div>
                    <!-- Belum -->
                    <center>
                        <form action="{{ config('app.url') }}" method="post">
                            @csrf
                            <input type="hidden" name="mod_id" value="{{ $res['mod_id'] }}">
                            <button type="submit" formaction="/modul/edit/lampiran/lampiran2" class="form-control btn btn-success mb-3 bi-pencil" style="width: 50%">
                                Edit Glossarium
                            </button>
                        </form>
                    </center>
                </div>

                <!-- -->
                <div class="card mt-2">
                    <div class="card-header fw-bold">
                        M. Daftar Pustaka
                    </div>
                    <div class="card-body">
                        @php
                            if($res['lampiran'][0]['dapus'] == ""){
                                echo "<center>Dapus Masih Kosong</center>";
                            }else{
                                echo $res['lampiran'][0]['dapus'];
                            }
                        @endphp
                    </div>
                    <!-- Belum -->
                    <center>
                        <form action="{{ config('app.url') }}" method="post">
                            @csrf
                            <input type="hidden" name="mod_id" value="{{ $res['mod_id'] }}">
                            <button type="submit" formaction="/modul/edit/lampiran/lampiran3" class="form-control btn btn-success mb-3 bi-pencil" style="width: 50%">
                                Edit Daftar Pustaka
                            </button>
                        </form>
                    </center>
                </div>
            </div>
        </div>

        <script>
            var div = document.getElementById("Iframe");
            div.onload = function() {
              //div.style.height = div.contentWindow.document.body.scrollHeight + 'px';
              div.style.width = 100%;
            }
          </script>

@endsection

@section('sidemenu')
        @include('users.modulMenu')
@endsection
