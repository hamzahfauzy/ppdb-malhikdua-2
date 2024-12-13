<?php

namespace App\Models;

use App\Models\Formulir;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaftarUlang extends Model
{
    use HasFactory;

    protected $guarded = [];

    function formulir(){
        return $this->belongsTo(Formulir::class);
    }
}
