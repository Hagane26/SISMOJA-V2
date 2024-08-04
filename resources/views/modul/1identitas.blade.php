@php
    $modul = session()->get('modul');
@endphp
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Identitas</h4>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 25%">Nama Penyusun</span>
            <input type="text" class="form-control" id="penyusun" name="penyusun" value="{{ $modul['i2'] != "" ? $modul['i2']['nama'] : "" }}">
        </div>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 25%">Institusi</span>
            <input type="text" class="form-control" id="institusi" name="institusi" value="{{ $modul['i2'] != "" ? $modul['i2']['institusi'] : "" }}">
        </div>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 25%">Mata Pelajaran</span>
            <input type="text" class="form-control" id="mapel" name="mapel" value="{{ $modul['i2'] != "" ? $modul['i2']['mapel'] : "" }}">
        </div>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 40%">Fase dan Kelas</span>
            <div class="input-group">
                <select class="form-select" id="fase" name="fase" onchange="take_fase(this)">
                    <option value = 0 selected>------ Pilih Fase ------</option>
                    <option value="1" {{ $modul['i2'] != "" ? ($modul['i2']['fase'] == "1" ? "selected" : "") : "" }}>Fase 0 : Kelas TK</option>
                    <option value="A" {{ $modul['i2'] != "" ? ($modul['i2']['fase'] == "A" ? "selected" : "") : "" }}>Fase A : Kelas 1 dan 2 (SD)</option>
                    <option value="B" {{ $modul['i2'] != "" ? ($modul['i2']['fase'] == "B" ? "selected" : "") : "" }}>Fase B : Kelas 3 dan 4 (SD)</option>
                    <option value="C" {{ $modul['i2'] != "" ? ($modul['i2']['fase'] == "C" ? "selected" : "") : "" }}>Fase C : Kelas 5 dan 6 (SD)</option>
                    <option value="D" {{ $modul['i2'] != "" ? ($modul['i2']['fase'] == "D" ? "selected" : "") : "" }}>Fase D : Kelas 7, 8, 9 (SMP)</option>
                    <option value="E" {{ $modul['i2'] != "" ? ($modul['i2']['fase'] == "E" ? "selected" : "") : "" }}>Fase E : Kelas 10 (SMA)</option>
                    <option value="F" {{ $modul['i2'] != "" ? ($modul['i2']['fase'] == "F" ? "selected" : "") : "" }}>Fase F : Kelas 11 dan 12 (SMA)</option>
                </select>

                <input type="text" placeholder="Nama Kelas, Contoh : 1A" class="form-control" id="kelas" name="kelas" value="{{ $modul['i2'] != "" ? $modul['i2']['kelas'] : "" }}">
            </div>
        </div>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 25%">Tahun Ajaran</span>
            <input type="number" placeholder="{{ date('Y') }}" class="form-control" id="TA_awal" name="TA_awal" value="{{ $modul['i2'] != "" ? $modul['i2']['TAwal'] : "" }}">

                <span class="input-group-text">/</span>
                <input type="number" placeholder="{{ date('Y') + 1 }}" class="form-control" id="TA_akhir" name="TA_akhir" value="{{ $modul['i2'] != "" ? $modul['i2']['TAkhir'] : "" }}">
        </div>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 25%">Alokasi Waktu</span>

            <div id='AW1' class="input-group" >
                <select class="form-select" id="res" name="waktuDefault" disabled>
                    <option value = 0 selected>Pilih Fase terlebih dahulu</option>
                </select>
                <button type="button" class="btn btn-secondary" onclick="waktuCustom()">Custom</button>
            </div>

            <div id='AW2' class="input-group" hidden>
                <input type="number" placeholder="contoh : 2" class="form-control" id="kali" name="kali" value="{{ $modul['i2'] != "" ? $modul['i2']['kali'] : "0" }}">
                <span class="input-group-text"> X </span>

                <input type="number" placeholder="contoh : 45" class="form-control" id="waktu" name="waktu" value="{{ $modul['i2'] != "" ? $modul['i2']['waktu'] : "0" }}">
                <span class="input-group-text">Menit</span>
                <button type="button" class="btn btn-secondary" onclick="waktuOpsi()">Default</button>
            </div>

            <input type="hidden" id="waktupilih" name="waktupilih" value="aw1">
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
    function take_fase(e){
        $ = jQuery;
        if(e.value == "" || e.value == 0){
            $('#res').empty();
            document.getElementById('res').disabled = true;
            $('#res').append("<option value=0> Pilih Fase terlebih dahulu</option>");
        }else{
            $.getJSON("http://localhost:8000/modul/waktufase/"+e.value, function(data) {
                $('#res').empty();
                document.getElementById('res').disabled = false;
                var results = data.result;
                $.each(results, function(index,value) {
                    $('#res').append(
                        '<option value="'+value['id'] +'" {{ $modul['i2'] != "" ? ($modul['i2']['fase'] == "1" ? "selected" : "") : "" }} >'
                            + "Fase " + value['fase'] +" Durasi " + value['ket'] + " = " + value['kali'] + " x " + value['waktu']
                            +' Menit </option>'
                    );
                });
            });
        }
    }

    function waktuCustom(){
        document.getElementById('AW2').hidden = false;
        document.getElementById('AW1').hidden = true;
        document.getElementById('waktupilih').value = 'aw2';
        document.getElementById('waktu').value = '';
        document.getElementById('kali').value = '';
    }

    function waktuOpsi(){
        document.getElementById('AW2').hidden = true;
        document.getElementById('AW1').hidden = false;
        document.getElementById('waktupilih').value = 'aw1';
        document.getElementById('waktu').value = '0';
        document.getElementById('kali').value = '0';
    }
</script>

