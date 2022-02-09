@extends('layouts.staff')
@section('title','Data Pembayaran')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Kirim Tiket</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/staff">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('staff.pembayaran.index')}}">Pembayaran</a></li>
                    <li class="breadcrumb-item active">Kirim Tiket</li>
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
                @if ($msg = session('contact_exists'))
                    <div class="alert alert-danger" role="alert">
                        {{ $msg }}
                    </div>
                @endif
                <form action="{{route('staff.pembayaran.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Pendaftar</label>
                        <input type="text" name="nama_pendaftar" class=" form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor WA (Contoh : 81234567890)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+62</span>
                            </div>
                            <input type="tel" pattern="^[1-9]\d*$" name="no_wa" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Calon Siswa</label>
                        <input type="text" name="nama_calon_siswa" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" onchange="checkPendaftar(this)">
                            <label class="form-check-label" for="gridCheck">
                                Sama Dengan Pendaftar
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Alumni PP Al Hikmah 2 ?</label>
                        <select name="alumni" class="form-control" onchange="checkAlumni(this)">
                            <option value="-" selected disabled>- Pilih Jawaban -</option>
                            <option value="Tidak">Tidak</option>
                            <option value="Ya">Ya</option>
                        </select>
                    </div>
                    <div class="form-group d-none" id="asal_sekolah">
                        <label for="">Asal Sekolah</label>
                        <select class="form-control" onchange="setAlumni(this.value)">
                            <option value="-" selected disabled>- Pilih Jawaban -</option>
                            <option value="SMP AL HIKMAH 2">SMP AL HIKMAH 2</option>
                            <option value="MTS AL HIKMAH 2">MTS AL HIKMAH 2</option>
                            <option value="Madrasah Ibtida’iyah Tamrinussibyan">Madrasah Ibtida’iyah Tamrinussibyan</option>
                            <option value="TK AL HIKMAH 2">TK AL HIKMAH 2</option>
                            <option value="Tahfidzul Qur’an AL HIKMAH 2">Tahfidzul Qur’an AL HIKMAH 2</option>
                        </select>
                    </div>
                    <div class="form-group d-none" id="sebut_nama_sekolah">
                        <label for="">Sebutkan Nama Sekolah</label>
                        <input type="text" name="sebutkan_nama_sekolah" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Domisili</label>
                        <select name="domisili" class="form-control" onchange="checkDomisili(this)">
                            <option value="-" selected disabled>- Pilih Domisili -</option>
                            <option value="Warga Benda">Warga Benda</option>
                            <option value="Bukan Warga Benda">Bukan Warga Benda</option>
                        </select>
                    </div>
                    <div class="form-group d-none" id="ketik_alamat">
                        <label for="">Ketik alamat</label>
                        <textarea name="alamat" rows="5" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('script')
<script>
function checkPendaftar(el) {
    var pendaftar = $("input[name=nama_pendaftar]");
    var calon_siswa = $("input[name=nama_calon_siswa]");
    if (el.checked) {
        calon_siswa.val(pendaftar.val())
        calon_siswa.attr('readonly', true)
    } else {
        calon_siswa.val('')
        calon_siswa.attr('readonly', false)
    }
}

function setAlumni(val)
{
    var sebut = $("#sebut_nama_sekolah")
    sebut.find("input").val(val)
}

function checkAlumni(el) {
    var sebut = $("#sebut_nama_sekolah")
    var asal = $("#asal_sekolah")
    var biaya = $("input[name='biaya_pembayaran']")
    var bp = $("#bp")

    var domisili = $("input[name='domisili']")

    if (el.value !== "Ya") {
        sebut.removeClass("d-none")
        asal.addClass("d-none")
    } else {
        sebut.addClass("d-none")
        asal.removeClass("d-none")
        // sebut.find("input").val("PP Al Hikmah 2")
        // sebut.addClass("d-none")
    }

    if (el.value == "Ya" || domisili.val() == "Warga Benda") {
        biaya.val("95000")
        bp.html("Rp95.000")
    } else {
        biaya.val("125000")
        bp.html("Rp125.000")
    }
}

function checkDomisili(el) {
    var alamat = $("#ketik_alamat")
    var biaya = $("input[name='biaya_pembayaran']")
    var bp = $("#bp")

    var alumni = $("input[name='alumni']")

    if (el.value == "Warga Benda" || alumni.val() == "Ya") {
        biaya.val("110000")
        bp.html("Rp110.000")
    } else {
        biaya.val("135000")
        bp.html("Rp135.000")
    }

    alamat.removeClass("d-none")
}
</script>
@endsection