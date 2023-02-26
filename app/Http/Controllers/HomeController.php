<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use App\Models\Duitku;
use App\Models\WaBlast;
use App\Models\Tripay;
use App\Models\Contact;
use App\Models\DataIbu;
use App\Models\DataAyah;
use App\Models\DataDiri;
use App\Models\DataWali;
use App\Models\Formulir;
use App\Models\AlamatAsal;
use Illuminate\Http\Request;
use App\Models\DataPendidikan;
use App\Models\OneTimePassword;
use App\Models\BerkasPendaftaran;
use App\Models\DataRencanaSekolah;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function home()
    {
        return view('home');
    }

    public function paymentChannel()
    {
        $tripay = new Tripay(getenv('TRIPAY_PRIVATE_KEY'), getenv('TRIPAY_API_KEY'));
        // return $tripay->curlAPI($tripay->URL_channelPp,'','GET');
        return $tripay->curlAPI($tripay->URL_channelMp,'','GET');
        // return view('payment-gateway');
    }

    public function paymentGateway()
    {
        $channels = $this->paymentChannel();
        return view('payment-gateway',[
            'channels' => $channels
        ]);
    }

    public function siswa()
    {

        $siswa = DataDiri::get();

        $data = [
            'siswa' => $siswa
        ];
        return view('siswa', $data);
    }

    public function kartu()
    {
        $path = 'images/kop.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $kop = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $formulir = auth()->user()->contact->formulir;
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('download.kartu',compact('kop','formulir')));

        $dompdf->render();

        $dompdf->stream('Kartu Ujian Masuk.pdf');

        // return view('kartu');
    }

    public function pernyataan()
    {

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('download.pernyataan',['formulir'=>auth()->user()->contact->formulir]));

        $dompdf->render();

        $dompdf->stream('Surat Pernyataan.pdf');

        // return view('pernyataan');
    }

    public function isian()
    {
        $formulir = auth()->user()->contact->formulir;
        $age = (new Carbon($formulir->diri->tanggal_lahir))->age;
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('download.isian',compact('formulir','age')));

        $dompdf->render();


        $dompdf->stream('biodata.pdf');
    }

    public function faktur()
    {
        $path = 'images/faktur.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $faktur = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $formulir = auth()->user()->contact->formulir;
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('download.faktur',compact('formulir','faktur')));

        $dompdf->render();


        $dompdf->stream('faktur.pdf');
    }

    public function pembayaran()
    {
        $data = [
            'contacts' => Contact::get()
        ];
        return view('pembayaran', $data);
    }

    public function welcome(Request $request)
    {
        $duitku = [
            'VC' => 'Credit Card (Visa / Master)',
            'BK' => 'BCA KlikPay',
            'M1' => 'Mandiri Virtual Account',
            'BT' => 'Permata Bank Virtual Account',
            'B1' => 'CIMB Niaga Virtual Account',
            'A1' => 'ATM Bersama',
            'I1' => 'BNI Virtual Account',
            'VA' => 'Maybank Virtual Account',
            'FT' => 'Ritel',
            'OV' => 'OVO',
        ];
        if ($request->isMethod('post')) {

            if($request->has('reset'))
            {
                session()->forget('otp');
                session()->forget('request');
                return redirect()->back();
            }
            // check email and phone exists
            $check_contact = Contact::where('email',$request->email)->orwhere('no_wa',$request->no_wa)->exists();
            $check_user = User::where('email',$request->no_wa)->exists();
            if($check_contact || $check_user)
                return redirect()->back()->with(['contact_exists' => 'Email atau No. Whatsapp sudah terdaftar']);

            if ($request->has('verificated')) {
                unset($request['verificated']);
                unset($request['otp']);
                unset($request['user_sms']);
                
                $contact = new Contact();
                $request->merge(['status'=>'']);
                $amount = $request->domisili == 'Warga Benda' || $request->alumni == 'Ya' ? 130000 : 155000;
                $additional_message = "";
                // bayar dulu
                if($request->payment_gateway == 'tripay')
                {
                    $privateKey = getenv('TRIPAY_PRIVATE_KEY');
                    $merchantCode = getenv('TRIPAY_MERCHANT_CODE');
                    $merchantRef = getenv('TRIPAY_MERCHANT_REF');
                    
                    $signature = hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey);
                    $data = [
                        'method'            => $request->tipe_pembayaran,
                        'merchant_ref'      => $merchantRef,
                        'amount'            => $amount,
                        'customer_name'     => $request->nama_pendaftar,
                        'customer_email'    => $request->email,
                        'customer_phone'    => $request->no_wa,
                        'callback_url'      => route('tripay-callback'),
                        'order_items'       => [
                            [
                                'sku'       => 'PPDB',
                                'name'      => 'PPDB Malhikdua',
                                'price'     => $amount,
                                'quantity'  => 1
                            ]
                        ],
                        'signature'         => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
                    ];

                    $tripay = new Tripay($privateKey, getenv('TRIPAY_API_KEY'));
                    $response = $tripay->curlAPI($tripay->URL_transMp,$data,'POST');
                    if($response['success'] == false)
                        return redirect()->back();
                    $response_data = $response['data'];

                    $request->merge([
                        'status' => $response_data['status'],
                        'tiket' => '',
                        'payment_gateway' => $request->payment_gateway,
                        'payment_reference' => $response_data['reference'],
                        'payment_code' => $response_data['pay_code'],
                        'checkout_url' => $response_data['checkout_url'],
                        'expired_time' => $response_data['expired_time'],
                    ]);
                }
                elseif($request->payment_gateway == 'duitku')
                {
                    $duitku_pay = new Duitku;
                    $result = $duitku_pay->pay($amount, $request->tipe_pembayaran, [
                        'name' => $request->nama_pendaftar,
                        'email' => $request->email,
                        'phone' => $request->no_wa
                    ]);

                    // return $result;

                    $request->merge([
                        'status' => $result['statusMessage'],
                        'tiket' => '',
                        'tipe_pembayaran' => $duitku[$request->tipe_pembayaran],
                        'payment_gateway' => $request->payment_gateway,
                        'payment_reference' => $result['reference'],
                        'payment_code' => $result['merchantOrderId'],
                        'checkout_url' => $result['paymentUrl'],
                        'expired_time' => '',
                    ]);

                }
                else
                {
                    $additional_message = $request->payment_gateway == 'transfer bank' ? '\nNo. Rekening : '.getenv('NO_REKENING')." - ".getenv('NAMA_BANK')."\nA/N ".getenv('NAMA_AKUN'): "";
                    $additional_message .= "\nMohon konfirmasi pembayaran dengan mereplay wa ini. Konfirmasi manual ini hanya berlaku utk pembayaran transfer dan OTS.";

                    $request->tipe_pembayaran = $request->payment_gateway;
                    $request->merge([
                        'status' => '',
                        'tiket' => '',
                        'tipe_pembayaran' => $request->tipe_pembayaran,
                        'payment_gateway' => $request->payment_gateway,
                        'payment_reference' => '',
                        'payment_code' => strtotime('now'),
                        'checkout_url' => route('thankyou'),
                        'expired_time' => '',
                    ]);
                }

                
                if ($nc = $contact->create(array_merge($request->post(),['biaya_pembayaran'=>$amount]))) {
                    $user = new User();

                    if ($user->create([
                        'email' => $nc->no_wa,
                        'name' => $nc->nama_pendaftar,
                        'password' => bcrypt($nc->no_wa)
                    ])) {
                        $contact = $nc;
                        $message = "Halo, $contact->nama_pendaftar ($contact->alamat), \nBerikut ini adalah data registrasi anda:";
                        $message .= "\nID Transaksi : $contact->payment_code";
                        $message .= "\nTotal : Rp. ".number_format($contact->biaya_pembayaran);
                        $message .= "\nSilahkan melakukan pembayaran melalui $contact->tipe_pembayaran untuk mendapatkan tiket pengisian formulir PPDB.";
                        $message .= $additional_message;
                        $message .= "\nTerima Kasih";
                        $message .= "\n\nCek Status PPDB anda di ".route('check');

                        // WaBlast::send("+62".$contact->no_wa,$message);
                        
                        $wa = new WaBlast;
                        $wa->send_text("62".$contact->no_wa,$message);

                        // if($request->payment_gateway == 'tripay')
                        session()->forget('otp');
                        session()->forget('request');
                        session()->forget('verification');

                        return redirect()->to($nc->checkout_url);
                    }
                }
            } else {
                if (!$request->has('otp')) {
                    // send otp section
                    $otp = new OneTimePassword;
                    $kode = $otp->generate(6);
                    $otp = $otp->create([
                        'no_wa'  => $request->no_wa,
                        'email'  => $request->email,
                        'kode'   => $kode,
                        'status' => 'SEND', 
                        'expired_at' => Carbon::now()->addMinutes(4)->format('Y-m-d H:i:s'), 
                    ]);
                    $message = "Kode OTP Anda adalah ".$kode;

                    // WaBlast::send("+62".$request->no_wa,$message);
                    $wa = new WaBlast;
                    $wa->send_text("62".$request->no_wa,$message);
                    session([
                        'otp' => $otp,
                        'request' => $request->input()
                    ]);

                    return redirect()->back();
                } else {
                    // OTP verification
                    $otp = new OneTimePassword;
                    $kode = $otp->generate(6);
                    $otp = OneTimePassword::where('no_wa',$request->no_wa)
                                        ->where('email',$request->email)
                                        ->where('kode',$request->otp)
                                        ->where('status','SEND')
                                        ->whereDate('expired_at','<=',Carbon::now()->format('Y-m-d H:i:s'))
                                        ->first();
                    if(!empty($otp))
                    {
                        $otp->update(['status'=>'USED']);
                        session()->forget('request');
                        session([
                            'verification' => $otp,
                            'request' => $request->input()
                        ]);
                        return redirect()->back();
                    }
                    else
                    {
                        return redirect()->back()->with('error','Kode OTP tidak ditemukan atau sudah kadaluarsa');
                    }
                }
            }
        }

        $tripay = $this->paymentChannel();

        return view('welcome',compact('duitku','tripay'));
    }

    public function tiket(Request $request)
    {
        if ($request->isMethod('post')) {
            $contact = Contact::where('tiket', $request->post('tiket'))->first();
            if ($contact) {
                return redirect()->to('formulir')->with(['contact' => $contact]);
            }
            return redirect()->back();
        }

        return view('tiket');
    }

    public function daftarUlang(Request $request)
    {
        $labels = [
            '' => '',
            'Sudah Terkonfirmasi' => 'success',
            'Menunggu Konfirmasi' => 'warning',
        ];

        $formulir = auth()->user()->contact->formulir;
        if ($request->isMethod('post')) {
            $formulir->daftarUlang()->create([
                'jenis_pembayaran'=>$request->jenis_pembayaran,
                'metode_pembayaran'=>$request->metode_pembayaran,
                'status'=>'Menunggu Konfirmasi',
            ]);
        }

        return view('daftar-ulang',compact('formulir','labels'));
    }

    public function formulir(Request $request)
    {
        $contact = auth()->user()->contact;
        if($contact->formulir && in_array($contact->formulir->status,['Dikirim','Diterima']))
            return redirect('/home');
        if ($request->isMethod('post')) {
            // check is whatsapp number is exists or not
            $check_contact = Contact::where('no_wa',$request->no_wa)->where('id','<>',$contact->id)->exists();
            if($check_contact)
                return redirect()->back()->with('error','Nomor WA Sudah terdaftar');
            $contact->no_wa = $request->no_wa;
            if($contact->formulir)
            {
                // file validation
                $request->validate([
                    'upload_kk' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf,doc,docx|max:5024',
                    'upload_akte' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf,doc,docx|max:5024',
                    'upload_izajah' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf,doc,docx|max:5024',
                    'upload_shun' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf,doc,docx|max:5024',
                    'upload_kartu_pemerintah' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf,doc,docx|max:5024',
                    'upload_ktp_ayah' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf,doc,docx|max:5024',
                    'upload_ktp_ibu' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf,doc,docx|max:5024',
                    'upload_kip' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf,doc,docx|max:5024',
                    'upload_kks' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf,doc,docx|max:5024',
                    'upload_pkh' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf,doc,docx|max:5024',
                ]);
                DB::beginTransaction();
                try {
                    $contact->update(['no_wa'=>$request->no_wa]);
                    auth()->user()->update(['email'=>$request->no_wa]);
                    $formulir = $contact->formulir;
    
                    $rencana = $formulir->data_rencana_sekolah;
                    $diri = $formulir->data_diri;
                    $pendidikan = $formulir->data_pendidikan;
                    $asal = $formulir->alamat_asal;
                    $ayah = $formulir->ayah;
                    $ibu = $formulir->ibu;
                    if($formulir->wali)
                        $wali = $formulir->wali;
                    else
                        $wali = (new DataWali)->create(array_merge(['formulir_id' => $formulir->id], $request->post('wali')));
                    if (
                        $rencana->update($request->post('rencana')) &&
                        $diri->update($request->post('diri')) &&
                        $pendidikan->update($request->post('pendidikan')) &&
                        $asal->update($request->post('asal')) &&
                        $ayah->update($request->post('ayah')) &&
                        $ibu->update($request->post('ibu')) &&
                        $wali->update($request->post('wali'))
                    ) {
                        $berkas = $formulir->berkas_pendaftaran;
                        $berkas->update($request->post('berkas'));

                        if($request->file('upload_kk'))
                        {
                            $kk = $request->file("upload_kk")->store("berkas");
                            $berkas->update(['upload_kk' => $kk]);
                        }
                        if($request->file('upload_akte'))
                        {
                            $akte = $request->file("upload_akte")->store("berkas");
                            $berkas->update(['upload_akte' => $akte]);
                        }
                        if($request->file('upload_ijazah'))
                        {
                            $ijazah = $request->file("upload_ijazah")->store("berkas");
                            $berkas->update(['upload_ijazah' => $ijazah]);
                        }
                        if($request->file('upload_shun'))
                        {
                            $shun = $request->file("upload_shun")->store("berkas");
                            $berkas->update(['upload_shun' => $shun]);
                        }
                        if($request->file('upload_kartu_pemerintah'))
                        {
                            $kartu_pemerintah = $request->file("upload_kartu_pemerintah")->store("berkas");
                            $berkas->update(['upload_kartu_pemerintah' => $kartu_pemerintah]);
                        }

                        if($request->file("upload_ktp_ayah")){
                            $ktp_ayah = $request->file("upload_ktp_ayah")->store("berkas");
                            $berkas->update(['upload_ktp_ayah' => $ktp_ayah]);
                        }
                        
                        if($request->file("upload_ktp_ibu")){
                            $ktp_ibu = $request->file("upload_ktp_ibu")->store("berkas");
                            $berkas->update(['upload_ktp_ibu' => $ktp_ibu]);
                        }

                        if($request->file("upload_kip")){
                            $kip = $request->file("upload_kip")->store("berkas");
                            $berkas->update(['upload_kip' => $kip]);
                        }
                        
                        if($request->file("upload_kks")){
                            $kks = $request->file("upload_kks")->store("berkas");
                            $berkas->update(['upload_kks' => $kks]);
                        }
                        
                        if($request->file("upload_pkh")){
                            $pkh = $request->file("upload_pkh")->store("berkas");
                            $berkas->update(['upload_pkh' => $pkh]);
                        }
                        DB::commit();
                    }
                } catch (\Exception $e) {
                    DB::rollback();
                }
            }
            else
            {
                // file validation
                $request->validate([
                    'upload_kk' => 'required|image|max:5024',
                    'upload_akte' => 'required|image|max:5024',
                    'upload_izajah' => 'nullable|image|max:5024',
                    'upload_shun' => 'nullable|image|max:5024',
                    'upload_kartu_pemerintah' => 'nullable|max:1024',
                    'upload_ktp_ayah' => 'nullable|max:1024',
                    'upload_ktp_ibu' => 'nullable|max:1024',
                    'upload_kip' => 'nullable|max:1024',
                    'upload_kks' => 'nullable|max:1024',
                    'upload_pkh' => 'nullable|max:1024',
                ]);
                DB::beginTransaction();
                try {
                    $formulir = new Formulir();
    
                    if ($nf = $formulir->create(['contact_id' => $contact->id])) {
                        $tiket = $nf->id;
                        if($tiket < 10)
                            $tiket = "000".$tiket;
                        elseif($tiket < 100)
                            $tiket = "00".$tiket;
                        elseif($tiket < 1000)
                            $tiket = "0".$tiket;
                        
                        $tiket = "MDTKT".$tiket;

                        $nf->update(['kode_formulir'=>$tiket]);

                        $rencana = new DataRencanaSekolah();
                        $diri = new DataDiri();
                        $pendidikan = new DataPendidikan();
                        $asal = new AlamatAsal();
                        $ayah = new DataAyah();
                        $ibu = new DataIbu();
                        $wali = new DataWali();
    
                        if (
                            $rencana->create(array_merge(['formulir_id' => $nf->id], $request->post('rencana'))) &&
                            $diri->create(array_merge(['formulir_id' => $nf->id], $request->post('diri'))) &&
                            $pendidikan->create(array_merge(['formulir_id' => $nf->id], $request->post('pendidikan'))) &&
                            $asal->create(array_merge(['formulir_id' => $nf->id], $request->post('asal'))) &&
                            $ayah->create(array_merge(['formulir_id' => $nf->id], $request->post('ayah'))) &&
                            $ibu->create(array_merge(['formulir_id' => $nf->id], $request->post('ibu'))) &&
                            $wali->create(array_merge(['formulir_id' => $nf->id], $request->post('wali')))
                        ) {
                            $kk = "";
                            $akte = "";
                            if($request->file('upload_kk'))
                                $kk = $request->file("upload_kk")->store("berkas");
                            if($request->file('upload_akte'))
                                $akte = $request->file("upload_akte")->store("berkas");
                            $ijazah = "";
                            if($request->file('upload_ijazah'))
                                $ijazah = $request->file("upload_ijazah")->store("berkas");
                            $shun = "";
                            if($request->file('upload_shun'))
                                $shun = $request->file("upload_shun")->store("berkas");
                            $kartu_pemerintah = "";
                            if($kartu_pemerintah = $request->file("upload_kartu_pemerintah"))
                                $kartu_pemerintah = $request->file("upload_kartu_pemerintah")->store("berkas");

                            $ktp_ayah = "";
                            if($request->file("upload_ktp_ayah"))
                                $ktp_ayah = $request->file("upload_ktp_ayah")->store("berkas");
                            
                            $ktp_ibu = "";
                            if($request->file("upload_ktp_ibu"))
                                $ktp_ibu = $request->file("upload_ktp_ibu")->store("berkas");

                            $kip = "";
                            if($request->file("upload_kip"))
                                $kip = $request->file("upload_kip")->store("berkas");

                            $kks = "";
                            if($request->file("upload_kks"))
                                $kks = $request->file("upload_kks")->store("berkas");

                            $pkh = "";
                            if($request->file("upload_pkh"))
                                $pkh = $request->file("upload_pkh")->store("berkas");

                            if ($kk && $akte) {
    
                                $berkas = new BerkasPendaftaran();
    
                                if ($berkas->create(array_merge($request->post('berkas'), [
                                    'formulir_id' => $nf->id,
                                    'upload_kk' => $kk,
                                    'upload_akte' => $akte,
                                    'upload_ijazah' => $ijazah,
                                    'upload_shun' => $shun,
                                    'upload_kartu_pemerintah' => $kartu_pemerintah,
                                    'upload_ktp_ayah' => $ktp_ayah,
                                    'upload_ktp_ibu' => $ktp_ibu,
                                    'upload_kip' => $kip,
                                    'upload_kks' => $kks,
                                    'upload_pkh' => $pkh,
                                ]))) {
                                    DB::commit();
                                    // $wa = new WaBlast;
                                    // $wa->send_text("62".$contact->no_wa,$message);
                                }
                            }
                        }
                    }
                } catch (\Exception $e) {
                    DB::rollback();
                    throw($e);
                    // something went wrong
                }
            }
            $contact->save();
            return redirect('/home')->with(['success'=>'Berhasil edit formulir']);
        }
        if($contact->formulir)
        {
            $formulir = $contact->formulir()->with(['alamat_asal','berkas_pendaftaran','ayah','ibu','wali','data_diri','data_pendidikan','data_rencana_sekolah'])->first();
            $labels = [
                'diri' => [
                    'nama_lengkap',
                    'alamat',
                    'tempat_tinggal',
                    'tanggal_lahir',
                    'jenis_kelamin',
                    'no_kk',
                    'NIK',
                    'anak_ke',
                    'jumlah_saudara',
                    'status'
                ],
                'asal' => [
                    'alamat',
                    'rt',
                    'rw',
                    'desa_kelurahan',
                    'kecamatan',
                    'kabupaten',
                    'provinsi',
                    'kode_pos'
                ],
                'ayah' => [
                    'no_kk',
                    'nama',
                    'no_kk_ayah',
                    'status',
                    'tanggal_lahir',
                    'keadaan',
                    'pekerjaan',
                    'pendidikan',
                    'penghasilan',
                ],
                'ibu' => [
                    'no_kk',
                    'nama',
                    'no_kk_ibu',
                    'status',
                    'tanggal_lahir',
                    'keadaan',
                    'pekerjaan',
                    'pendidikan',
                    'penghasilan',
                ],
                'wali' => [
                    'nama',
                    'NIK',
                    'hubungan_dengan_pendaftar',
                    'tanggal_lahir',
                    'pekerjaan',
                    'pendidikan',
                ],
                'pendidikan' => [
                    'NISN',
                    'sekolah_asal',
                    'NPSN',
                    'angkatan_lulus',
                    'alamat'
                ],
                'rencana' => [
                    'program','spesifikasi'
                ],
                'berkas' => [
                    'no_seri_shun',
                    'no_seri_ijazah',
                    'no_peserta_un',
                    'kartu_pemerintah',
                ]
            ];
            return view('edit-formulir',compact('formulir','labels','contact'));
        }
        else
            return view('formulir',compact('contact'));
    }

    function send()
    {
        $formulir = auth()->user()->contact->formulir;
        $formulir->update([
            'status' => 'Dikirim'
        ]);
        $wa = new WaBlast;
        $message = "Selamat, Pendaftar atas nama";
        $message .= "\nNama : ".$formulir->diri->nama_lengkap;
        $message .= "\nKota : ".$formulir->asal->kabupaten;
        $message .= "\nProgram : ".$formulir->rencana->program;
        $message .= "\nSpesifikasi : ".$formulir->rencana->spesifikasi;
        $message .= "\n\nFormulir anda berhasil dikirim";
        $message .= "\n\nSilahkan check status pendaftaran pada ".route('check')." dengan kode formulir ".$formulir->kode_formulir;
        $wa->send_text("62".$formulir->contact->no_wa,$message);
        // WaBlast::send("+62".$formulir->contact->no_wa,$message);
        return redirect('/home')->with(['success'=>'Formulir sudah di kirim']);
    }

    function berkas()
    {
        return view('berkas');
    }

    function download($row)
    {
        if($row == 'Surat Pernyataan')
            return $this->pernyataan();
        if($row == 'Kartu Ujian Masuk')
            return $this->kartu();
        if($row == 'Biodata')
            return $this->isian();
        if($row == 'Faktur Pembayaran')
            return $this->faktur();
    }

    function check()
    {
        $labels = [
            '' => '',
            'Dikirim' => 'primary',
            'Ditolak' => 'danger',
            'Diterima' => 'success',
            'Lulus' => 'success',
            'Tidak Lulus' => 'danger',
        ];
        if (isset($_GET['kode'])) 
        {
            $kode = $_GET['kode'];
            $formulir = Formulir::where('kode_formulir',$kode)->first();
            if($formulir)
                return view('check.found',compact('formulir','labels'));
            return view('check.not-found',compact('kode'));
        }
        return view('check');
    }

    function thankyou()
    {
        return view('thankyou');
    }
}
