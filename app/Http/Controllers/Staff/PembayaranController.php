<?php

namespace App\Http\Controllers\Staff;

use App\Models\User;
use App\Models\Duitku;
use App\Models\WaBlast;
use App\Models\Tripay;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PembayaranController extends Controller
{

    function __construct()
    {
        $this->contact = new Contact;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacts = $this->contact->orderby('created_at','desc')->get();
        return view('staff.pembayaran.index',compact('contacts'));
    }

    public function report()
    {
        header('Content-Type: text/csv; charset=utf-8'); 
        header("Content-Disposition: attachment; filename=Laporan-pendaftaran-".date('d-M-Y').".csv");
        $contacts = $this->contact->orderby('created_at','desc')->get();
        // return view('staff.pembayaran.report',compact('contacts'));
        $output = fopen("php://output", "w"); 
        fputcsv($output, array('NO', 'NO HP','NAMA PENDAFTAR', 'NAMA CALON SISWA', 'PEMBAYARAN', 'JUMLAH', 'TIKET', 'STATUS', 'PENDAFTARAN', 'SEKOLAH ASAL', 'PILIHAN PROGRAM')); 
        $i = 1;
        foreach($contacts as $contact)
        {
            fputcsv($output, [
                $i,
                "'".$contact->no_wa,
                $contact->nama_pendaftar,
                $contact->nama_calon_siswa,
                $contact->tipe_pembayaran." - ".$contact->payment_code,
                is_numeric($contact->biaya_pembayaran)?number_format($contact->biaya_pembayaran) : 0,
                $contact->tiket,
                $contact->status,
                $contact->payment_gateway?'Online':'Offline',
                $contact->formulir?$contact->formulir->pendidikan->sekolah_asal:'',
                $contact->formulir?$contact->formulir->rencana->program:''
            ]); 
            $i++;
        }

        fclose($output); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('staff.pembayaran.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $check_contact = Contact::where('email',$request->email)->orwhere('no_wa',$request->no_wa)->exists();
        $check_user = Contact::where('email',$request->no_wa)->exists();
        if($check_contact || $check_user)
            return redirect()->back()->with(['contact_exists' => 'Email atau No. Whatsapp sudah terdaftar']);
        
        $contact = new Contact();
        $amount = $request->domisili == 'Warga Benda' || $request->alumni == 'Ya' ? 110000 : 135000;
        // bayar dulu
        
        $request->merge([
            'status' => 'PAID',
            'tiket' => '',
            'tipe_pembayaran' => '',
            'biaya_pembayaran' => $amount,
            'payment_gateway' => '',
            'payment_reference' => '',
            'payment_code' => '',
            'checkout_url' => '',
            'expired_time' => '',
        ]);

        if ($nc = $contact->create($request->post())) {
            $tiket = $nc->id;
            if($tiket < 10)
                $tiket = "000".$tiket;
            elseif($tiket < 100)
                $tiket = "00".$tiket;
            elseif($tiket < 1000)
                $tiket = "0".$tiket;
            
            $tiket = "MDTKT".$tiket;
            $tiket = md5($tiket);
            $tiket = substr($tiket,0,8);
            $nc->update([
                'tiket' => $tiket
            ]);
            $user = new User();

            if ($user->create([
                'email' => $nc->no_wa,
                'name' => $nc->nama_pendaftar,
                'password' => bcrypt($nc->no_wa)
            ])) {
                $contact = $nc;
                $message = "Hai $contact->nama_pendaftar ($contact->alamat)";
                $message .= "\nBerikut adalah tiket pengisian formulir anda : $tiket";
                $message .= "\nGunakan tiket ini untuk mengisi/mengedit formulir PPDB hingga lengkap.";
                $message .= "\nFormulir PPDB di ".route('login')." (ONLINE)";
                $message .= "\nManfaatkan tombol SAVE untuk menyimpan isian formulir.";
                $message .= "\nJika sudah, klik tombol VERIFIKASI BERKAS/PENDAFTARAN untuk diperiksa petugas.";

                $wa = new WaBlast;
                $wa->send_text("62".$contact->no_wa,$message);

                // WaBlast::send("+62".$contact->no_wa,$message);

                return redirect()->route('staff.pembayaran.index')->with(['success' => 'Berhasil membuat pembayaran']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = $this->contact->findOrFail($id);
        return view('staff.pembayaran.show',compact('contact'));
    }

    public function check(Contact $contact)
    {
        if($contact->payment_gateway=='tripay')
        {
            $privateKey = getenv('TRIPAY_PRIVATE_KEY');
            $tripay = new Tripay($privateKey, getenv('TRIPAY_API_KEY'));
            $response = $tripay->curlAPI($tripay->URL_transDetailMp,['reference'=>$contact->payment_reference],'GET');
            if($response['success'])
            {
                $response_data = $response['data'];
                $contact->update([
                    'status' => $response_data['status']
                ]);
            }
        }
        else
        {
            // duitku
            $duitku = new Duitku;
            $check = $duitku->check($contact->payment_code);
            if(isset($check['statusCode']) && $check['statusCode']=="00")
            {
                $contact->update([
                    'status' => $check['statusMessage']
                ]);
            }
        }
        return redirect()->route('staff.pembayaran.show',$contact->id)->with(['success'=>'Status Pembayaran Sudah Update']);
    }

    public function approve(Contact $contact)
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
        $contact->update([
            'tiket' => $tiket
        ]);

        $wa = new WaBlast;
        $message = "Terima kasih $contact->nama_pendaftar ($contact->alamat) telah melakukan pembayaran PPDB Malhikdua melalui $contact->tipe_pembayaran";
        $message .= "\nBerikut adalah tiket pengisian formulir anda : $tiket";
        $message .= "\nGunakan tiket ini untuk mengisi/mengedit formulir PPDB hingga lengkap.";
        $message .= "\nFormulir PPDB di ".route('login')." (ONLINE)";
        $message .= "\nManfaatkan tombol SAVE untuk menyimpan isian formulir.";
        $message .= "\nJika sudah, klik tombol VERIFIKASI BERKAS/PENDAFTARAN untuk diperiksa petugas.";
        $wa->send_text("62".$contact->no_wa,$message);

        // WaBlast::send("+62".$contact->no_wa,$message);

        return redirect()->route('staff.pembayaran.show',$contact->id)->with(['success'=>'Pendaftaran berhasil di approve']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $contact = Contact::findOrFail($id);
        $user = User::where('email',$contact->no_wa)->first();
        if(!empty($user))
            $user->delete();
        $contact->delete();
        return redirect()->route('staff.pembayaran.index')->with(['success'=>'Pembayaran berhasil di hapus']);
    }
}
