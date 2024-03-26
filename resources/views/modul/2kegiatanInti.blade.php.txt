@php
    $modul = session()->get('modul');
    $x = 0;
    $def = $modul['waktu'] - $modul['wpembuka'];
@endphp

<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title text-center">Kegiatan Inti</h4>
        @if(session()->has('modul'))

            @foreach ($modul['i4'] as $m)
                @if ($m->metode != "")
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title">{{ $m->metode }}</h5>

                            <textarea name="i_{{ $x }}" id="editor{{ $x }}"></textarea>

                            <div class="mb-3 mt-3 end-0 row">
                                <label class="col-sm-3 col-form-label">Waktu Kegiatan</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" name="w_{{ $x }}" id="bw_{{ $x }}" onkeydown="ubahwaktu()" onkeyup="ubahwaktu()" value="0">
                                </div>
                                <label class="col-sm-2 col-form-label">Menit</label>
                            </div>

                            <input type="hidden" name="metode_{{ $x++ }}" value="{{ $m->metode }}">
                        </div>
                    </div>
                @endif
            @endforeach

        @endif
        <input type="hidden" name="total_waktu" id="inwaktu">

        <div class="position-relative bottom-0 start-50 translate-middle-x mt-3" style="width:50%">
            <div class="row">
                <button type="submit" class="btn btn-success col me-3 bi-check-square"> Simpan </button>
                <a href="" class="btn btn-danger col bi-x-square"> Batalkan </a>
            </div>
        </div>

    </div>
</div>


<script>
@php
    $i = 0;
@endphp
@foreach ($modul['i4'] as $m)
    @if ($m->metode != "")
    ClassicEditor
            .create( document.querySelector( '#editor{{ $i++ }}' ) )
            .catch( error => {
                console.error( error );
            } );
    @endif
@endforeach

function ubahwaktu(){
    @php
        $i = 0;
    @endphp
    var val = 0;
    @foreach ($modul['i4'] as $m)
        @if ($m->metode != "")
            var bx{{ $i }} = document.getElementById('bw_{{ $i }}').value;
            if(bx{{ $i }} == ""){
                bx{{ $i }} = 0;
            }
            val += parseInt(bx{{ $i++ }});
        @endif
    @endforeach

    document.getElementById('nwaktu').innerHTML = "Total Waktu Saat Ini : " + ({{ $def }} - val) + " Menit";
    document.getElementById('inwaktu').value = val;
}
</script>

@section('sidemenu')
    @include('users.stepbar')
    <div class="card position-fixed" style="margin-top:16%;width:15%">
        <div class="card-body">
            <h5 class="card-text" id="nwaktu">Total Waktu Saat Ini : {{ $def }} Menit</h5>
        </div>
    </div>

@endsection

