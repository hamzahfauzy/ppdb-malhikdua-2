<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PPDB</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <style>
    .payment {
        display: none;
    }
    body {
        background-color: green;
    }
    </style>
</head>

<body>
    <div class="container">
        <form method="post" style="background-color: #FFF;margin-top:15px;margin-bottom:15px;padding:15px;">
            @csrf
            <div class="row">
                <div class="col-md-12 mt-5">
                    <center>
                        <img src="{{asset('images/faktur.png')}}" alt="" style="max-width: 400px;width:100%;">
                    </center>
                    <div id="stepper1" class="bs-stepper">
                        <div style="width: 100%;overflow:auto;">
                            <div class="bs-stepper-header">
                                <div class="step" data-target="#step-content-1">
                                    <button type="button" class="btn step-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Informasi Kontak</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-content-2">
                                    <button type="button" class="btn step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Informasi Siswa</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-content-3">
                                    <button type="button" class="btn step-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Pembayaran</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <div id="step-content-1" class="content">

                                <div class="card card-body">
                                    @if(Session::has('contact_exists'))

                                    <span class="alert alert-danger">{{Session::get('contact_exists')}}</span>

                                    @endif

                                    @if(Session::has('error'))

                                    <span class="alert alert-danger">{{Session::get('error')}}</span>

                                    @endif

                                    @if(Session::has('otp'))

                                    <span class="alert alert-success">Kode OTP sudah dikirim ke nomor WA anda. Silahkan cek WA, masukkan kode tersebut ke kotak isian, dan klik Verifikasi.</span>

                                    @endif

                                    @if(Session::has('verification'))

                                    <span class="alert alert-success">OTP Valid</span>
                                    <input type="hidden" name="verificated" value="true">

                                    @endif

                                    <div class="form-group">
                                        <label for="">Nama Pendaftar</label>
                                        <input type="text" name="nama_pendaftar" value="{{Session::get('request') ? Session::get('request')['nama_pendaftar'] : ''}}" value="{{Session::get('request') ? Session::get('request')['nama_pendaftar'] : ''}}" <?= Session::get('request') ? 'readonly' : '' ?> class=" form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nomor WA (Contoh : 81234567890)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">+62</span>
                                            </div>
                                            <input type="tel" pattern="^[1-9]\d*$" name="no_wa" value="{{Session::get('request') ? Session::get('request')['no_wa'] : ''}}" <?= Session::get('request') ? 'readonly' : '' ?> class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" name="email" value="{{Session::get('request') ? Session::get('request')['email'] : ''}}" <?= Session::get('request') ? 'readonly' : '' ?> class="form-control" required>
                                    </div>
                                    @if(Session::has('otp'))
                                    <div class="form-group">
                                        <label for="">Kode OTP</label>
                                        <input type="text" name="otp" class="form-control">
                                    </div>
                                    @endif
                                </div>

                                <hr>

                                @if(!Session::has('verification'))

                                @if(Session::has('otp')) 

                                <button class="btn btn-primary">Verifikasi</button>
                                <button name="reset" value="reset" class="btn btn-primary">Ulang</button>

                                @else

                                <button class="btn btn-primary">Kirim OTP</button>

                                @endif
                                @else

                                <button type="button" class="btn btn-primary" onclick="stepper1.next()">Next</button>

                                @endif
                            </div>
                            <div id="step-content-2" class="content">
                                <div class="card card-body">
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
                                            {{-- <option value="Madrasah Ibtida’iyah Tamrinussibyan">Madrasah Ibtida’iyah Tamrinussibyan</option>
                                            <option value="TK AL HIKMAH 2">TK AL HIKMAH 2</option>
                                            <option value="Tahfidzul Qur’an AL HIKMAH 2">Tahfidzul Qur’an AL HIKMAH 2</option> --}}
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
                                </div>

                                <hr>
                                <button type="button" class="btn btn-primary" onclick="validateStep2()">Next</button>
                            </div>
                            <div id="step-content-3" class="content">

                                <div class="card">
                                    <div class="card-header bg-info text-white d-flex justify-content-between">
                                        <h5>Pembayaran</h5>
                                        <h5>Biaya : <b id="bp">Rp125.000,00</b></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Metode Pembayaran</label>
                                            <select name="payment_gateway" class="form-control" onchange="showPaymentMethod(this.value)">
                                                <option value="" selected disabled>- Pilih -</option>
                                                <option value="transfer bank">Transfer Bank</option>
                                                <option value="bayar dilokasi (OTS)">Bayar dilokasi (OTS)</option>
                                                <option value="tripay">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group payment tripay">
                                            <label for="">Pembayaran</label>
                                            {{-- <input type="hidden" name="payment_gateway" value="tripay"> --}}
                                            <select name="tipe_pembayaran" class="form-control">
                                                <option value="" selected>- Pilih -</option>
                                                {{-- @foreach($duitku as $k => $v)
                                                <option value="{{$k}}" class="payment duitku">{{$v}}</option>
                                                @endforeach
                                                @if(isset($tripay['data']))
                                                @foreach($tripay['data'] as $k => $v)
                                                @if(!$v['active'])
                                                @continue
                                                @endif
                                                <option value="{{$v['code']}}" class="payment tripay">{{$v['name']}}</option>
                                                @endforeach
                                                @endif --}}
                                                @if(isset($tripay['data']))
                                                @foreach($tripay['data'] as $k => $v)
                                                @if(!$v['active'])
                                                @continue
                                                @endif
                                                <option value="{{$v['code']}}">{{$v['name']}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <input type="hidden" name="biaya_pembayaran" value="125.000">
                                    </div>
                                </div>

                                <hr>

                                <button type="button" class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>

    <script>
        var stepper1 = new Stepper(document.querySelector('#stepper1'))
        @if(Session::has('verification'))
        stepper1.next()
        @endif

        function validateStep2()
        {
            if($('[name=sebutkan_nama_sekolah]').val() == "" || $('[name=alamat]').val()=="")
            {
                alert("Terdapat field yang kosong. silahkan di isi terlebih dahulu")
                return
            }
            stepper1.next()
        }

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

        function showPaymentMethod(value)
        {
            document.querySelector('[name="tipe_pembayaran"]').value = ""
            document.querySelectorAll('.payment').forEach(val => {val.style.display="none"})
            if(value == 'tripay')
            {
                document.querySelectorAll('.payment.'+value).forEach(val => {val.style.display="block"})
            }
        }
    </script>
</body>

</html>