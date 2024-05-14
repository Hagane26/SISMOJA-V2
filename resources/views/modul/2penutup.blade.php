@php
    $modul = session()->get('modul');
    $waktu = $modul['waktu'];
    $def = $waktu - $modul['wpembuka'] - $modul['winti'];

    if($res['status']=="Edit"){
        $dn = array();
        for ($i=0; $i < count($modul['ki_penutup']); $i++) { 
            if($modul['ki_penutup'][$i]->pertemuan == $res['pid'] ){
                array_push($dn,$modul['ki_penutup'][$i]->id);
            }
        }
    }

@endphp

<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Pertemuan {{ $res['pertemuan'] }} : Penutup</h4>
        <h6 class="card-subtitle bi-exclamation-triangle-fill m-3" style="color: red"> Harus di Isi 5 Kegiatan Tersebut</h6>
        <h5 class="card-text" id="nwaktu">Sisa Waktu Saat Ini : {{ $def }} Menit</h5>

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
                    <label class="form-label">Kegiatan 1 : Kesimpulan</label>

                    <textarea name="p-1a" class="form-control">@php
                        if($res['status']=="Edit"){
                            for ($i=0; $i < count($modul['ki_penutup']); $i++) { 
                                if($modul['ki_penutup'][$i]->pertemuan == $res['pid'] && $modul['ki_penutup'][$i]->langkah == "Kesimpulan"){
                                    echo $modul['ki_penutup'][$i]->isi;
                                    $w = $modul['ki_penutup'][$i]->waktu;
                                }
                            }
                        }
                    @endphp</textarea>

                    <div class="mb-3 row mt-2">
                        <label class="col-sm-3 col-form-label">Alokasi Waktu</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" name="p-1b" id="p-1b" value="0" onkeydown="ubahwaktu()" onkeyup="ubahwaktu()">
                            {{$res['status'] == 'Edit' ? "Waktu Sebelumnya : " .$w." Menit" : ""}}
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

                    <textarea name="p-2a" class="form-control">@php 
                    if($res['status']=="Edit"){
                        for ($i=0; $i < count($modul['ki_penutup']); $i++) { 
                            if($modul['ki_penutup'][$i]->pertemuan == $res['pid'] && $modul['ki_penutup'][$i]->langkah == "Evaluasi"){
                                echo $modul['ki_penutup'][$i]->isi;
                                $w = $modul['ki_penutup'][$i]->waktu;
                            }
                        }
                    } @endphp</textarea>

                    <div class="mb-3 row mt-2">
                        <label class="col-sm-3 col-form-label">Alokasi Waktu</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" name="p-2b" id="p-2b" value="0" onkeydown="ubahwaktu()" onkeyup="ubahwaktu()">
                            {{$res['status'] == 'Edit' ? "Waktu Sebelumnya : " .$w." Menit" : ""}}
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

                    <textarea name="p-3a" class="form-control">@php 
                    if($res['status']=="Edit"){
                            for ($i=0; $i < count($modul['ki_penutup']); $i++) { 
                                if($modul['ki_penutup'][$i]->pertemuan == $res['pid'] && $modul['ki_penutup'][$i]->langkah == "Refleksi"){
                                    echo $modul['ki_penutup'][$i]->isi;
                                    $w = $modul['ki_penutup'][$i]->waktu;
                                }
                            }
                        } @endphp</textarea>

                    <div class="mb-3 row mt-2">
                        <label class="col-sm-3 col-form-label">Alokasi Waktu</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" name="p-3b" id="p-3b" value="0" onkeydown="ubahwaktu()" onkeyup="ubahwaktu()">
                            {{$res['status'] == 'Edit' ? "Waktu Sebelumnya : " .$w." Menit" : ""}}
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

                    <textarea name="p-4a" class="form-control">@php
                    if($res['status']=="Edit"){
                        for ($i=0; $i < count($modul['ki_penutup']); $i++) { 
                            if($modul['ki_penutup'][$i]->pertemuan == $res['pid'] && $modul['ki_penutup'][$i]->langkah == "Penyampaian Tujuan Pembelajaran Pertemuan Selanjutnya"){
                                echo $modul['ki_penutup'][$i]->isi;
                                $w = $modul['ki_penutup'][$i]->waktu;
                            }
                        }
                    }
                    @endphp</textarea>

                    <div class="mb-3 row mt-2">
                        <label class="col-sm-3 col-form-label">Alokasi Waktu</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" name="p-4b" id="p-4b" value="0" onkeydown="ubahwaktu()" onkeyup="ubahwaktu()">
                            {{$res['status'] == 'Edit' ? "Waktu Sebelumnya : " .$w." Menit" : ""}}
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

                    <textarea name="p-5a" class="form-control">@php
                        if($res['status']=="Edit"){
                            for ($i=0; $i < count($modul['ki_penutup']); $i++) { 
                                if($modul['ki_penutup'][$i]->pertemuan == $res['pid'] && $modul['ki_penutup'][$i]->langkah == "Salam Penutup"){
                                    echo $modul['ki_penutup'][$i]->isi;
                                    $w = $modul['ki_penutup'][$i]->waktu;
                                }
                            }
                        }
                        @endphp</textarea>

                    <div class="mb-3 row mt-2">
                        <label class="col-sm-3 col-form-label">Alokasi Waktu</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" name="p-5b" id="p-5b" value="0" onkeydown="ubahwaktu()" onkeyup="ubahwaktu()">
                            {{$res['status'] == 'Edit' ? "Waktu Sebelumnya : " .$w." Menit" : ""}}
                        </div>
                        <label class="col-sm-2 col-form-label">Menit</label>
                    </div>
                    <input type="hidden" name="p-5c" value="Salam Penutup">
                </div>
            </div>
        </div>

        <input type="hidden" name="total_waktu" id="inwaktu">

        <div class="position-relative bottom-0 start-50 translate-middle-x mt-3" style="width:50%">
            <div class="row">
                <button type="submit" class="btn btn-success col me-3 bi-check-square"> Simpan </button>
                <a href="{{ $res['batal'] }}" class="btn btn-danger col bi-x-square"> Batalkan </a>
            </div>
        </div>

    </div>
</div>

<script>
    function ubahwaktu(){
        var val = 0;
        var pb1 = document.getElementById('p-1b').value;
        var pb2 = document.getElementById('p-2b').value;
        var pb3 = document.getElementById('p-3b').value;
        var pb4 = document.getElementById('p-4b').value;
        var pb5 = document.getElementById('p-5b').value;
        if(pb1 == ""){
            pb1 = 0;
        }
        if(pb2 == ""){
            pb2 = 0;
        }
        if(pb3 == ""){
            pb3 = 0;
        }
        if(pb4 == ""){
            pb4 = 0;
        }
        if(pb5 == ""){
            pb5 = 0;
        }

        val = parseInt(pb1) + parseInt(pb2) + parseInt(pb3) + parseInt(pb4) + parseInt(pb5);
        var tm = ({{ $def }} - val);
        if (tm < 0){
            warning = "(Tidak Valid)";
        }else{
            warning = "";
        }
        document.getElementById('nwaktu').innerHTML = "Sisa Waktu Saat Ini : " + ({{ $def }} - val) + " Menit " + warning;
        document.getElementById('inwaktu').value = val;
    }
</script>

