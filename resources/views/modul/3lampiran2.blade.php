<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Glossarium</h4>

        <div class="row g-2 align-items-center ms-5 mb-2">
            <textarea name="glossarium" id="editor"></textarea>
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
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
    function cek(e){
        $.getJSON("http://kateglo.lostfocus.org/api.php?format=json&phrase="+e.value, function(data) {
            $("#res").empty();

            $.each(data.kateglo.definition, function() {
                $("#res").append(
                    "<li class='list-group-item'>" + "a" + "</li>"
                );
            });
        });
    }
</script>

@section('sidemenu')
    @include('users.stepbar')

    <div class="card position-fixed" style="margin-top:16%;width:15%">
        <div class="card-body">
            <p class="card-text">Cari Kata:</p>
            <input type="text" class="form-control" id="ck" onkeyup="cek(this)">

            <ul id="res" class="list-group list-group-flush mt-3" style="height: 230px;overflow-y: scroll;">

            </ul>

        </div>
    </div>

@endsection
