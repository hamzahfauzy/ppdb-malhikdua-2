<div class="form-group">
    <label for="">Nama Lengkap</label>
    <input type="text" name="diri[nama_lengkap]" class="form-control">
</div>
<div class="form-group">
    <label for="">Nomor WA (Contoh : 81234567890)</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">+62</span>
        </div>
        <input type="tel" pattern="^[1-9]\d*$" name="no_wa" value="{{isset($formulir)?$formulir->contact->no_wa:''}}" class="form-control" required>
    </div>
</div>
<div class="form-group">
    <label for="">Alamat sesuai KTP</label>
    <textarea name="diri[alamat]" class="form-control" rows="5"></textarea>
</div>
<div class="form-group">
    <label for="">Tempat Lahir</label>
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
    <label for="">No. KK</label>
    <input type="tel" name="diri[no_kk]" class="form-control" pattern="[0-9]{16}">
</div>
<div class="form-group">
    <label for="">NIK</label>
    <input type="tel" name="diri[NIK]" class="form-control" pattern="[0-9]{16}">
</div>
<div class="form-group">
    <label for="">Anak Ke</label>
    <input type="tel" name="diri[anak_ke]" class="form-control" pattern="[0-9]+">
</div>
<div class="form-group">
    <label for="">Jumlah Saudara (termasuk pendaftar)</label>
    <input type="tel" name="diri[jumlah_saudara]" class="form-control"  pattern="[0-9]+">
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
<div class="form-group">
    <label for="">Agama</label>
    <input type="text" name="diri[agama]" class="form-control">
</div>
<div class="form-group">
    <label for="">Cita-Cita (tidak wajib)</label>
    <input type="text" name="diri[cita_cita]" class="form-control">
</div>
<div class="form-group">
    <label for="">Email siswa (jika tidak punya bisa gunakan email orangtua/kakak/saudara)</label>
    <input type="text" name="diri[email]" class="form-control">
</div>
<div class="form-group">
    <label for="">YANG MEMBIAYAI SEKOLAH</label>
    <select name="diri[yang_membiayai_sekolah]" class="form-control">
        <option value="-" selected disabled>- Pilih Opsi -</option>
        <option value="ORANGTUA">ORANGTUA</option>
        <option value="KAKAK">KAKAK</option>
        <option value="LAINNYA (SEBUTKAN)">LAINNYA (SEBUTKAN)</option>
    </select>
    <input type="text" name="diri[yang_membiayai_sekolah]" placeholder="Lainnya... " class="form-control mt-2 d-none">
</div>
<div class="form-group">
    <label for="">Nama Kepala Keluarga</label>
    <input type="text" name="diri[nama_kepala_keluarga]" class="form-control">
</div>