<!DOCTYPE html>
<html>
    <body>
        <p style="text-align: center;"><span style="font-size: 18px;"><strong>MODUL AJAR {{ $res->data_informasi->identitas->mapel }}</strong></span></p>
<ol>
    <li style="font-weight: bold; font-size: 14px;"><strong>INFORMASI UMUM</strong>
        <ol style="list-style-type: upper-alpha; font-weight: initial; font-size: initial;">
            <li style="font-size: 14px;"><strong>IDENTITAS MODUL</strong><br>
                <table style="width: 100%;margin-bottom: 3%; margin-top:3%;">
                    <tbody>
                        <tr>
                            <td style="width: 33.7329%;"><span style="font-size: 12px;">Nama Penyusun</span></td>
                            <td style="width: 5.137%;"><span style="font-size: 12px;">:</span></td>
                            <td style="width: 61.0044%;"><span style="font-size: 12px;">{{ $res->data_informasi->identitas->nama }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 33.7329%;"><span style="font-size: 12px;">Institusi</span></td>
                            <td style="width: 5.137%;"><span style="font-size: 12px;">:</span></td>
                            <td style="width: 61.0044%;"><span style="font-size: 12px;">{{ $res->data_informasi->identitas->institusi }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 33.7329%;"><span style="font-size: 12px;">Tahun Ajaran</span></td>
                            <td style="width: 5.137%;"><span style="font-size: 12px;">:</span></td>
                            <td style="width: 61.0044%;"><span style="font-size: 12px;">{{ $res->data_informasi->identitas->TAwal ." / ". $res->data_informasi->identitas->TAkhir }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 33.7329%;"><span style="font-size: 12px;">Mata Pelajaran</span></td>
                            <td style="width: 5.137%;"><span style="font-size: 12px;">:</span></td>
                            <td style="width: 61.0044%;"><span style="font-size: 12px;">{{ $res->data_informasi->identitas->mapel }}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 33.7329%;"><span style="font-size: 12px;">Kelas / Fase</span></td>
                            <td style="width: 5.137%;"><span style="font-size: 12px;">:</span></td>
                            <td style="width: 61.0044%;"><span style="font-size: 12px;">{{ $res->data_informasi->identitas->kelas }}}</span></td>
                        </tr>
                        <tr>
                            <td style="width: 33.7329%;"><span style="font-size: 12px;">Alokasi Waktu</span></td>
                            <td style="width: 5.137%;"><span style="font-size: 12px;">:</span></td>
                            <td style="width: 61.0044%;">{{ $res->data_informasi->identitas->waktu * $res->data_informasi->identitas->kali }}</td>
                        </tr>
                    </tbody>
                </table>
            </li>
            <li style="font-size: 14px;"><strong>KOMPONEN AWAL</strong>
                <ul style="font-size: initial;">

                </ul>
            </li>
            <li style=" font-size: 14px;"><strong>PROFIL PELAJAR PANCASILA</strong><br>

            </li>
            <li style="font-size: 14px;"><strong>SARANA DAN PRASARANA</strong>
                <ol>
                    <li style="font-size: 14px;"><strong>SARANA</strong><br>
                        <p><span style="font-size: 12px;">{{ $res->data_informasi->sarana }}</span></p>
                    </li>
                    <li style="font-size: 14px;"><strong>PRASARANA</strong><br>
                        <p><span style="font-size: 12px;">{{ $res->data_informasi->prasarana }}</span></p>
                    </li>
                </ol>
            </li>
            <li style="font-size: 14px;"><strong>TARGET PESERTA DIDIK</strong><br>
                <p><span style="font-size: 12px;">{{ $res->data_informasi->target }}</span></p>
            </li>
            <li style="font-size: 14px;"><strong>PENDEKATAN, MODEL, METODE, DAN TEKNIK PEMBELAJARAN</strong>

            </li>
        </ol>
    </li>
    <li style="font-size: 14px;"><strong>KOMPONEN INTI</strong>
        <ol style="list-style-type: upper-alpha; font-weight: initial; font-size: initial;">
            <li style="font-size: 14px;"><strong>TUJUAN PEMBELAJARAN</strong><br>
                <p><span style="font-size: 12px;">{{ $res->data_komponen_inti->Tujuan }}</span></p>
            </li>
            <li style="font-size: 14px;"><strong>ASESMEN</strong>

            </li>
            <li style="font-size: 14px;"><strong>PEMAHAMAN BERMAKNA</strong><br>
                <p><span style="font-size: 12px;">
                    {{ $res->data_komponen_inti->pemahaman_bermakna }}
                </span></p>
            </li>
            <li style="font-size: 14px;"><strong>PERTANYAAN PEMANTIK</strong><br>
                <p><span style="font-size: 12px;">
                    {{ $res->data_komponen_inti->pemantik }}
                </span></p>
            </li>
            <li style="font-weight: bold; font-size: 14px;"><strong>KEGIATAN PEMBELAJARAN</strong>
                <ul style="font-weight: initial; font-size: initial;">

                </ul>
            </li>
            <li style="font-size: 14px;"><strong>REFLEKSI PESERTA DIDIK DAN PENDIDIK</strong><br>
                <p><span style="font-size: 12px;">{{ $res->data_komponen_inti->refleksi }}</span></p>
            </li>
        </ol>
    </li>
    <li style="font-weight: bold; font-size: 14px;"><strong>LAMPIRAN</strong>
        <ol style="list-style-type: upper-alpha; font-weight: initial; font-size: initial;">
            <li style="font-size: 14px;"><strong>GLOSSARIUM</strong>
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                            <td style="width: 31.3182%;"><span style="font-size: 12px;">test</span></td>
                            <td style="width: 6.3337%;"><span style="font-size: 12px;">:</span><br></td>
                            <td style="width: 62.1187%;"><span style="font-size: 12px;">isi</span><br></td>
                        </tr>
                        <tr>
                            <td style="width: 31.3182%;"><span style="font-size: 12px;">test</span><br></td>
                            <td style="width: 6.3337%;"><span style="font-size: 12px;">:</span><br></td>
                            <td style="width: 62.1187%;"><span style="font-size: 12px;">isi</span><br></td>
                        </tr>
                        <tr>
                            <td style="width: 31.3182%;"><span style="font-size: 12px;">test</span><br></td>
                            <td style="width: 6.3337%;"><span style="font-size: 12px;">:</span><br></td>
                            <td style="width: 62.1187%;"><span style="font-size: 12px;">isi</span><br></td>
                        </tr>
                    </tbody>
                </table>
            </li>
            <li style="font-size: 14px;"><strong>DAFTAR PUSTAKA</strong>
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                            <td style="width: 31.3182%;"><span style="font-size: 12px;">test</span></td>
                            <td style="width: 6.3337%;"><span style="font-size: 12px;">:</span><br></td>
                            <td style="width: 62.1187%;"><span style="font-size: 12px;">isi</span><br></td>
                        </tr>
                        <tr>
                            <td style="width: 31.3182%;"><span style="font-size: 12px;">test</span><br></td>
                            <td style="width: 6.3337%;"><span style="font-size: 12px;">:</span><br></td>
                            <td style="width: 62.1187%;"><span style="font-size: 12px;">isi</span><br></td>
                        </tr>
                        <tr>
                            <td style="width: 31.3182%;"><span style="font-size: 12px;">test</span><br></td>
                            <td style="width: 6.3337%;"><span style="font-size: 12px;">:</span><br></td>
                            <td style="width: 62.1187%;"><span style="font-size: 12px;">isi</span><br></td>
                        </tr>
                    </tbody>
                </table>
            </li>
        </ol>
    </li>
</ol>
    </body>
</html>
