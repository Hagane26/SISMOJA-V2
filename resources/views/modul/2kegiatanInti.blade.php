@php
    $modul = session()->get('modul');
    $x = 0;
    $def = $modul['waktu'] - $modul['wpembuka'];
@endphp

<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title text-center">Pertemuan {{ $res['pertemuan'] }} : Kegiatan Inti</h4>

        @if (session()->has('modul'))
            @php
                $modul = session()->get('modul');
            @endphp
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row">
                        <label class="col-5 form-label" id="boxwaktu">Sisa Waktu : {{ $modul['winti'] == "" ? $def : $def - $modul['winti'] }} Menit</label>
                        <div class="col">
                            <label for="basic-url" class="form-label">Waktu Untuk Kegiatan Inti</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" value="{{ $modul['winti'] == "" ? "0" : $modul['winti'] }}" name="waktu" onkeydown="waktuubah(this)" onkeyup="waktuubah(this)">
                                <span class="input-group-text">Menit dari total waktu ({{ $def }} menit).</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif

        <div class="row g-2 align-items-center ms-5 mb-2 mt-3">
            @php
            if($res['status']=="Edit"){
                foreach ($modul['ki_kegiatan'] as $d) {
                    if($d->pertemuan == $res['pid']){
                        $kid = $d->id;
                        break;
                    }
                }
                echo "<input type='hidden' name='pertemuan' value='$res[pid]'>";
                echo "<input type='hidden' name='k-kid' value='$kid''>";
            }
            @endphp
            <textarea name="kegiataninti" id="editor">@php 
            if($res['status']=="Edit"){
                for ($i=0; $i < count($modul['ki_kegiatan']); $i++) { 
                    if($modul['ki_kegiatan'][$i]->pertemuan == $res['pid']){
                        echo $modul['ki_kegiatan'][$i]->isi;
                    }
                }
             } @endphp</textarea>
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

    function waktuubah(e){
        var tm = ({{ $def }} - e.value);
        var warning = "";
        if (tm < 0){
            warning = "(Tidak Valid)";
        }else{
            warning = "";
        }
        var boxwaktu = document.getElementById('boxwaktu').innerHTML = "Sisa Waktu : " + ({{ $def }} - e.value) + " Menit " + warning;
    }

    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

</script>


