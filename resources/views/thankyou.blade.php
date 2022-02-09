<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PPDB - Check Pendaftaran</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <style>
    html, body {
        height: 100%;
    }
    .payment {
        display: none;
    }
    body {
        background-color: green;
    }
    </style>
</head>

<body>
    <div class="d-flex h-100 justify-content-center align-items-center" style="margin:15px;">
        <div style="background-color: #FFF;padding:20px;max-width:500px;margin:auto;">
            <center>
                <img src="{{asset('images/faktur.png')}}" alt="" width="100%" style="max-width: 400px">
                <h2>Pendaftaran Selesai</h2>
                <br>
                <p>Terima kasih telah melakukan pendaftaran. Data pendaftaran sudah kami terima dan silahkan menunggu informasi selanjutnya.</p>
                <br>
                Klik <a href="{{route('welcome')}}">Disini</a> jika ingin mendaftarkan calon peserta didik baru yang lain.
            </center>
        </div>
    </div>
</body>

</html>