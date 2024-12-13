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
        <input type="text" value="{{$contact->no_wa}}" name="no_wa" class="form-control" readonly>
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
