@extends('layouts.staff')
@section('title','Pendaftaran')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pendaftaran Ulang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pendaftaran Ulang</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body login-card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Pembayaran</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                @forelse($daftarUlangs as $daftarUlang)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$daftarUlang->formulir->diri->NIK}}</td>
                                    <td>{{$daftarUlang->formulir->diri->nama_lengkap}}</td>
                                    <td>{{$daftarUlang->jenis_pembayaran}}</td>
                                    <td>{{$daftarUlang->metode_pembayaran}}</td>
                                    <td><span class="badge badge-{{$labels[$daftarUlang->status]}}">{{$daftarUlang->status}}</span></td>
                                    <td>{{$daftarUlang->created_at}}</td>
                                    <td>
                                        <a href="{{route('staff.siswa.show',$daftarUlang->formulir->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                        <a href="{{route('staff.siswa.edit',$daftarUlang->formulir->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{route('staff.siswa.delete',$daftarUlang->formulir->id)}}" class="btn btn-sm btn-danger" onclick="if(confirm('Apakah anda yakin menghapus data pendaftaran ?')){return true}else{return false}"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('script')

<script>
    $("table").DataTable({
        "responsive": true,
    })
</script>

@endsection