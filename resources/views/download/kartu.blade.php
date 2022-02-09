<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kartu Ujian</title>
</head>

<body>
<div style="border:1px dashed black;padding:10px;">
    <img src="{{$kop}}" alt="" width="100%">
    <br><br><br><br>
    <table width="100%">
        <tr>
            <td width="45%" style="vertical-align: top">
                <h3 style="margin:0;">Nama</h3>
                <hr>
                {{$formulir->diri->nama_lengkap}}
                <br>
                <br>
                <h3 style="margin:0;">No Reg</h3>
                <hr>
                {{$formulir->id}}
                <br>
                <br>
                <h3 style="margin:0;">No Tes</h3>
                <hr>
                {{$formulir->nomor}}
                <br>
                <br>
                <h3 style="margin:0;">Ruang Tes</h3>
                <hr>
                -
            </td>
            <td width="10%"></td>
            <td width="45%" style="vertical-align: top">
                <h3 style="margin:0;">Program Studi</h3>
                <hr>
                {{$formulir->rencana->program}}
                <br>
                {{$formulir->rencana->spesifikasi}}
                <br>
                <br>
                <h3 style="margin:0;">Rincian</h3>
                <hr>
                Tes seleksi Rp. 60.000<br>
                Mos Rp. 25.000<br>
                Buku panduan Rp. 35.000<br>
                Materai Rp. 10.000<br>
                Stopmap Rp. 5.000<br>
            </td>
        </tr>
    </table>
</div>
</body>

</html>