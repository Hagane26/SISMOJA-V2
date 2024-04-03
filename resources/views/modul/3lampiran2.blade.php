<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Glossarium</h4>

        <div class="row g-2 align-items-center mb-2 ms-5 me-5">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">Masukkan Kata Dibawah Untuk Menemukan Artinya :</p>
                    <input type="text" class="form-control" id="ck" onkeyup="cek(this)">

                    <div class="card mt-2">
                        <ul id="res" class="list-group list-group-flush mt-3" style="height: 150px;overflow-y: scroll;">

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-2 align-items-center ms-5 mb-2">
            <h4>Isi Glossarium</h4>
            <textarea name="glossarium" id="editor"></textarea>
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
    function cek(e){
        if(e.value == ""){
            $("#res").empty();
        }else{
            $.getJSON("http://localhost:8000/get-kbbi/"+e.value, function(data) {
            $("#res").empty();
            var results = data.result;
            $.each(results, function(index,value) {
                $("#res").append(
                    "<li class='list-group-item'>" +
                        "<div class='card'>" +
                            "<div class='card-body'>" +
                                value +
                            "</div>" +
                        "</div>" +
                    "</li>"
                );
            });
        });
        }
    }
</script>
