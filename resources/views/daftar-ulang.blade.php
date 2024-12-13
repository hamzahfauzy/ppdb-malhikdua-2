@extends('layouts.app')
@section('title','Daftar Ulang')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar Ulang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Daftar Ulang</li>
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

                <div class="card card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Jenis Pembayaran</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            @forelse($formulir->daftarUlang as $daftarUlang)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$daftarUlang->jenis_pembayaran}}</td>
                                <td>{{$daftarUlang->metode_pembayaran}}</td>
                                <td><span class="badge badge-{{$labels[$daftarUlang->status]}}">{{$daftarUlang->status}}</span></td>
                                <td>{{$daftarUlang->created_at}}</td>
                            </tr>
                            <?php $i++ ?>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card">
                    <div class="card-body login-card-body">
                        <form method="post">
                            @csrf

                            <div class="form-group">
                                <label for="">Jenis Pembayaran</label>
                                <select name="jenis_pembayaran" class="form-control">
                                    <option value="-" selected disabled>- Pilih Jenis Pembayaran -</option>
                                    <option value="Lunas">Lunas</option>
                                    <option value="25%">25%</option>
                                    <option value="50%">50%</option>
                                    <option value="75%">75%</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Metode Pembayaran</label>
                                <select name="metode_pembayaran" class="form-control">
                                    <option value="-" selected disabled>- Pilih Metode Pembayaran -</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                            </div>

                            <hr>

                            <button class="btn btn-success">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection