<ul class="list-group position-fixed" style="width: 15%">
    <li class="list-group-item">
        <center>
            <img src="{{ asset('img/sismoja1.png') }}" alt="Unib" style="width: 50%;height:50%;">
            <span class="badge rounded-pill text-bg-primary fs-4 mb-4">{{ config('app.name') }}</span>
        </center>
    </li>

    <a href="/modul/buat" class="list-group-item list-group-item-action bi-plus-circle bg-success text-white"> Buat Modul </a>
    <a href="/" class="list-group-item list-group-item-action bi-house"> Dashboard</a>
    <a href="/modul"class="list-group-item list-group-item-action bi-files"> Modul Saya</a>
    <a href="/profil" class="list-group-item list-group-item-action bi-person mb-3"> Profil</a>
    <a href="/keluar" class="list-group-item list-group-item-action bg-danger text-white"> <i class="bi bi-box-arrow-left"></i> Keluar</a>
</ul>

