@extends('layouts.staff')
@section('title','Edit Formulir Pendaftaran')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Pendaftaran</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/siswa">Pendaftaran</a></li>
                    <li class="breadcrumb-item active">Edit Pendaftaran</li>
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
            <form method="post" enctype="multipart/form-data" action="{{route('staff.siswa.update',$formulir->id)}}">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Rencana Sekolah</h3>
                        <div class="card-tools">
                            <!-- Collapse Button -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body login-card-body">
                        @include('formulir.rencana-sekolah')
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Diri</h3>
                        <div class="card-tools">
                            <!-- Collapse Button -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body login-card-body">
                        @include('formulir.data-diri')
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pendidikan</h3>
                        <div class="card-tools">
                            <!-- Collapse Button -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body login-card-body">
                        @include('formulir.data-pendidikan')
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Alamat Asal</h3>
                        <div class="card-tools">
                            <!-- Collapse Button -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body login-card-body">
                        @include('formulir.alamat-asal')
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Orang Tua</h3>
                        <div class="card-tools">
                            <!-- Collapse Button -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body login-card-body">
                        @include('formulir.data-orang-tua')
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Berkas Pendaftaran (Kosongkan jika tidak diedit)</h3>
                        <div class="card-tools">
                            <!-- Collapse Button -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body login-card-body">
                        @include('formulir.berkas-pendaftaran')
                    </div>
                </div>
                <button class="btn btn-primary">Submit</button>
                <br>
            </form>
            <p></p>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>
    @foreach($labels as $key => $value)
        @if($key=='wali'&&!$formulir->wali)
        @continue
        @endif

        @if($key=='rencana')
            @foreach($value as $label)
            $('[name="{{$key}}[{{$label}}]"][value="{{$formulir->$key->$label}}"]').prop('checked',true)
            @endforeach
        @else
        @foreach($value as $label)
            $('[name="{{$key}}[{{$label}}]"]').val(`{{$formulir->$key->$label}}`)
        @endforeach
        @endif
    @endforeach

    initProgram();

    $('input, textarea, select').attr('required','')
    $('input[type=file],input[name="berkas[no_seri_ijazah]"],input[name="berkas[no_seri_shun]"],input[name="berkas[no_peserta_un]"]').removeAttr('required')
    $("input[name='rencana[program]']").change(initProgram)

    function initProgram(){
        var el = $("input[name='rencana[program]']")
        $("#fg-spf").removeClass("d-none")

        var fcBi = $("#fc-bi")
        var fcTb = $("#fc-tb")
        var fcOtkp = $("#fc-otkp")
        var fcDkv = $("#fc-dkv")
        var fcTkj = $("#fc-tkj")
        var fcPerikanan = $("#fc-perikanan")
        var fcPengelasan = $("#fc-pengelasan")
        var fcDesain = $("#fc-desain")

        if (el.val() == "Keagamaan" || el.val() == "Olimpiade (IPA Unggulan)") {
            fcBi.removeClass("d-none")

            fcTb.addClass("d-none")
            fcOtkp.addClass("d-none")
            fcDkv.addClass("d-none")
            fcTkj.addClass("d-none")
            fcPerikanan.addClass("d-none")
            fcPengelasan.addClass("d-none")
            fcDesain.addClass("d-none")
        } else {
            fcBi.removeClass("d-none")
            fcTb.removeClass("d-none")
            fcOtkp.removeClass("d-none")
            fcDkv.removeClass("d-none")
            fcTkj.removeClass("d-none")
            fcPerikanan.removeClass("d-none")
            fcPengelasan.removeClass("d-none")
            fcDesain.removeClass("d-none")
        }
    }
</script>
@endsection