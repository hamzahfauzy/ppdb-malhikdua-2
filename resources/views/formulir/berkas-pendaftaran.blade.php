<div class="form-group">
    <label for="">Upload KK (PDF/JPG/PNG Max 5MB)</label>
    <input type="file" class="form-control" style="height:auto;" name="upload_kk" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
</div>
<div class="form-group">
    <label for="">Upload AKTE (PDF/JPG/PNG Max 5MB)</label>
    <input type="file" class="form-control" style="height:auto;" name="upload_akte" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
</div>
<div class="form-group">
    <label for="">Upload KTP Ayah / Wali (PDF/JPG/PNG Max 5MB)</label>
    <input type="file" class="form-control" style="height:auto;" name="upload_ktp_ayah" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
</div>
<div class="form-group">
    <label for="">Upload KTP Ibu / Wali (PDF/JPG/PNG Max 5MB)</label>
    <input type="file" class="form-control" style="height:auto;" name="upload_ktp_ibu" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
</div>
<div class="form-group">
    <label for="">No Seri Ijazah</label>
    <input type="text" name="berkas[no_seri_ijazah]" class="form-control">
</div>
<div class="form-group">
    <label for="">Upload Ijazah (PDF/JPG/PNG Max 5MB)</label>
    <input type="file" class="form-control" style="height:auto;" name="upload_ijazah" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
</div>
<div class="form-group">
    <label for="">No Seri SHUN</label>
    <input type="text" name="berkas[no_seri_shun]" class="form-control">
</div>
<div class="form-group">
    <label for="">Upload SHUN (PDF/JPG/PNG Max 5MB)</label>
    <input type="file" class="form-control" style="height:auto;" name="upload_shun" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
</div>
<div class="form-group">
    <label for="">No Peserta UN</label>
    <input type="text" name="berkas[no_peserta_un]" class="form-control">
</div>

<div class="form-group">
    <label for="">Kartu Pemerintah</label>
    <select name="berkas[kartu_pemerintah]" class="form-control" onchange="setUploadKartuPemerintah(this.value)">
        <option value="Tidak">Tidak</option>
        <option value="Ya">Ya</option>
    </select>
</div>
<div class="form-group">
    <label for="">Upload Kartu Pemerintah</label>
    <input type="file" class="form-control" style="height:auto;" name="upload_kartu_pemerintah" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
</div>
{{--
<div class="form-group">
    <label for="">VAKSIN</label>
    <select name="berkas[vaksin]" class="form-control">
        <option value="-" selected disabled>- Pilih Opsi -</option>
        <option value="SUDAH">SUDAH</option>
        <option value="BELUM">BELUM</option>
    </select>
</div>
<div class="form-group">
    <label for="">Upload Vaksin</label>
    <input type="file" class="form-control" style="height: auto" name="upload_vaksin">
</div>
--}}

<div class="form-group">
    <label for="">Nomor KIP (jika punya)</label>
    <input type="text" name="berkas[no_kip]" class="form-control">
</div>
<div class="form-group">
    <label for="">Upload KIP</label>
    <input type="file" class="form-control" style="height: auto" name="upload_kip">
</div>

<div class="form-group">
    <label for="">Nomor KKS (jika punya)</label>
    <input type="text" name="berkas[no_kks]" class="form-control">
</div>
<div class="form-group">
    <label for="">Upload KKS</label>
    <input type="file" class="form-control" style="height: auto" name="upload_kks">
</div>

<div class="form-group">
    <label for="">Nomor PKH (jika punya)</label>
    <input type="text" name="berkas[no_pkh]" class="form-control">
</div>
<div class="form-group">
    <label for="">Upload PKH</label>
    <input type="file" class="form-control" style="height: auto" name="upload_pkh">
</div>