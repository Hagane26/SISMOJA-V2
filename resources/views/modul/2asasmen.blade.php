@php
    $modul = session()->get('modul');
@endphp
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Asesmen</h4>

        <div class="row g-2 align-items-center ms-5 mb-2">
            <label class="col-form-label">Asesmen Diagnostik</label>
            <textarea name="ad" id="editor">{{ $modul['k1']['asasmen_diagnostik'] }}</textarea>
        </div>

        <div class="row g-2 align-items-center ms-5 mb-2">
            <label class="col-form-label">Asesmen Formatif</label>
            <textarea name="af" id="editor2">{{ $modul['k1']['asasmen_formatif'] }}</textarea>
        </div>

        <div class="row g-2 align-items-center ms-5 mb-2">
            <label class="col-form-label">Asesmen Sumatif</label>
            <textarea name="as" id="editor3">{{ $modul['k1']['asasmen_sumatif'] }}</textarea>
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
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#editor2' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#editor3' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

