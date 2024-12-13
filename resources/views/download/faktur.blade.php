<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faktur Pembayaran</title>
</head>

<body>
<div style="border:1px dashed black;padding:10px;">
    <table width="100%">
        <tr>
            <td width="50%" style="vertical-align: top">
                <img src="{{$faktur}}" alt="" width="100%">
            </td>
            <td width="50%" style="vertical-align: middle" colspan="2">
                <b>PPDB Malhikdua</b><br>
                Raya Benda Sirampog Brebes<br>
                Komplek PP Al Hikmah 2 Benda Sirampog
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <h3>Faktur</h3>
            </td>
        </tr>
        <tr>
            <td width="50%" style="vertical-align: top" rowspan="4">
                {{$formulir->contact->nama_pendaftar}}<br>
                {{$formulir->contact->email}}<br>
                {{$formulir->contact->no_wa}}
            </td>
            <td>Nomor Faktur :</td>
            <td>{{$formulir->contact->id}}</td>
        </tr>
        <tr>
            <td>Tanggal Faktur:</td>
            <td>{{date('d/m/Y',strtotime($formulir->created_at))}}</td>
        </tr>
        <tr>
            <td>Tanggal Pemesanan :</td>
            <td>{{date('d/m/Y',strtotime($formulir->contact->created_at))}}<br></td>
        </tr>
            <td>Metode Pembayaran :</td>
            <td>{{ucwords($formulir->contact->payment_gateway).' - '.$formulir->contact->tipe_pembayaran}}<br></td>
        </tr>
    </table>
    <br><br>
    <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <tr>
            <td style="background:#000;color:#FFF;">Produk</td>
            <td style="background:#000;color:#FFF;">Kuantitas</td>
            <td style="background:#000;color:#FFF;">Harga</td>
        </tr>
        <tr>
            <td>{{$formulir->rencana->program.' - '.$formulir->rencana->spesifikasi}}</td>
            <td>1</td>
            <td>Rp. {{number_format($formulir->contact->biaya_pembayaran)}}</td>
        </tr>
    </table>
    <br><br>
    <table width="100%">
        <tr>
            <td width="50%" style="vertical-align: top">
                
            </td>
            <td width="50%" style="vertical-align: middle" colspan="2">
                <table width="100%" cellpadding="5" cellspacing="0">
                    <tr>
                        <td width="50%" style="border-bottom:1px solid #000">
                            Subtotal :
                        </td>
                        <td style="border-bottom:1px solid #000">
                            Rp. {{number_format($formulir->contact->biaya_pembayaran)}}
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom:1px solid #000">Subcharge</td>
                        <td style="border-bottom:1px solid #000">Rp. 0</td>
                    </tr>
                    <tr>
                        <td style="border-bottom:1px solid #000">Total</td>
                        <td style="border-bottom:1px solid #000">Rp. {{number_format($formulir->contact->biaya_pembayaran)}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>

</html>