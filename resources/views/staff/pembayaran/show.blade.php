@extends('layouts.staff')
@section('title','Data Pembayaran')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Detail Pembayaran</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/staff">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('staff.pembayaran.index')}}">Pembayaran</a></li>
                    <li class="breadcrumb-item active">Detail Pembayaran</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content profile">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body login-card-body">
                @if ($msg = session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ $msg }}
                    </div>
                @endif
                @if(in_array($contact->status,['UNPAID']) || $contact->tiket=="")
                <a href="{{route('staff.pembayaran.check',$contact->id)}}" class="btn btn-success">Cek Pembayaran</a>
                @endif
                @if($contact->tiket=="")
                    <a href="{{route('staff.pembayaran.approve',$contact->id)}}" class="btn btn-primary" onclick="if(confirm('Apakah anda yakin akan approve pembayaran ini?')){return true}else{return false}">Approve Pendaftaran</a>
                @endif
                <center>
                    <h2>{{$contact->nama_pendaftar}}</h2>
                    <p>
                        <i>{{$contact->email}}</i><br>
                        <b>{{$contact->no_wa}} - {{$contact->tiket?$contact->tiket:'(Belum ada nomor tiket)'}}</b><br>
                        <b>{{$contact->status}}</b><br>
                    </p>
                </center>
                <hr>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">Nama Calon Siswa</label>
                            <p>{{$contact->nama_calon_siswa}}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Alumni PP Al Hikmah 2</label>
                            <p>{{$contact->alumni}} {{$contact->alumni=='Tidak'?$contact->sebutkan_nama_sekolah:''}}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Domisili</label>
                            <p>{{$contact->domisili}}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <p>{{$contact->alamat}}</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">Tipe Pembayaran</label>
                            <p>{{$contact->tipe_pembayaran}} - {{$contact->payment_gateway}}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Biaya Pembayaran</label>
                            <p>Rp. {{number_format($contact->biaya_pembayaran)}}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Kode Pembayaran</label>
                            <p>{{$contact->payment_code}}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Referensi Pembayaran</label>
                            <p>{{$contact->payment_reference}}</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('script')

<script>
    $("table").DataTable({
        "responsive": true,
    })
</script>

@endsection