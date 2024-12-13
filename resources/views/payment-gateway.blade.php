<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Gateway</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<p>Pilihan Pembayaran</p>
<select name="payment_choice" id="">
    <option value="">Pilih</option>
    @foreach($channels['data'] as $channel)
    @if(!$channel['active'])
    @continue
    @endif
    <option value="{{$channel['code']}}">{{$channel['name']}}</option>
    @endforeach
</select>
</body>
</html>