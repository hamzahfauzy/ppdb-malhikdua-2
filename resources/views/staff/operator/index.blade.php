@extends('layouts.staff')
@section('title','Pendaftaran')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Operator</h1>
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
                        <a href="{{route('staff.operator.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Buat Operator</a>
                    </div>
                    <div class="card-body login-card-body">
                        @if ($msg = session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ $msg }}
                            </div>
                        @endif
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                @foreach($data as $operator)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$operator->name}}</td>
                                    <td>{{$operator->email}}</td>
                                    <td>62{{$operator->phone_number}}</td>
                                    <td>
                                        <a href="{{route('staff.operator.edit',$operator->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{route('staff.operator.destroy',$operator->id)}}" class="btn btn-sm btn-danger" onclick="if(confirm('Apakah anda yakin menghapus data pendaftaran ?')){return true}else{return false}"><i class="fas fa-trash"></i></a>
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