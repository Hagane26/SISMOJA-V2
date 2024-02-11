<div class="list-group position-fixed">
    <form action="{{ config('app.url') }}" method="post" target="_blank">
        @csrf
        <input type="hidden" name="mod_id" value="{{ $res['mod_id'] }}">

        <button type="submit" formaction="/modul/print" class="list-group-item list-group-item-action bi-printer">
            Print
        </button>

        <button type="submit" formaction="/modul/hapus" class="list-group-item list-group-item-action bi-trash3">
            Hapus
        </button>
    </form>

</div>


