<?php

namespace App\Http\Controllers;

use App\Models\Duitku;
use App\Models\Fonnte;
use App\Models\Tripay;
use App\Models\Contact;
use App\Models\WaBlast;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    function tiket($contact)
    {
        if($contact->tiket == "")
        {
            $tiket = $contact->id;
            if($tiket < 10)
                $tiket = "000".$tiket;
            elseif($tiket < 100)
                $tiket = "00".$tiket;
            elseif($tiket < 1000)
                $tiket = "0".$tiket;
            
            $tiket = "MDTKT".$tiket;
            $tiket = md5($tiket);
            $tiket = substr($tiket,0,8);
        }
        else
            $tiket = $contact->tiket;

        $message = "Terima kasih $contact->nama_pendaftar ($contact->alamat) telah melakukan pembayaran PPDB Malhikdua melalui $contact->tipe_pembayaran";
        $message .= "\nBerikut adalah tiket pengisian formulir anda : $tiket";
        $message .= "\nGunakan tiket ini untuk mengisi/mengedit formulir PPDB hingga lengkap.";
        $message .= "\nFormulir PPDB di ".route('login')." (ONLINE)";
        $message .= "\nManfaatkan tombol SAVE untuk menyimpan isian formulir.";
        $message .= "\nJika sudah, klik tombol VERIFIKASI BERKAS/PENDAFTARAN untuk diperiksa petugas.";
        WaBlast::send("+62".$contact->no_wa,$message);
        return $tiket;
    }
    //
    function tripay()
    {
        $privateKey = getenv('TRIPAY_PRIVATE_KEY');
        $apiKey = getenv('TRIPAY_API_KEY');
        $tripay = new Tripay($privateKey, $apiKey);
        $callback = $tripay->callback();

        if($callback->status)
        {
            $merchantRef = $callback->reference;
            $contact = Contact::where("payment_reference",$merchantRef)->firstOrFail();
            $data = [
                'status' => $callback->status,
            ];
            if($callback->status == 'PAID')
            {
                $tiket = $this->tiket($contact);
                $data['tiket'] = $tiket;
            }
            $contact->update($data);
            return ['success'=>true];
        }
    }

    function duitku()
    {
        $duitku = new Duitku;
        $callback = $duitku->callback();
        if(isset($callback['success']))
        {
            $merchantRef = $callback['reference'];
            $contact = Contact::where("payment_reference",$merchantRef)->firstOrFail();
            $data = [
                'status' => $callback['resultCode'] == "00" ? "SUCCESS" : "FAILED",
            ];
            if($callback['resultCode']=="00")
            {
                $tiket = $this->tiket($contact);
                $data['tiket'] = $tiket;
            }
            $contact->update($data);
            return ['success'=>true];
        }
    }
}
