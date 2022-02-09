@extends('layouts.staff')
@section('title','Data Pembayaran')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Pembayaran</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/staff">Home</a></li>
                    <li class="breadcrumb-item active">Pembayaran</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content profile">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <a href="{{route('staff.pembayaran.create')}}" class="btn btn-success"><i class="fas fa-plus"></i> Kirim Tiket</a>
                <a href="{{route('staff.pembayaran.report')}}" class="btn btn-primary"><i class="fas fa-download"></i> Download Laporan</a>
            </div>
            <div class="card-body login-card-body">
              @if ($msg = session('success'))
                  <div class="alert alert-success" role="alert">
                      {{ $msg }}
                  </div>
              @endif
              <div class="table-responsive">
              <table class="table table-striped datatable display responsive">
                  <thead>
                  <tr>
                      <td>#</td>
                      <td class="all">Nama Pendaftar</td>
                      <td>Nama Calon Siswa</td>
                      <td>Pembayaran</td>
                      <td>Tiket</td>
                      <td>Status</td>
                      <td class="all">Aksi</td>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($contacts as $key => $contact)
                  <tr>
                      <td>{{++$key}}</td>
                      <td>{{$contact->nama_pendaftar}}</td>
                      <td>{{$contact->nama_calon_siswa}}</td>
                      <td>
                          {{$contact->tipe_pembayaran}} - {{$contact->payment_code}}<br>
                          Rp. <b>{{is_numeric($contact->biaya_pembayaran) ? number_format($contact->biaya_pembayaran) : 0}}</b>
                      </td>
                      <td>{{$contact->tiket}}</td>
                      <td>{{$contact->status}}</td>
                      <td>
                          <a href="{{route('staff.pembayaran.show',$contact->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Detail</a>
                          <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="if(confirm('Apakah anda yakin akan menghapus data ini ?')){formDelete{{$contact->id}}.submit()}else{return false}"><i class="fa fa-trash"></i> Hapus</a>

                          <form action="{{route('staff.pembayaran.destroy',$contact->id)}}" method="post" class="d-none" name="formDelete{{$contact->id}}">
                            @csrf
                            @method('DELETE')
                          </form>
                      </td>
                  </tr>
                  @endforeach
                  </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
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