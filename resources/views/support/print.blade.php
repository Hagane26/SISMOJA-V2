<!DOCTYPE html>
<html>
    <head>
        <style>
            #tbi, #tdi {
                border: 1px solid black;
                border-collapse: collapse;
            }
            table, tr, td{
                border: 2px solid black;
                width: 90%;
                border-collapse: collapse;
            }

        </style>
    </head>
    <body>

        <p style="text-align: center;"><span style="font-size: 22pt;"><strong>MODUL AJAR</strong></span></p>
        <p style="text-align: center;margin-top:15%;margin-bottom:15%"><img src="https://myfiles.space/user_files/196320_5f9b8dd96cdd3e75/196320_custom_files/img1707682668.png" style="width: 338px; height: 338px;" width="338" height="338"><br></p>

        <center>
            <table style="width: 54%; text-align: center;font-size:18pt; margin-left:33%;margin-right:30%" >
                <tbody>
                    <tr>
                        <td style="width: 15%;">
                            <div style="text-align: left;">MATERI</div>
                        </td>
                        <td style="width: 9.7669%;">:</td>
                        <td style="width: 58.4871%;">
                            <div style="text-align: left;">{{ $res->judul }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%;">
                            <div style="text-align: left;">Nama</div>
                        </td>
                        <td style="width: 9.7669%;">:</td>
                        <td style="width: 58.4871%;">
                            <div style="text-align: left;">{{ $res->data_informasi->identitas->nama }}</div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </center>

        <div style="margin-bottom: 50%">


        </div>

        <p><br></p>

        <div id="gtx-trans" style="position: absolute; left: 361px; top: 394px;">

            <div class="gtx-trans-icon"></div>

        </div>

        <p style="text-align: center;"><span style="font-size: 20px;"><strong>MODUL AJAR {{ $res->data_informasi->identitas->mapel }}</strong></span></p>

        <ol>
        <li style="font-weight: bold; font-size: 14px;"><strong>INFORMASI UMUM</strong>
            <ol style="list-style-type: upper-alpha; font-weight: initial; font-size: initial;">
                <li style="font-size: 16px;"><strong>IDENTITAS MODUL</strong><br>
                    <table style="width: 100%;margin-bottom: 1%;">
                        <tbody>
                            <tr>
                                <td style="width: 33.7329%;"><span style="font-size: 14px;">Nama Penyusun</span></td>
                                <td style="width: 5.137%;"><span style="font-size: 14px;">:</span></td>
                                <td style="width: 61.0044%;"><span style="font-size: 14px;">{{ $res->data_informasi->identitas->nama }}</span></td>
                            </tr>
                            <tr>
                                <td style="width: 33.7329%;"><span style="font-size: 14px;">Institusi</span></td>
                                <td style="width: 5.137%;"><span style="font-size: 14px;">:</span></td>
                                <td style="width: 61.0044%;"><span style="font-size: 14px;">{{ $res->data_informasi->identitas->institusi }}</span></td>
                            </tr>
                            <tr>
                                <td style="width: 33.7329%;"><span style="font-size: 14px;">Tahun Ajaran</span></td>
                                <td style="width: 5.137%;"><span style="font-size: 14px;">:</span></td>
                                <td style="width: 61.0044%;"><span style="font-size: 14px;">{{ $res->data_informasi->identitas->TAwal ." / ". $res->data_informasi->identitas->TAkhir }}</span></td>
                            </tr>
                            <tr>
                                <td style="width: 33.7329%;"><span style="font-size: 14px;">Mata Pelajaran</span></td>
                                <td style="width: 5.137%;"><span style="font-size: 14px;">:</span></td>
                                <td style="width: 61.0044%;"><span style="font-size: 14px;">{{ $res->data_informasi->identitas->mapel }}</span></td>
                            </tr>
                            <tr>
                                <td style="width: 33.7329%;"><span style="font-size: 14px;">Kelas / Fase</span></td>
                                <td style="width: 5.137%;"><span style="font-size: 14px;">:</span></td>
                                <td style="width: 61.0044%;"><span style="font-size: 14px;">{{ $res->data_informasi->identitas->kelas }} / Fase {{ $res->data_informasi->identitas->fase }}</span></td>
                            </tr>
                            <tr>
                                <td style="width: 33.7329%;"><span style="font-size: 14px;">Alokasi Waktu</span></td>
                                <td style="width: 5.137%;"><span style="font-size: 14px;">:</span></td>
                                <td style="width: 61.0044%;">{{ $res->data_informasi->identitas->waktu *  $res->data_informasi->identitas->kali . " Menit ( " . $res->data_informasi->identitas->kali . " x " . $res->data_informasi->identitas->waktu . " Menit )"}}</td>
                            </tr>
                        </tbody>
                    </table>
                </li>
                <li style="font-size: 16px;"><strong>KOMPONEN AWAL</strong>

                        @php
                            echo $res->data_informasi->komponenAwal;
                        @endphp

                </li>
                <li style="font-size: 16px;"><strong>PROFIL PELAJAR PANCASILA</strong>
                    <ol>
                    @php
                        foreach ($res->data_ppp as $dp) {
                            if($dp->isi != ""){
                                echo  "<li>" . $dp->subjudul . $dp->isi . "</li>";
                            }
                        }
                    @endphp
                    </ol>
                </li>
                <li style="font-size: 16px;"><strong>SARANA DAN PRASARANA</strong>
                    <ol>
                        <li style="font-size: 16px;"><strong>SARANA</strong><br>

                            @php
                                echo $res->data_informasi->sarana;
                            @endphp

                        </li>
                        <li style="font-size: 16px;"><strong>PRASARANA</strong><br>

                            @php
                                echo $res->data_informasi->prasarana;
                            @endphp

                        </li>
                    </ol>
                </li>
                <li style="font-size: 16px;"><strong>TARGET PESERTA DIDIK</strong><br>
                    @php
                        echo $res->data_informasi->target;
                    @endphp
                </li>
                <li style="font-size: 16px;"><strong>PENDEKATAN, MODEL, METODE, DAN TEKNIK PEMBELAJARAN</strong>
                    <ol>
                        <li>Pendekatan
                            <ul>
                                @php
                                foreach ($res->data_informasi->model as $m) {
                                    if ($m->kategori == "Pendekatan" && $m->metode != ""){
                                        echo "<li>".$m->metode."</li>";
                                    }
                                }
                                @endphp
                            </ul>
                        </li>

                        <li>Model
                            <ul>
                                @php
                                foreach ($res->data_informasi->model as $m) {
                                    if ($m->kategori == "Model" && $m->metode != ""){
                                        echo "<li>".$m->metode."</li>";
                                    }
                                }
                                @endphp
                            </ul>
                        </li>

                        <li>Metode
                            <ul>
                                @php
                                foreach ($res->data_informasi->model as $m) {
                                    if ($m->kategori == "Metode" && $m->metode != ""){
                                        echo "<li>".$m->metode."</li>";
                                    }
                                }
                                @endphp
                            </ul>
                        </li>

                        <li>Teknik Pembelajaran
                            <ul>
                                @php
                                foreach ($res->data_informasi->model as $m) {
                                    if ($m->kategori == "Teknik" && $m->metode != ""){
                                        echo "<li>".$m->metode."</li>";
                                    }
                                }
                                @endphp
                            </ul>
                        </li>

                    </ol>
                </li>
            </ol>
        </li>

            <li style="font-size: 16px; margin-top:2%"><strong>KOMPONEN INTI</strong>
                <ol style="list-style-type: upper-alpha; font-weight: initial; font-size: initial;">
                    <li style="font-size: 16px;"><strong>TUJUAN PEMBELAJARAN</strong><br>

                        @php
                            echo $res->data_komponen_inti->Tujuan;
                        @endphp

                    </li>
                    <li style="font-size: 16px;"><strong>ASESMEN</strong>
                        <ol>
                            @php
                                if($res->data_komponen_inti->asasmen_diagnostik != ""){
                                    echo "<li> Asesmen Diagnostik".$res->data_komponen_inti->asasmen_diagnostik."</li>";
                                }
                                if($res->data_komponen_inti->asasmen_formatif != ""){
                                    echo "<li> Asesmen Formatif".$res->data_komponen_inti->asasmen_formatif."</li>";
                                }
                                if($res->data_komponen_inti->asasmen_sumatif != ""){
                                    echo "<li> Asesmen Sumatif".$res->data_komponen_inti->asasmen_sumatif."</li>";
                                }
                            @endphp
                        </ol>
                    </li>
                    <li style="font-size: 16px;"><strong>PEMAHAMAN BERMAKNA</strong><br>
                        @php
                            echo $res->data_komponen_inti->pemahaman_bermakna;
                        @endphp
                    </li>
                    <li style="font-size: 16px;"><strong>PERTANYAAN PEMANTIK</strong><br>
                        @php
                            echo $res->data_komponen_inti->pemantik;
                        @endphp
                    </li>
                    <li style="font-size: 16px;"><strong>KEGIATAN PEMBELAJARAN</strong>
                        <table style="width: 100%;margin-bottom:2%" id="tbi">
                            <tbody>
                                <tr>
                                    <td style="width: 20%;" id="tdi">Sintaks</td>
                                    <td style="width: 60%;" id="tdi">Deskripsi</td>
                                    <td style="width: 20%;" id="tdi">Alokasi Waktu</td>
                                </tr>
                                <tr>
                                    <td id="tdi"></td>
                                    <td style="font-size: 16px;"><b>Pembukaan</b></td>
                                    <td id="tdi"></td>
                                </tr>
                                <tr>
                                    <td id="tdi"></td>
                                    <td id="tdi">@php
                                        foreach ($res->ki_pembukaan as $m) {
                                            echo "<P><b>".$m->langkah."</b><br>".$m->isi."</p>";
                                        }
                                        @endphp</td>
                                    <td id="tdi">{{ $res->ki_pembukaan[0]->waktu }} Menit</td>
                                </tr>

                                <tr>
                                    <td id="tdi"></td>
                                    <td id="tdi" style="font-size: 16px;"><b>Kegiatan Inti</b></td>
                                    <td id="tdi"></td>
                                </tr>
                                @php
                                    foreach ($res->ki_kegiatan as $m) {
                                        echo "<tr>";
                                        echo "<td id='tdi'>".$m->metode."</td>";
                                        echo "<td id='tdi'>".$m->isi."</td>";
                                        echo "<td id='tdi'>".$m->waktu." Menit</td>";
                                        echo "</tr>";
                                    }
                                @endphp

                                <tr>
                                    <td id='tdi'></td>
                                    <td id='tdi' style="font-size: 16px;"><b>Penutup</b></td>
                                    <td id='tdi'></td>
                                </tr>
                                @php
                                    foreach ($res->ki_penutup as $m) {
                                        echo "<tr>";
                                        echo "<td></td>";
                                        echo "<td id='tdi'>".$m->langkah." : ".$m->isi."</td>";
                                        echo "<td id='tdi'>".$m->waktu." Menit</td>";
                                        echo "</tr>";
                                    }
                                @endphp
                                <tr>
                                    <td id='tdi'></td>
                                    <td id='tdi' style="font-size: 16px;"><b>Total Waktu</b></td>
                                    <td id='tdi'>{{ $res->data_informasi->identitas->waktu *  $res->data_informasi->identitas->kali . " Menit"}}</td>
                                </tr>
                            </tbody>
                        </table>

                    </li>
                    <li style="font-size: 16px;"><strong>REFLEKSI PESERTA DIDIK DAN PENDIDIK</strong><br>
                        @php
                            echo $res->data_komponen_inti->refleksi;
                        @endphp
                    </li>
                </ol>
            </li>
            <li style="font-weight: bold; font-size: 14px;"><strong>LAMPIRAN</strong>
                <ol style="list-style-type: upper-alpha; font-weight: initial; font-size: initial;">
                    <li style="font-size: 16px;"><strong>GLOSSARIUM</strong>
                        @php
                            echo $res->lampiran->glossarium;
                        @endphp
                    </li>
                    <li style="font-size: 16px;"><strong>DAFTAR PUSTAKA</strong>
                        @php
                            echo $res->lampiran->dapus;
                        @endphp
                    </li>
                </ol>
            </li>
        </ol>
    </body>
</html>
