<?php

namespace App\Http\Controllers\Auth;

use Authy\AuthyApi;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    // public function doLogin(Request $request)
    // {
    //     $authy_api = new AuthyApi(getenv('AUTHY_KEY'));
    //     if(session('phone') != "" && session('user') != "")
    //     {
    //         $phone = session('phone');
    //         if($phone[0] == '0' || $phone == '+')
    //             $phone = substr($phone,1);
    //         $user = User::where('email',$phone)->first();
    //         $verification = $authy_api->verifyToken(session('user')->id(), $request->otp);
    //         if ($verification->ok() && $user) {
    //             Auth::login($user);
    //         }
    //         session()->forget('phone');
    //         session()->forget('user');
    //         return redirect('/login');
    //     }
    //     $phone = $request->phone;
    //     if($phone == ""){
    //         session()->flush();
    //         return redirect('/login');
    //     }
    //     $user = Contact::where('no_wa',$phone)->first();
    //     if($user)
    //     {
    //         $user = User::where('email',$phone)->first();
    //         $user = $authy_api->registerUser($user->email, $phone, 62); // email, cellphone, country_code

    //         if ($user->ok()) {
    //             $sms = $authy_api->requestSms($user->id());

    //             if ($sms->ok()) {
    //                 session(['phone'=>$phone]);
    //                 session(['user'=>$user]);
    //                 return redirect('/login');
    //             }
    //         }
    //     }
    //     return redirect('/login')->with(['error'=>'Nomor HP '.$phone.' tidak terdaftar']);
    // }

    public function doLogin(Request $request)
    {
        $contact = Contact::where('tiket',$request->tiket)->first();
        if($contact)
        {
            $user = User::where('email',$contact->no_wa)->first();
            if($user)
            {
                Auth::login($user);
                return redirect('/home');
            }
        }
        return redirect('/login')->with(['error'=>'Tiket '.$request->tiket.' tidak ditemukan']);
    }
}
