@extends('support.layout')

@section('judul')
    Dashboard
@endsection

@section('nav')
    @include('users.navbarUser')
@endsection

@section('isi')
    <p class="fs-1">
        Selamat Datang di {{ config('app.name') }}
    </p>

    <div class="card border-primary" style="width:50rem">
        <div class="card-body">
            <!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="id" lang="id"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>file_1707798256412</title><meta name="author" content="Hamidah Idah"/><style type="text/css"> * {margin:0; padding:0; text-indent:0; }
 h1 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 16pt; }
 p { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 12pt; margin:0pt; }
 .s1 { color: #202429; font-family:"Segoe UI Symbol", sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 12pt; }
 .s3 { color: #1F2023; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 12pt; }
 li {display: block; }
 #l1 {padding-left: 0pt;counter-reset: c1 1; }
 #l1> li>*:first-child:before {counter-increment: c1; content: counter(c1, decimal)". "; color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 12pt; }
 #l1> li:first-child>*:first-child:before {counter-increment: c1 0;  }
 #l2 {padding-left: 0pt;counter-reset: c2 1; }
 #l2> li>*:first-child:before {counter-increment: c2; content: counter(c2, lower-latin)". "; color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 12pt; }
 #l2> li:first-child>*:first-child:before {counter-increment: c2 0;  }
 #l3 {padding-left: 0pt;counter-reset: c3 1; }
 #l3> li>*:first-child:before {counter-increment: c3; content: counter(c3, decimal)") "; color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 12pt; }
 #l3> li:first-child>*:first-child:before {counter-increment: c3 0;  }
 #l4 {padding-left: 0pt;counter-reset: c2 1; }
 #l4> li>*:first-child:before {counter-increment: c2; content: counter(c2, lower-latin)". "; color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 12pt; }
 #l4> li:first-child>*:first-child:before {counter-increment: c2 0;  }
 #l5 {padding-left: 0pt;counter-reset: c3 1; }
 #l5> li>*:first-child:before {counter-increment: c3; content: counter(c3, decimal)") "; color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 12pt; }
 #l5> li:first-child>*:first-child:before {counter-increment: c3 0;  }
 #l6 {padding-left: 0pt;counter-reset: c2 1; }
 #l6> li>*:first-child:before {counter-increment: c2; content: counter(c2, lower-latin)". "; color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 12pt; }
 #l6> li:first-child>*:first-child:before {counter-increment: c2 0;  }
</style></head>
<body>
    <center>
        <h1 style="padding-top: 3pt">
            LANGKAH-LANGKAH DALAM PEMBUATAN SISTEM INFORMASI MODUL AJAR (SISMOJA)
        </h1>
    </center>
    <a href="{{ config('app.url') }}/Panduan-SISMOJA.pdf" target="_blank" class="btn btn-success" style="margin-left: 75%">Download Panduan</a>
    <p style="text-indent: 0pt;text-align: left;"><br/></p><ol id="l1"><li data-list-text="1."><p style="padding-left: 19pt;text-indent: -14pt;text-align: left;">Memilih ‘BUAT MODUL’.</p></li><li data-list-text="2."><p style="padding-left: 19pt;text-indent: -14pt;text-align: left;">Membuat terlebih dahulu Judul Modul.</p></li><li data-list-text="3."><p style="padding-left: 19pt;text-indent: -14pt;text-align: left;">Menekan tombol mulai buat modul.</p></li><li data-list-text="4."><p style="padding-left: 19pt;text-indent: -14pt;text-align: left;">Mengisikan Informasi Umum</p><ol id="l2"><li data-list-text="a."><p style="padding-left: 54pt;text-indent: -14pt;text-align: left;">Mengisikan Identitas Modul Ajar terdiri dari;</p><p style="text-indent: 0pt;text-align: left;"><br/></p><ol id="l3"><li data-list-text="1)"><p style="padding-left: 75pt;text-indent: -14pt;text-align: left;">Nama Penyusun yaitu mengisikan nama yang membuat modul ajar.</p></li><li data-list-text="2)"><p style="padding-left: 75pt;text-indent: -14pt;text-align: left;">Institusi yaitu dengan mengisikan tempat sekolah dari penyusun modul ajar.</p></li><li data-list-text="3)"><p style="padding-left: 75pt;text-indent: -14pt;text-align: left;">Mata Pelajaran yaitu memilih salah satu mata pelajaran.</p></li><li data-list-text="4)"><p style="padding-left: 75pt;text-indent: -14pt;text-align: left;">Fase/kelas/tahun ajaran yaitu memilih fase 0, A-F dan kelas TK A, TK B dan kelas 1-12. Lalu mengisikan tahun ajaran.</p></li><li data-list-text="5)"><p style="padding-left: 75pt;text-indent: -14pt;text-align: left;">Alokasi waktu yaitu memilih waktu yang telah ditentukan sesuai jadwal pelajaran.</p><p style="text-indent: 0pt;text-align: left;"><br/></p></li></ol></li><li data-list-text="b."><p style="padding-left: 54pt;text-indent: -14pt;text-align: left;">Selanjutnya Menekan tombol ‘Simpan’.</p></li><li data-list-text="c."><p style="padding-left: 54pt;text-indent: -14pt;text-align: left;">Mengisikan komponen awal.</p></li><li data-list-text="d."><p style="padding-left: 54pt;text-indent: -14pt;text-align: left;">Mengisikan Profil Pelajar Pancasila (PPP) dengan menceklis (<span class="s1">✔</span>) pilih minimal 1 dan maksimal 6 dengan pilihannya yaitu <span style=" color: #040C28;">beriman, bertakwa kepada Tuhan YME, dan berakhlak mulia; berkebinekaan global; bergotong-royong; mandiri; bernalar kritis; dan kreatif</span><span style=" color: #1F2023;">. Setelah memilih maka selanjutnya mengisi detail capaian kompetensi PPP.</span></p></li><li data-list-text="e."><p class="s3" style="padding-left: 54pt;text-indent: -14pt;line-height: 14pt;text-align: left;">Mengisikan Sarana dan Prasarana.</p></li><li data-list-text="f."><p class="s3" style="padding-left: 54pt;text-indent: -14pt;text-align: left;">Mengisi Target Peserta Didik dengan berisikan jumlah peserta didik dalam satu kelas.</p></li><li data-list-text="g."><p style="padding-left: 54pt;text-indent: -14pt;text-align: left;">Mengisikan Model Pembelajaran dengan menceklis (<span class="s1">✔</span>) pilihannya yaitu pendekatan, model, metode dan Teknik yang telah disediakan dan dapat juga</p><p style="padding-left: 54pt;text-indent: 0pt;text-align: left;">memilih mengisi manual ‘lainnya’. Tahap ini dapat memilih pendekatan, metode, dan Teknik lebih dari satu.</p><p style="text-indent: 0pt;text-align: left;"><br/></p></li></ol></li><li data-list-text="5."><p style="padding-left: 19pt;text-indent: -14pt;text-align: left;">Mengisikan Komponen Inti</p><ol id="l4"><li data-list-text="a."><p style="padding-left: 55pt;text-indent: -18pt;text-align: left;">Mengisikan Tujuan Pembelajaran</p></li><li data-list-text="b."><p style="padding-left: 55pt;text-indent: -18pt;text-align: left;">Mengisikan 3 Asesmen yaitu; Asesmen Diagnostik, Asesmen Formatif dan Asesmen Sumatif.</p></li><li data-list-text="c."><p style="padding-left: 55pt;text-indent: -18pt;text-align: left;">Mengisikan Pemahaman Bermakna.</p></li><li data-list-text="d."><p style="padding-left: 55pt;text-indent: -18pt;text-align: left;">Mengisikan Pertanyaan Pemantik.</p></li><li data-list-text="e."><p style="padding-left: 55pt;text-indent: -18pt;text-align: left;">Mengisikan Kegiatan Pembelajaran yang teridiri dari;</p><p style="text-indent: 0pt;text-align: left;"><br/></p><ol id="l5"><li data-list-text="1)"><p style="padding-left: 91pt;text-indent: -18pt;text-align: justify;">Mengisikan bagian Pembukaan yang terdapat 7 langkah yang harus diisi (salam pembuka, pengondisian kelas, doa, presensi, apersepsi, motivasi, dan penyampaian tujuan pembelajaran).</p></li><li data-list-text="2)"><p style="padding-left: 91pt;text-indent: -18pt;text-align: left;">Mengisikan bagian Kegiatan Inti yang sesuai dengan model pembelajaaran yang diisi sebelumnya. Maka mengisikan Langkah-langkah pembelajaran tersebut.</p></li><li data-list-text="3)"><p style="padding-top: 3pt;padding-left: 91pt;text-indent: -18pt;text-align: left;">Mengisikan bagian Penutup 5 langkah pembelajaran (kesimpulan, evaluasi, refleksi, penyampaian tujuan pembelajaran pertemuan selanjutnya, dan salam penutup).</p><p style="text-indent: 0pt;text-align: left;"><br/></p></li></ol></li><li data-list-text="f."><p style="padding-top: 8pt;padding-left: 55pt;text-indent: -18pt;text-align: left;">Mengisikan Refleksi Peserta Didik dan Pendidik.</p><p style="text-indent: 0pt;text-align: left;"><br/></p></li></ol></li><li data-list-text="6."><p style="padding-left: 19pt;text-indent: -14pt;text-align: left;">Mengisikan Lampiran</p><ol id="l6"><li data-list-text="a."><p style="padding-left: 55pt;text-indent: -18pt;text-align: left;">Mengunggah LKPD (Lembar Kerja Peserta Didik) berbentuk PDF dengan maksimum ukuran file 5 mb. ini tidak wajib, Jika tidak ada maka bisa dikosongkan.</p></li><li data-list-text="b."><p style="padding-left: 55pt;text-indent: -18pt;text-align: left;">Mengunggah materi Pengayaan dan Remedial berbentuk PDF dengan maksimum ukuran file 5 mb. ini tidak wajib, Jika tidak ada maka bisa dikosongkan.</p></li><li data-list-text="c."><p style="padding-left: 55pt;text-indent: -18pt;text-align: left;">Mengunggah Bahan Bacaan peserta didik dan pendidik berbentuk PDF dengan maksimum ukuran file 5 mb. Ini tidak wajib, Jika tidak ada maka bisa dikosongkan.</p></li><li data-list-text="d."><p style="padding-left: 55pt;text-indent: -18pt;text-align: left;">Mengisikan Glossarium.</p></li><li data-list-text="e."><p style="padding-left: 55pt;text-indent: -18pt;text-align: left;">Mengisikan Daftar Pustaka.</p></li></ol></li></ol></body></html>

        </div>
    </div>

@endsection
