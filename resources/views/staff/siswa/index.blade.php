@extends('layouts.staff')
@section('title','Pendaftaran')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Siswa</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pendaftaran</li>
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
                    <div class="card-header">
                        <a href="{{route('staff.siswa.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Buat Pendaftaran</a>
                        <a href="{{route('staff.siswa.report')}}" class="btn btn-success"><i class="fas fa-download"></i> Laporan</a>
                    </div>
                    <div class="card-body login-card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Tinggal</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                @foreach($siswa as $s)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$s->diri->NIK}}</td>
                                    <td>{{$s->diri->nama_lengkap}}</td>
                                    <td>{{$s->diri->jenis_kelamin}}</td>
                                    <td>{{$s->diri->tempat_tinggal}}</td>
                                    <td>{{date('d-m-Y',strtotime($s->diri->tanggal_lahir))}}</td>
                                    <td><span class="badge badge-{{$labels[$s->status]}}">{{$s->status}}</span></td>
                                    <td>
                                        <a href="{{route('staff.siswa.show',$s->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                        <a href="{{route('staff.siswa.edit',$s->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{route('staff.siswa.delete',$s->id)}}" class="btn btn-sm btn-danger" onclick="if(confirm('Apakah anda yakin menghapus data pendaftaran ?')){return true}else{return false}"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                                @endforeach
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