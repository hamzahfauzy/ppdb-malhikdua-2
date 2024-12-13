@extends('layouts.app')
@section('title','Formulir Pendaftaran')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Formulir</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Formulir</li>
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
            @if ($msg = session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ $msg }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="contact_id" value="{{auth()->user()->contact->id}}">
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
                <button class="btn btn-primary" name="status" value="final">Submit</button>
                <button class="btn btn-primary" name="status" value="draft">Simpan sebagai Draft</button>
                <br>
            </form>
            <p></p>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>
    const BINDER_URL = "https://api.binderbyte.com"
    const BINDER_API_KEY = "b08e7d4e02ad58373ebeab22fb65a6c793cf559dd8d4c49056e9fa07a6c21767"

    fetch(`${BINDER_URL}/wilayah/provinsi?api_key=${BINDER_API_KEY}`).then(response=>response.json()).then(res=>{
        
        var html = ""

        res.value.forEach(data=>{
            let opt = `<option value='${data.id}' data-value='${JSON.stringify(data)}'>${data.name}</option>`;

            html+=opt
        })


        document.querySelector("[name='provinsi']").innerHTML+=html
    })

    @foreach($labels as $key => $value)
        @if($key=='wali'&&!$formulir->wali)
        @continue
        @endif

        @if($key=='rencana')
            @foreach($value as $label)
            $('[name="{{$key}}[{{$label}}]"][value="{{$formulir->$key->$label}}"]').prop('checked',true)
            @endforeach
        @elseif($key=='asal')
            @foreach($value as $label)
            @if(in_array($label, ['desa_kelurahan','kecamatan','kabupaten','provinsi']))
            $('[name="{{$label}}"]').html(`<option>{{$formulir->$key->$label}}</option>`)
            $('[name="{{$key}}[{{$label}}]"]').val(`{{$formulir->$key->$label}}`)
            @else
            $('[name="{{$key}}[{{$label}}]"]').val(`{{$formulir->$key->$label}}`)
            @endif
            @endforeach
        @else
        @foreach($value as $label)
            $('[name="{{$key}}[{{$label}}]"]').val(`{{$formulir->$key->$label}}`)
        @endforeach
        @endif
    @endforeach

    initProgram();

    $('input, textarea, select').attr('required','')
    $('input[type=file],input[name="berkas[no_seri_shun]"],input[name="berkas[no_seri_ijazah]"],input[name="berkas[no_peserta_un]"],[name="berkas[no_pkh]"],[name="berkas[no_kip]"],[name="berkas[no_kks]"], [name^=wali],[name="pendidikan[prestasi]"],[name="ayah[no_handphone]"],[name="ibu[no_handphone]"]').removeAttr('required')
    $("input[name='rencana[program]']").change(initProgram)

    $("[name='provinsi']").change(function(){
        fetch(`${BINDER_URL}/wilayah/kabupaten?api_key=${BINDER_API_KEY}&id_provinsi=${this.value}`).then(response=>response.json()).then(res=>{
            
            var html = "<option value=''>- Pilih Kabupaten -</option>"

            res.value.forEach(data=>{
                let opt = `<option value='${data.id}' data-value='${JSON.stringify(data)}'>${data.name}</option>`;

                html+=opt
            })

            var selectedData = $(this).find(":selected").data("value")

            $("[name='asal[provinsi]']").val(selectedData.name)
            $("[name='asal[kabupaten]']").val('')
            $("[name='kabupaten']").html('')
            $("[name='asal[kecamatan]']").val('')
            $("[name='kecamatan']").html('<option value="">- Pilih Kabupaten -</option>')
            $("[name='asal[desa_kelurahan]']").val('')
            $("[name='desa_kelurahan']").html('<option value="">- Pilih Kabupaten -</option>')


            document.querySelector("[name='kabupaten']").innerHTML=html
        })
    })
    
    $("[name='kabupaten']").change(function(){
        fetch(`${BINDER_URL}/wilayah/kecamatan?api_key=${BINDER_API_KEY}&id_kabupaten=${this.value}`).then(response=>response.json()).then(res=>{
            
            var html = "<option value=''>- Pilih Kecamatan -</option>"

            res.value.forEach(data=>{
                let opt = `<option value='${data.id}' data-value='${JSON.stringify(data)}'>${data.name}</option>`;

                html+=opt
            })

            var selectedData = $(this).find(":selected").data("value")

            $("[name='asal[kabupaten]']").val(selectedData.name)
            $("[name='asal[kecamatan]']").val('')
            $("[name='asal[desa_kelurahan]']").val('')
            $("[name='desa_kelurahan']").html('<option value="">- Pilih Kecamatan -</option>')

            document.querySelector("[name='kecamatan']").innerHTML=html
        })
    })
    
    $("[name='kecamatan']").change(function(){
        fetch(`${BINDER_URL}/wilayah/kelurahan?api_key=${BINDER_API_KEY}&id_kecamatan=${this.value}`).then(response=>response.json()).then(res=>{
            
            var html = "<option value=''>- Pilih Desa/Keluarahan -</option>"

            res.value.forEach(data=>{
                let opt = `<option value='${data.id}' data-value='${JSON.stringify(data)}'>${data.name}</option>`;

                html+=opt
            })

            var selectedData = $(this).find(":selected").data("value")

            $("[name='asal[kecamatan]']").val(selectedData.name)


            document.querySelector("[name='desa_kelurahan']").innerHTML=html
        })
    })

    $("[name='desa_kelurahan']").change(function(){
        var selectedData = $(this).find(":selected").data("value")

        $("[name='asal[desa_kelurahan]']").val(selectedData.name)
    })

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