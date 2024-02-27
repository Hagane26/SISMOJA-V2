@php
    $modul = session()->get('modul');
@endphp
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Identitas</h4>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 25%">Nama Penyusun</span>
            <input type="text" class="form-control" id="penyusun" name="penyusun">
        </div>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 25%">Institusi</span>
            <input type="text" class="form-control" id="institusi" name="institusi">
        </div>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 25%">Mata Pelajaran</span>
            <input type="text" class="form-control" id="mapel" name="mapel">
        </div>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 40%">Fase dan Kelas</span>
            <div class="input-group">
                <select class="form-select" id="fase" name="fase">
                    <option value = 0 selected>------ Pilih Fase ------</option>
                    <option value="1">Fase 0 : Kelas TK</option>
                    <option value="A">Fase A : Kelas 1 dan 2 (SD)</option>
                    <option value="B">Fase B : Kelas 3 dan 4 (SD)</option>
                    <option value="C">Fase C : Kelas 5 dan 6 (SD)</option>
                    <option value="D">Fase D : Kelas 7, 8, 9 (SMP)</option>
                    <option value="E">Fase E : Kelas 10 (SMA)</option>
                    <option value="F">Fase F : Kelas 11 dan 12 (SMA)</option>
                </select>

                <input type="text" placeholder="Nama Kelas, Contoh : 1A" class="form-control" id="kelas" name="kelas">
            </div>
        </div>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 25%">Tahun Ajaran</span>
            <input type="number" placeholder="{{ date('Y') - 1 }}" class="form-control" id="TA_awal" name="TA_awal">

                <span class="input-group-text">/</span>
                <input type="number" placeholder="{{ date('Y') }}" class="form-control" id="TA_akhir" name="TA_akhir">
        </div>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 25%">Alokasi Waktu</span>

            <input type="number" placeholder="contoh : 2" class="form-control" id="kali" name="kali">
            <span class="input-group-text"> X </span>

            <input type="number" placeholder="contoh : 45" class="form-control" id="waktu" name="waktu">
            <span class="input-group-text">Menit</span>
        </div>

        <div class="position-relative bottom-0 start-50 translate-middle-x mt-3" style="width:50%">
            <div class="row">
                <button type="submit" class="btn btn-success col me-3 bi-check-square"> Simpan </button>
                <a href="" class="btn btn-danger col bi-x-square"> Batalkan </a>
            </div>
        </div>

    </div>
</div>

