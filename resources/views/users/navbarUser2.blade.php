<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/dashboard">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/modul">Modul Ajar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/sekolah">Data Sekolah</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/profil">Profile</a>
          </li>

          <li class="nav-item">
            <a class="nav-link bg-danger text-white ms-5" href="/logout">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
