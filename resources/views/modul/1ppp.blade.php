<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Profil Pelajar Pancasila </h4>
        <h6 class="card-subtitle bi-info-circle-fill ms-3"> Pilih Minimal 1, Maksimal 6</h6>

        <div class="row g-2 align-items-center ms-5 mb-2 mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" onclick="ck(1)">
                <label class="form-check-label">
                    Beriman, Bertakwa kepada Tuhan Yang Maha Esa dan Berakhlak Mulia
                </label>
            </div>

            <textarea name="in_1" id="editor1"></textarea>
        </div>

        <div class="row g-2 align-items-center ms-5 mb-2 mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label">
                    Berkebhinekaan Global
                </label>
            </div>

            <textarea name="in_2" id="editor2"></textarea>
        </div>

        <div class="row g-2 align-items-center ms-5 mb-2 mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label">
                    Bergotong Royong
                </label>
            </div>

            <textarea name="in_3" id="editor3"></textarea>
        </div>

        <div class="row g-2 align-items-center ms-5 mb-2 mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label">
                    Mandiri
                </label>
            </div>

            <textarea name="in_4" id="editor4"></textarea>
        </div>

        <div class="row g-2 align-items-center ms-5 mb-2 mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label">
                    Bernalar Kritis
                </label>
            </div>

            <textarea name="in_5" id="editor5"></textarea>
        </div>

        <div class="row g-2 align-items-center ms-5 mb-2 mt-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label">
                    Kreatif
                </label>
            </div>

            <textarea name="in_6" id="editor6"></textarea>
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
        .create( document.querySelector( '#editor1' ) )
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

    ClassicEditor
        .create( document.querySelector( '#editor4' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#editor5' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#editor6' ) )
        .catch( error => {
            console.error( error );
        } );

</script>

