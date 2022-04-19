<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    use HasFactory;

    protected $guarded = [];

    function daftarUlang(){
        return $this->hasMany(DaftarUlang::class);
    }

    function getNomorAttribute()
    {
        $kode = "";
        $rencana = $this->data_rencana_sekolah;
        $program = $rencana->program;
        if($program == 'Keagamaan')
            $kode = "MAK";
        if(in_array($program,['Olimpiade (IPA Unggulan)','Vokasi (IPA Regular)']))
            $kode = "IPA";
        if(in_array($program,['Olimpiade (IPS Unggulan)','Vokasi (IPS Regular)']))
            $kode = "IPS";
        
        $jenis_kelamin = $this->data_diri->jenis_kelamin;
        $gender = $jenis_kelamin == 'Perempuan' ? 'PI' : 'PA';

        $siswa = Formulir::where('status','<>','')->whereHas('data_diri',function($q) use ($jenis_kelamin) {
            $q->where('jenis_kelamin',$jenis_kelamin);
        })->whereHas('data_rencana_sekolah',function($q) use ($kode){
            $p = ['Keagamaan'];
            if($kode == "IPA")
                $p = ['Olimpiade (IPA Unggulan)','Vokasi (IPA Regular)'];
            if($kode == "IPS")
                $p = ['Olimpiade (IPS Unggulan)','Vokasi (IPS Regular)'];
            $q->whereIn('program',$p);
        })->get();

        $no_urut = 0;
        foreach($siswa as $key => $s)
        {
            if($s->id == $this->id)
            {
                $no_urut = $key+1;
                break;
            }
        }

        $no_urut = $no_urut < 10 ? "0".$no_urut : $no_urut;
        return $kode.$gender.$no_urut;
    }
    
    function alamat_asal()
    {
        return $this->hasOne(AlamatAsal::class);
    }
    
    function asal()
    {
        return $this->hasOne(AlamatAsal::class);
    }

    function berkas_pendaftaran()
    {
        return $this->hasOne(BerkasPendaftaran::class);
    }
    
    function berkas()
    {
        return $this->hasOne(BerkasPendaftaran::class);
    }

    function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    function ayah()
    {
        return $this->hasOne(DataAyah::class);
    }

    function ibu()
    {
        return $this->hasOne(DataIbu::class);
    }

    function data_diri()
    {
        return $this->hasOne(DataDiri::class);
    }

    function diri()
    {
        return $this->hasOne(DataDiri::class);
    }

    function wali()
    {
        return $this->hasOne(DataWali::class);
    }

    function data_pendidikan()
    {
        return $this->hasOne(DataPendidikan::class);
    }
    
    function pendidikan()
    {
        return $this->hasOne(DataPendidikan::class);
    }

    function data_rencana_sekolah()
    {
        return $this->hasOne(DataRencanaSekolah::class);
    }
    
    function rencana()
    {
        return $this->hasOne(DataRencanaSekolah::class);
    }
}
