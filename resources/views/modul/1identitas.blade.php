@php
    $modul = session()->get('modul');
@endphp
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Identitas</h4>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 18%">Nama Penyusun</span>
            <input type="text" class="form-control" id="penyusun" name="penyusun"
            value="{{ session()->has('modul.i2') == 1 ? $modul['i2']['nama'] : "" }}"
            >
        </div>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 18%">Institusi</span>
            <input type="text" class="form-control" id="institusi" name="institusi"
            value="{{ session()->has('modul.i2') == 1 ? $modul['i2']['institusi'] : "" }}">
        </div>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 18%">Mata Pelajaran</span>
            <select class="form-select" id="mapel" name="mapel">
                <option value = 0 selected>Pilih Mata Pelajaran</option>
                <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                <option value="Bahasa Inggris">Bahasa Inggris</option>
                <option value="Matematika">Matematika</option>
            </select>
        </div>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 40%">Fase / Kelas / Tahun Ajaran</span>
            <div class="input-group">
                <select class="form-select" id="fase" name="fase">
                    <option value = 0 selected>Pilih Fase</option>
                    <option value="1">Fase 0</option>
                    <option value="A">Fase A</option>
                    <option value="B">Fase B</option>
                </select>

                <input type="text" placeholder="Kelas" class="form-control" id="kelas" name="kelas"
                value="{{ session()->has('modul.i2') == 1 ? $modul['i2']['kelas'] : "" }}">

                <input type="number" placeholder="{{ date('Y') - 1 }}" class="form-control" id="TA_awal" name="TA_awal"
                value="{{ session()->has('modul.i2') == 1 ? $modul['i2']['TAwal'] : "" }}">

                <span class="input-group-text">/</span>
                <input type="number" placeholder="{{ date('Y') }}" class="form-control" id="TA_akhir" name="TA_akhir"
                value="{{ session()->has('modul.i2') == 1 ? $modul['i2']['TAkhir'] : "" }}">
            </div>
        </div>

        <div class="input-group flex-nowrap mt-3">
            <span class="input-group-text me-1 bg-secondary text-white" style="width: 18%">Alokasi Waktu</span>

            <input type="number" placeholder="Masukan angka saja" class="form-control" id="kali" name="kali"
            value="{{ session()->has('modul.i2') == 1 ? $modul['i2']['kali'] : "" }}">
            <span class="input-group-text"> X </span>

            <input type="number" placeholder="Masukan angka saja" class="form-control" id="waktu" name="waktu"
            value="{{ session()->has('modul.i2') == 1 ? $modul['i2']['waktu'] : "" }}">
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

