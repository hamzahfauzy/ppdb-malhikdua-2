@extends('layouts.app')
@section('title','Download Berkas')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Download Berkas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Download Berkas</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content profile">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body login-card-body">
                        @if(auth()->user()->contact->formulir && auth()->user()->contact->formulir->status == 'Diterima')
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Download</th>
                            </tr>
                            {{'',$no=1}}
                            @foreach(['Surat Pernyataan','Kartu Ujian Masuk','Biodata','Faktur Pembayaran'] as $key => $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row}}</td>
                                <td>
                                    <a href="{{route('download',$row)}}" target="_blank" class="btn btn-primary"><i class="fas fa-download"></i> Download</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        @else
                            @if(auth()->user()->contact->formulir)
                                @if(auth()->user()->contact->formulir->status == '')
                                    <i>Kirim formulir terlebih dahulu dengan mengklik tombol VERIFIKASI BERKAS / PENDAFTARAN</i>
                                @else
                                    <i>Formulir sedang diproses</i>
                                @endif
                            @else
                                <i>Isi Formulir Terlebih dahulu</i>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection