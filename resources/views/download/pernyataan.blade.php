<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Surat Pernyataan</title>
</head>

<body>
<center>
    <h2>SURAT PERNYATAAN</h2>
    <h4>ORANG TUA/WALI SANTRI</h4>
</center>
<p>Yang bertanda tangan di bawah ini:</p>


<h3 style="margin:0">Nama Orang Tua/Wali</h3>
<hr>
{{$formulir->wali->nama}}
<br><br>

<h3 style="margin:0">Alamat Rumah</h3>
<hr>
{{$formulir->diri->alamat}}
<br><br>
        
<h3 style="margin:0">Nomor HP</h3>
<hr>
{{$formulir->contact->no_wa}}
<br><br>
        
<h3 style="margin:0">Orang Tua/Wali Dari</h3>
<hr>
{{$formulir->diri->nama_lengkap}}
<br>

<p>Menyatakan kesanggupan dengan sebenar-benarnya untuk anak saya yang
    bersekolah di <b>MA Al Hikmah 2 Benda</b> sebagai berikut : </p>

<ol>
    <li>Bersedia bertempat tinggal di Pondok Pesantren Al Hikmah 2 Benda</li>
    <li>Menaati segala peraturan dan ketentuan yang berlaku di Pondok Pesantren Al
        Hikmah 2 Benda Sirampog Brebes dan menerima dengan ikhlas segala kebijakan
        pengasuh pondok maupun sekolah</li>
    <li>Menerima sepenuhnya bahwa segala keputusan yang terkait dengan pondok
        berlaku sama dengan keputusan sekolah, demikian juga sebaliknya keputusan
        sekolah berlaku sama dengan keputusan pondok</li>
    <li>Melaksanakan kewajiban yang ditentukan oleh pondok maupun sekolah.</li>
    <li>Apabila di kemudian hari anak saya melakukan pelanggaran terhadap peraturan
        pondok atau sekolah dan mengakibatkan anak saya harus "dikeluarkan" dari
        pondok/sekolah, maka saya siap menerima segala keputusan tersebut dan tidak
        akan menuntut secara hukum</li>
</ol>
<p>Demikian surat pernyataan ini dibuat dengan sebenarnya, untuk digunakan
    sebagaimana mestinya.</p>

<hr>

<table align="right" width="300px">
    <tr>
        <td>
            <center>
                <p>Benda, {{date('d F Y',strtotime($formulir->created_at))}}</p>
                Yang Menyatakan
                <br><br><br>
                (materai)
                <br><br><br>
                <b>{{$formulir->wali->nama}}</b>
            </center>
        </td>
    </tr>
</table>

</body>

</html>