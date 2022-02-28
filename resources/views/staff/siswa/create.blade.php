@extends('layouts.staff')
@section('title','Formulir Pendaftaran')

@section('style')
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color:#333;
    }
</style>
@endsection

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
            <form method="post" enctype="multipart/form-data" action="{{route('staff.siswa.store')}}">
                @csrf
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
                        @include('staff.siswa.formulir.rencana-sekolah')
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
                        @include('staff.siswa.formulir.data-diri')
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
                        @include('staff.siswa.formulir.data-pendidikan')
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
                        @include('staff.siswa.formulir.alamat-asal')
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
                        @include('staff.siswa.formulir.data-orang-tua')
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Berkas Pendaftaran</h3>
                        <div class="card-tools">
                            <!-- Collapse Button -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body login-card-body">
                        @include('staff.siswa.formulir.berkas-pendaftaran')
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Malhikdua</h3>
                        <div class="card-tools">
                            <!-- Collapse Button -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body login-card-body">
                        <div class="form-group">
                            <label for="">Dari manakah Anda mengetahui informasi tentang MA Al Hikmah 2?</label>
                            <select name="info[]" id="" class="form-control select2 w-100" multiple="multiple">
                                <option class="text-dark" value="Brosur">Brosur</option>
                                <option class="text-dark" value="Spanduk / baliho / poster">Spanduk / baliho / poster</option>
                                <option class="text-dark" value="Sosial media">Sosial media</option>
                                <option class="text-dark" value="Instagram">Instagram</option>
                                <option class="text-dark" value="Facebook">Facebook</option>
                                <option class="text-dark" value="Twitter">Twitter</option>
                                <option class="text-dark" value="Youtube">Youtube</option>
                                <option class="text-dark" value="Google">Google</option>
                                <option class="text-dark" value="Saudara">Saudara</option>
                                <option class="text-dark" value="Tetangga">Tetangga</option>
                                <option class="text-dark" value="Teman">Teman</option>
                                <option class="text-dark" value="Lainnya">Lainnya</option>
                            </select>
                            <!-- <input type="text" name="info[]" placeholder="Lainnya... " class="form-control mt-2 d-none"> -->
                        </div>
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

@endsection

@section('script')
<script>
    {{-- 
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
            $('[name="{{$key}}[{{$label}}]"]').val("{{$formulir->$key->$label}}")
        @endforeach
        @endif
    @endforeach
    initProgram();
    --}}

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

    $("[name='provinsi']").change(function(){
        fetch(`${BINDER_URL}/wilayah/kabupaten?api_key=${BINDER_API_KEY}&id_provinsi=${this.value}`).then(response=>response.json()).then(res=>{
            
            var html = ""

            res.value.forEach(data=>{
                let opt = `<option value='${data.id}' data-value='${JSON.stringify(data)}'>${data.name}</option>`;

                html+=opt
            })

            var selectedData = $(this).find(":selected").data("value")

            $("[name='asal[provinsi]']").val(selectedData.name)


            document.querySelector("[name='kabupaten']").innerHTML+=html
        })
    })
    
    $("[name='kabupaten']").change(function(){
        fetch(`${BINDER_URL}/wilayah/kecamatan?api_key=${BINDER_API_KEY}&id_kabupaten=${this.value}`).then(response=>response.json()).then(res=>{
            
            var html = ""

            res.value.forEach(data=>{
                let opt = `<option value='${data.id}' data-value='${JSON.stringify(data)}'>${data.name}</option>`;

                html+=opt
            })

            var selectedData = $(this).find(":selected").data("value")

            $("[name='asal[kabupaten]']").val(selectedData.name)

            document.querySelector("[name='kecamatan']").innerHTML+=html
        })
    })
    
    $("[name='kecamatan']").change(function(){
        fetch(`${BINDER_URL}/wilayah/kelurahan?api_key=${BINDER_API_KEY}&id_kecamatan=${this.value}`).then(response=>response.json()).then(res=>{
            
            var html = ""

            res.value.forEach(data=>{
                let opt = `<option value='${data.id}' data-value='${JSON.stringify(data)}'>${data.name}</option>`;

                html+=opt
            })

            var selectedData = $(this).find(":selected").data("value")

            $("[name='asal[kecamatan]']").val(selectedData.name)


            document.querySelector("[name='desa_kelurahan']").innerHTML+=html
        })
    })

    $("[name='desa_kelurahan']").change(function(){
        var selectedData = $(this).find(":selected").data("value")

        $("[name='asal[desa_kelurahan]']").val(selectedData.name)
    })

    $("select[name='diri[yang_membiayai_sekolah]'").change(function(){
        if(this.value == 'LAINNYA (SEBUTKAN)'){
            $("input[name='diri[yang_membiayai_sekolah]'").val('')
            $("input[name='diri[yang_membiayai_sekolah]'").removeClass("d-none")
        }else{
            $("input[name='diri[yang_membiayai_sekolah]'").addClass("d-none")
            $("input[name='diri[yang_membiayai_sekolah]'").val(this.value)
        }
    })
    $("[name='wali[opsi]']").change(function(){
        if(this.value == 'Lainnya'){
            $("#wali-box").removeClass("d-none")
        }else{
            $("#wali-box").addClass("d-none")
        }
    })
    $("select[name='info[]']").change(function(){
        
        var values = $(this).val()

        // if(values.includes('Lainnya (Sebutkan)')){
        //     $("input[name='info[]']").removeClass("d-none")
        // }else{
        //     $("input[name='info[]']").addClass("d-none")
        // }
    })

    $('input, textarea, select').attr('required','')
    $('input[type=file],input[name="berkas[no_seri_shun]"],input[name="berkas[no_seri_ijazah]"],input[name="berkas[no_peserta_un]"],[name="diri[cita_cita]"],[name="pendidikan[NSM]"],[name^="wali"],[name="berkas[no_pkh]"],[name="berkas[no_kip]"],[name="berkas[no_kks]"]').removeAttr('required')
    $('input[name=upload_kk],input[name=upload_akte]').attr('required','')
    function setUploadKartuPemerintah(val)
    {
        $('[name=upload_kartu_pemerintah]').removeAttr('required')
        if(val == 'Ya')
            $('[name=upload_kartu_pemerintah]').attr('required','')
    }
    $("input[name='rencana[program]']").change(initProgram)

    function initProgram(){

        $("#fg-spf").removeClass("d-none")

        var fcBi = $("#fc-bi")
        var fcTb = $("#fc-tb")
        var fcOtkp = $("#fc-otkp")
        var fcDkv = $("#fc-dkv")
        var fcTkj = $("#fc-tkj")
        var fcPerikanan = $("#fc-perikanan")
        var fcPengelasan = $("#fc-pengelasan")
        var fcDesain = $("#fc-desain")

        if (this.value == "Keagamaan" || this.value == "Olimpiade (IPA Unggulan)") {
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