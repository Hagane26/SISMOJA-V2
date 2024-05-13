@php
    $modul = session()->get('modul');
@endphp
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Pertemuan {{ $res['pertemuan'] }} : Kegiatan Pembuka</h4>
        <h6 class="card-subtitle bi-exclamation-triangle-fill m-3" style="color: red"> Harus di Isi 7 Kegiatan Tersebut</h6>

        @if (session()->has('modul'))
            @php
                $modul = session()->get('modul');
                $dn = array();
                if($res['status']=="Edit"){
                    for ($i=0; $i < count($modul['ki_pembukaan']); $i++) { 
                        if($modul['ki_pembukaan'][$i]->pertemuan == $res['pid']){
                            $wp = $modul['ki_pembukaan'][$i]->waktu;
                            array_push($dn,$modul['ki_pembukaan'][$i]->id);
                        }
                    }
                }
            @endphp
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row">
                        <label class="col-5 form-label" id="boxwaktu">Sisa Waktu : {{ $modul['waktu'] - $wp }} Menit</label>
                        <div class="col">
                            <label for="basic-url" class="form-label">Waktu Untuk Pembukaan</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" value="{{ $wp }}" name="waktu" onkeydown="waktuubah(this)" onkeyup="waktuubah(this)">
                                <span class="input-group-text">Menit dari total waktu ({{ $modul['waktu'] }} menit).</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif
        
        @php
             if($res['status']=="Edit"){
                echo "<input type='hidden' name='pertemuan' value='$res[pid]'>";
                for ($i=0; $i < count($dn); $i++) { 
                    echo "<input type='hidden' name='k-$i' value='$dn[$i]'>";
                }
             }
        @endphp
        
        <div class="card mb-2">
            <div class="card-body">
                <div class="row g-2 align-items-center ms-5 mb-4">
                    <h5 class="form-label">Kegiatan 1 : Salam Pembuka</h5>

                    <textarea name="p-1" class="form-control">{{ $modul['k2'] == "" ? "" : $modul['k2'][0]['isi'] }} @php
                            if($res['status']=="Edit"){
                                for ($i=0; $i < count($modul['ki_pembukaan']); $i++) { 
                                    if($modul['ki_pembukaan'][$i]->pertemuan == $res['pid'] && $modul['ki_pembukaan'][$i]->langkah == "kegiatan 1"){
                                        echo $modul['ki_pembukaan'][$i]->isi;
                                    }
                                }
                            }
                        @endphp
                    </textarea>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <div class="row g-2 align-items-center ms-5 mb-4">
                    <h5 class="form-label">Kegiatan 2 : Pengkondisian Kelas</h5>

                    <textarea name="p-2" class="form-control">{{ $modul['k2'] == "" ? "" : $modul['k2'][1]['isi'] }}@php
                        if($res['status']=="Edit"){
                            for ($i=0; $i < count($modul['ki_pembukaan']); $i++) { 
                                if($modul['ki_pembukaan'][$i]->pertemuan == $res['pid'] && $modul['ki_pembukaan'][$i]->langkah == "kegiatan 2"){
                                    echo $modul['ki_pembukaan'][$i]->isi;
                                }
                            }
                        }
                    @endphp</textarea>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <div class="row g-2 align-items-center ms-5 mb-4">
                    <h5 class="form-label">Kegiatan 3 : Do'a</h5>

                    <textarea name="p-3" class="form-control">{{ $modul['k2'] == "" ? "" : $modul['k2'][2]['isi'] }}@php
                        if($res['status']=="Edit"){
                            for ($i=0; $i < count($modul['ki_pembukaan']); $i++) { 
                                if($modul['ki_pembukaan'][$i]->pertemuan == $res['pid'] && $modul['ki_pembukaan'][$i]->langkah == "kegiatan 3"){
                                    echo $modul['ki_pembukaan'][$i]->isi;
                                }
                            }
                        }
                    @endphp</textarea>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <div class="row g-2 align-items-center ms-5 mb-4">
                    <h5 class="form-label">Kegiatan 4 : Presensi</h5>

                    <textarea name="p-4" class="form-control">{{ $modul['k2'] == "" ? "" : $modul['k2'][3]['isi'] }}@php
                        if($res['status']=="Edit"){
                            for ($i=0; $i < count($modul['ki_pembukaan']); $i++) { 
                                if($modul['ki_pembukaan'][$i]->pertemuan == $res['pid'] && $modul['ki_pembukaan'][$i]->langkah == "kegiatan 4"){
                                    echo $modul['ki_pembukaan'][$i]->isi;
                                }
                            }
                        }
                    @endphp</textarea>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <div class="row g-2 align-items-center ms-5 mb-4">
                    <h5 class="form-label">Kegiatan 5 : Apersepsi</h5>

                    <textarea name="p-5" class="form-control">{{ $modul['k2'] == "" ? "" : $modul['k2'][4]['isi'] }}@php
                        if($res['status']=="Edit"){
                            for ($i=0; $i < count($modul['ki_pembukaan']); $i++) { 
                                if($modul['ki_pembukaan'][$i]->pertemuan == $res['pid'] && $modul['ki_pembukaan'][$i]->langkah == "kegiatan 5"){
                                    echo $modul['ki_pembukaan'][$i]->isi;
                                }
                            }
                        }
                    @endphp</textarea>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <div class="row g-2 align-items-center ms-5 mb-4">
                    <h5 class="form-label">Kegiatan 6 : Motivasi</h5>

                    <textarea name="p-6" class="form-control">{{ $modul['k2'] == "" ? "" : $modul['k2'][5]['isi'] }}@php
                        if($res['status']=="Edit"){
                            for ($i=0; $i < count($modul['ki_pembukaan']); $i++) { 
                                if($modul['ki_pembukaan'][$i]->pertemuan == $res['pid'] && $modul['ki_pembukaan'][$i]->langkah == "kegiatan 6"){
                                    echo $modul['ki_pembukaan'][$i]->isi;
                                }
                            }
                        }
                    @endphp</textarea>
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body">
                <div class="row g-2 align-items-center ms-5 mb-4">
                    <h5 class="form-label">Kegiatan 7 : Penyampaian Tujuan Pembelajaran</h5>

                    <textarea name="p-7" class="form-control">{{ $modul['k2'] == "" ? "" : $modul['k2'][6]['isi'] }}@php
                        if($res['status']=="Edit"){
                            for ($i=0; $i < count($modul['ki_pembukaan']); $i++) { 
                                if($modul['ki_pembukaan'][$i]->pertemuan == $res['pid'] && $modul['ki_pembukaan'][$i]->langkah == "kegiatan 7"){
                                    echo $modul['ki_pembukaan'][$i]->isi;
                                }
                            }
                        }
                    @endphp</textarea>
                </div>
            </div>
        </div>

        <div class="position-relative bottom-0 start-50 translate-middle-x mt-3" style="width:50%">
            <div class="row">
                <button type="submit" class="btn btn-success col me-3 bi-check-square"> Simpan </button>
                <a href="{{ $res['batal'] }}" class="btn btn-danger col bi-x-square"> Batalkan </a>
            </div>
        </div>

    </div>
</div>

<script>
    function waktuubah(e){
        var tm = e.value;
        if (tm < 0){
            warning = "(Tidak Valid)";
        }else{
            warning = "";
        }
        var boxwaktu = document.getElementById('boxwaktu').innerHTML = "Sisa Waktu : " + ({{ $modul['waktu'] }} - e.value) + " Menit" + warning;
    }
</script>

