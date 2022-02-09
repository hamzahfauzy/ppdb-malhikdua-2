<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Formulir</title>
</head>

<body>
    <center>
        <h2>{{$formulir->diri->nama_lengkap}}</h2>
        <p>
            KAB. {{$formulir->asal->kabupaten}}
            -
            62{{$formulir->contact->no_wa}}
            -
            {{$age}} Tahun
            -
            Joined {{date('d F Y',strtotime($formulir->created_at))}}
            -
            {{$formulir->id}}
        </p>
    </center>
    <br><br>
    <hr>
    <br><br>
    <table width="100%">
        <tr>
            <td width="30%" style="vertical-align: top">
                <h3 style="margin:0;">Kamar</h3>
                <hr>
                04
                <br>
                <br>

                <h3 style="margin:0;">Sekolah Asal</h3>
                <hr>
                {{$formulir->pendidikan->sekolah_asal}}
                <br>
                <br>
                
                <h3 style="margin:0;">Nomor Peserta UN</h3>
                <hr>
                {{$formulir->berkas->no_peserta_un}}
                <br>
                <br>

                <h3 style="margin:0;">Nomor SKHUN</h3>
                <hr>
                {{$formulir->berkas->no_seri_shun}}
                <br>
                <br>

                <h3 style="margin:0;">NISN</h3>
                <hr>
                {{$formulir->pendidikan->NISN}}
                <br>
                <br>

                <h3 style="margin:0;">NPSN</h3>
                <hr>
                {{$formulir->pendidikan->NPSN}}
                <br>
                <br>

                <h3 style="margin:0;">Alamat Rumah</h3>
                <hr>
                {{$formulir->asal->alamat.', '.$formulir->asal->rt.', '.$formulir->asal->rw.', '.$formulir->asal->desa_kelurahan.', Kec. '.$formulir->asal->kecamatan.', Kab. '.$formulir->asal->kabupaten.', '.$formulir->asal->provinsi}}
                <br>
                <br>

                <h3 style="margin:0;">Kode Pos</h3>
                <hr>
                {{$formulir->asal->kode_pos}}
                <br>
                <br>
            </td>
            <td width="5%"></td>
            <td width="30%" style="vertical-align: top">
                <h3 style="margin:0;">Tempat & Tanggal Lahir</h3>
                <hr>
                {{$formulir->diri->tempat_tinggal.' '.$formulir->diri->tanggal_lahir}}
                <br>
                <br>

                <h3 style="margin:0;">Anak Ke</h3>
                <hr>
                {{$formulir->diri->anak_ke}}
                <br>
                <br>

                <h3 style="margin:0;">dari X bersaudara</h3>
                <hr>
                {{$formulir->diri->jumlah_saudara}}
                <br>
                <br>

                <h3 style="margin:0;">NIK Pendaftar</h3>
                <hr>
                {{$formulir->diri->NIK}}
                <br>
                <br>

                <h3 style="margin:0;">Nomor KK</h3>
                <hr>
                {{$formulir->ayah->no_kk}}
                <br>
                <br>

                <h3 style="margin:0;">Ayah</h3>
                <hr>
                {{$formulir->ayah->nama}}
                <br>
                <br>

                <h3 style="margin:0;">Ibu</h3>
                <hr>
                {{$formulir->ibu->nama}}
                <br>
                <br>

                <h3 style="margin:0;">Pedapatan rata-rata perbulan</h3>
                <hr>
                {{$formulir->ayah->penghasilan}}
                <br>
                <br>
            </td>
            <td width="5%"></td>
            <td width="30%" style="vertical-align: top">
                <h3 style="margin:0;">Kartu program pemerintah</h3>
                <hr>
                {{$formulir->diri->nama_lengkap}}
                <br>
                <br>

                <h3 style="margin:0;">No KIP</h3>
                <hr>
                {{$formulir->diri->nama_lengkap}}
                <br>
                <br>

                <h3 style="margin:0;">Program Studi</h3>
                <hr>
                {{$formulir->diri->nama_lengkap}}
                <br>
                <br>

                <h3 style="margin:0;">Spesifikasi</h3>
                <hr>
                {{$formulir->diri->nama_lengkap}}
                <br>
                <br>
            </td>
        </tr>
    </table>
    <hr>
</body>

</html>