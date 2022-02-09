<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PPDB</title>

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
        <div style="background-color: #FFF;padding:20px;margin:auto;max-width:550px;">
            <center>
                <img src="{{asset('images/ALUR-PPDB-1.jpg')}}" alt="" width="100%">
                <br>
                <br>
                <div class="alert alert-info">
                    BANTUAN PPDB HUB : 0819-0318-9474
                </div>
                <a href="https://wa.me/6285771838937?text=Assalamualaikum, saya mau daftar PPDB Malhikdua School." target="_blank" class="btn btn-success" style="margin-bottom: 10px;">Pendaftaran Peserta Didik Baru</a>
                <!-- <a href="/daftar" class="btn btn-success" style="margin-bottom: 10px;">Pendaftaran Peserta Didik Baru</a> -->
                <a href="/check" class="btn btn-success" style="margin-bottom: 10px;">Check Status Pendaftaran</a>
            </center>
        </div>
    </div>
</body>

</html>