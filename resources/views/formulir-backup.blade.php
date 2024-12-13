@extends('layouts.app')

@section('content')
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <div class="container">
        <form method="post" class="row" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="contact_id" value="{{auth()->user()->contact->id}}">
            <div class="col-md-12 mt-5">
                <h2 align="center">PPDB - Formulir</h2>
                <div id="stepper1" class="bs-stepper">
                    <div class="bs-stepper-header">
                        <div class="step" data-target="#step-content-1">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Data Rencana Sekolah</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#step-content-2">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Data Diri</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#step-content-3">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Data Pendidikan</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#step-content-4">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">4</span>
                                <span class="bs-stepper-label">Alamat Asal</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#step-content-5">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">5</span>
                                <span class="bs-stepper-label">Data Orang Tua</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#step-content-6">
                            <button type="button" class="btn step-trigger">
                                <span class="bs-stepper-circle">6</span>
                                <span class="bs-stepper-label">Berkas Pendaftaran</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <div id="step-content-1" class="content">
                            <div class="card card-body">
                                <div class="form-group">
                                    <label for="">Program</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rencana[program]" id="Keagamaan" value="Keagamaan">
                                        <label class="form-check-label" for="Keagamaan">
                                            Keagamaan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rencana[program]" id="olimpiade-ipa" value="Olimpiade (IPA Unggulan)">
                                        <label class="form-check-label" for="olimpiade-ipa">
                                            Olimpiade (IPA Unggulan)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rencana[program]" id="olimpiade-ips" value="Olimpiade (IPS Unggulan)">
                                        <label class="form-check-label" for="olimpiade-ips">
                                            Olimpiade (IPS Unggulan)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rencana[program]" id="vokasi-ipa" value="Vokasi (IPA Regular)">
                                        <label class="form-check-label" for="vokasi-ipa">
                                            Vokasi (IPA Regular)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rencana[program]" id="vokasi-ips" value="Vokasi (IPS Regular)">
                                        <label class="form-check-label" for="vokasi-ips">
                                            Vokasi (IPS Regular)
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group d-none" id="fg-spf">
                                    <label for="">Spesifikasi</label>

                                    <div class="form-check d-none" id="fc-bi">
                                        <input class="form-check-input" type="radio" name="rencana[spesifikasi]" id="Bahasa-Inggris" value="Bahasa Inggris">
                                        <label class="form-check-label" for="Bahasa-Inggris">
                                            Bahasa Inggris
                                        </label>
                                    </div>

                                    <div class="form-check d-none" id="fc-otkp">
                                        <input class="form-check-input" type="radio" name="rencana[spesifikasi]" id="otkp" value="Otomatisasi Tata Kelola Perkantoran (OTKP)">
                                        <label class="form-check-label" for="otkp">
                                            Otomatisasi Tata Kelola Perkantoran (OTKP)
                                        </label>
                                    </div>

                                    <div class="form-check d-none" id="fc-dkv">
                                        <input class="form-check-input" type="radio" name="rencana[spesifikasi]" id="dkv" value="Desain Komunikasi Visual (DKV)">
                                        <label class="form-check-label" for="dkv">
                                            Desain Komunikasi Visual (DKV)
                                        </label>
                                    </div>

                                    <div class="form-check d-none" id="fc-tkj">
                                        <input class="form-check-input" type="radio" name="rencana[spesifikasi]" id="tkj" value="Teknik Komputer Jaringan (TKJ)">
                                        <label class="form-check-label" for="tkj">
                                            Teknik Komputer Jaringan (TKJ)
                                        </label>
                                    </div>

                                    <div class="form-check d-none" id="fc-perikanan">
                                        <input class="form-check-input" type="radio" name="rencana[spesifikasi]" id="Perikanan" value="Perikanan">
                                        <label class="form-check-label" for="Perikanan">
                                            Perikanan
                                        </label>
                                    </div>

                                    <div class="form-check d-none" id="fc-pengelasan">
                                        <input class="form-check-input" type="radio" name="rencana[spesifikasi]" id="Pengelasan" value="Pengelasan">
                                        <label class="form-check-label" for="Pengelasan">
                                            Pengelasan
                                        </label>
                                    </div>

                                    <div class="form-check d-none" id="fc-desain">
                                        <input class="form-check-input" type="radio" name="rencana[spesifikasi]" id="Desain" value="Desain">
                                        <label class="form-check-label" for="Desain">
                                            Desain
                                        </label>
                                    </div>

                                    <div class="form-check d-none" id="fc-tb">
                                        <input class="form-check-input" type="radio" name="rencana[spesifikasi]" id="tb" value="Tata Busana">
                                        <label class="form-check-label" for="tb">
                                            Tata Busana
                                        </label>
                                    </div>

                                </div>
                            </div>

                            <hr>

                            <button type="button" class="btn btn-primary" onclick="stepper1.next()">Next</button>
                        </div>
                        <div id="step-content-2" class="content">

                            <div class="card card-body">

                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" name="diri[nama_lengkap]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat sesuai KTP</label>
                                    <textarea name="diri[alamat]" class="form-control" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Tempat tinggal</label>
                                    <input type="text" name="diri[tempat_tinggal]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal lahir</label>
                                    <input type="date" name="diri[tanggal_lahir]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Kelamin</label>
                                    <select name="diri[jenis_kelamin]" class="form-control">
                                        <option value="-" selected disabled>- Pilih Jenis Kelamin -</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">NIK</label>
                                    <input type="text" name="diri[NIK]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Anak Ke</label>
                                    <input type="text" name="diri[anak_ke]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah Saudara (termasuk pendaftar)</label>
                                    <input type="text" name="diri[jumlah_saudara]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Status anak</label>
                                    <select name="diri[status]" class="form-control">
                                        <option value="-" selected disabled>- Pilih Status -</option>
                                        <option value="Kandung">Kandung</option>
                                        <option value="Angkat">Angkat</option>
                                        <option value="Tiri">Tiri</option>
                                    </select>
                                </div>

                            </div>

                            <hr>
                            <button type="button" class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                            <button type="button" class="btn btn-primary" onclick="stepper1.next()">Next</button>
                        </div>
                        <div id="step-content-3" class="content">
                            <div class="card card-body">

                                <div class="form-group">
                                    <label for="">NISN</label>
                                    <input type="text" name="pendidikan[NISN]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Sekolah Asal</label>
                                    <input type="text" name="pendidikan[sekolah_asal]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">NPSN Sekolah Asal</label>
                                    <input type="text" name="pendidikan[NPSN]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Angkatan Lulus</label>
                                    <select name="pendidikan[angkatan_lulus]" class="form-control">
                                        <option value="-" selected disabled>- Pilih Angkatan -</option>
                                        <option value="18/19" selected>18/19</option>
                                        <option value="19/20" selected>19/20</option>
                                        <option value="20/21" selected>20/21</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat Sekolah Asal</label>
                                    <textarea name="pendidikan[alamat]" rows="5" class="form-control"></textarea>
                                </div>

                            </div>

                            <hr>
                            <button type="button" class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                            <button type="button" class="btn btn-primary" onclick="stepper1.next()">Next</button>
                        </div>
                        <div id="step-content-4" class="content">

                            <div class="card card-body">

                                <div class="form-group">
                                    <label for="">Alamat Lengkap</label>
                                    <textarea name="asal[alamat]" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">RT</label>
                                    <input type="text" name="asal[rt]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">RW</label>
                                    <input type="text" name="asal[rw]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Desa/Kelurahan</label>
                                    <input type="text" name="asal[desa_kelurahan]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Kecamatan</label>
                                    <input type="text" name="asal[kecamatan]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Kabupaten</label>
                                    <input type="text" name="asal[kabupaten]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Provinsi</label>
                                    <input type="text" name="asal[provinsi]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Kode Pos</label>
                                    <input type="text" name="asal[kode_pos]" class="form-control">
                                </div>

                            </div>

                            <hr>

                            <button type="button" class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                            <button type="button" class="btn btn-primary" onclick="stepper1.next()">Next</button>
                        </div>
                        <div id="step-content-5" class="content">

                            <div class="card card-body">

                                <h4>Data Ayah</h4>
                                <div class="form-group">
                                    <label for="">Nomor KK</label>
                                    <input type="text" name="ayah[no_kk]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama ayah</label>
                                    <input type="text" name="ayah[nama]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Status ayah</label>
                                    <select name="ayah[status]" class="form-control">
                                        <option value="-" selected disabled>- Pilih Status -</option>
                                        <option value="Kandung">Kandung</option>
                                        <option value="Angkat">Angkat</option>
                                        <option value="Tiri">Tiri</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor KK Ayah</label>
                                    <input type="text" name="ayah[no_kk_ayah]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal lahir ayah</label>
                                    <input type="date" name="ayah[tanggal_lahir]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Keadaan Ayah</label>
                                    <select name="ayah[keadaan]" class="form-control">
                                        <option value="-" selected disabled>- Pilih Keadaan Hidup -</option>
                                        <option value="Hidup">Hidup</option>
                                        <option value="Meninggal">Meninggal</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Pekerjaan Ayah</label>
                                    <input type="text" name="ayah[pekerjaan]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Pendidikan Ayah</label>
                                    <input type="text" name="ayah[pendidikan]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Penghasilan</label>
                                    <input type="text" name="ayah[penghasilan]" class="form-control">
                                </div>

                            </div>

                            <br>

                            <div class="card card-body">

                                <h4>Data Ibu</h4>
                                <div class="form-group">
                                    <label for="">Nomor KK</label>
                                    <input type="text" name="ibu[no_kk]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="ibu[nama]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="ibu[status]" class="form-control">
                                        <option value="-" selected disabled>- Pilih Status -</option>
                                        <option value="Kandung">Kandung</option>
                                        <option value="Angkat">Angkat</option>
                                        <option value="Tiri">Tiri</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor KK</label>
                                    <input type="text" name="ibu[no_kk_ibu]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal lahir</label>
                                    <input type="date" name="ibu[tanggal_lahir]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Keadaan</label>
                                    <select name="ibu[keadaan]" class="form-control">
                                        <option value="-" selected disabled>- Pilih Keadaan Hidup -</option>
                                        <option value="Hidup">Hidup</option>
                                        <option value="Meninggal">Meninggal</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Pekerjaan</label>
                                    <input type="text" name="ibu[pekerjaan]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Pendidikan</label>
                                    <input type="text" name="ibu[pendidikan]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Penghasilan</label>
                                    <input type="text" name="ibu[penghasilan]" class="form-control">
                                </div>

                            </div>

                            <br>

                            <div class="card card-body">

                                <h4>Data Wali</h4>
                                <div class="form-group">
                                    <label for="">Nama wali</label>
                                    <input type="text" name="wali[nama]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">NIK Wali</label>
                                    <input type="text" name="wali[NIK]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Hubungan dengan pendaftar</label>
                                    <input type="text" name="wali[hubungan_dengan_pendaftar]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Pekerjaan</label>
                                    <input type="text" name="wali[pekerjaan]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Pendidikan</label>
                                    <input type="text" name="wali[pendidikan]" class="form-control">
                                </div>

                            </div>

                            <hr>

                            <button type="button" class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                            <button type="button" class="btn btn-primary" onclick="stepper1.next()">Next</button>
                        </div>
                        <div id="step-content-6" class="content">

                            <div class="card card-body">

                                <div class="form-group">
                                    <label for="">Upload KK (PDF/JPG/PNG Max 5MB)</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="upload_kk" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Upload AKTE (PDF/JPG/PNG Max 5MB)</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="upload_akte" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">No Seri Ijazah</label>
                                    <input type="text" name="berkas[no_seri_ijazah]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Upload Ijazah (PDF/JPG/PNG Max 5MB)</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="upload_ijazah" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">No Seri SHUN</label>
                                    <input type="text" name="berkas[no_seri_shun]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Upload SHUN (PDF/JPG/PNG Max 5MB)</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="upload_shun" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">No Peserta UN</label>
                                    <input type="text" name="berkas[no_peserta_un]" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Kartu Pemerintah</label>
                                    <select name="berkas[kartu_pemerintah]" class="form-control">
                                        <option value="-" selected disabled>- Pilih Jawaban-</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Upload Kartu Pemerintah</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="upload_kartu_pemerintah" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <button type="button" class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                            <button class="btn btn-primary">Submit</button>
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

        $("input[name='rencana[program]']").change(function() {

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
        })
    </script>
@endsection