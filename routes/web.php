<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('generate', function (){
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'ok';
});

Route::get('wa-test',function(){
    $wa = new App\Models\Fonnte;
    $wa->send_text("6282369378823",'Test Pesan');
});

// Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::get('staff-login', [App\Http\Controllers\Auth\StaffLoginController::class, 'showLoginForm'])->name('staff-login-form');
Route::post('staff-login', [App\Http\Controllers\Auth\StaffLoginController::class, 'login'])->name('staff-login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'doLogin'])->name('login');
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::match(['get', 'post'], 'daftar', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');
// Route::match(['get', 'post'], 'tiket', [App\Http\Controllers\HomeController::class, 'tiket'])->name('formulir');
Route::match(['get', 'post'], 'check', [App\Http\Controllers\HomeController::class, 'check'])->name('check');
Route::get('thankyou', [App\Http\Controllers\HomeController::class, 'thankyou'])->name('thankyou');
Route::get('payment', [App\Http\Controllers\HomeController::class, 'paymentGateway'])->name('payment');
Route::get('payment-success', [App\Http\Controllers\HomeController::class, 'paymentSuccess'])->name('payment-success');
Route::post('tripay-callback', [App\Http\Controllers\CallbackController::class, 'tripay'])->name('tripay-callback');
Route::post('duitku-callback', [App\Http\Controllers\CallbackController::class, 'duitku'])->name('duitku-callback');

Route::middleware(['auth:staff'])->prefix('staff')->name('staff.')->group(function(){
    Route::get('/', [App\Http\Controllers\Staff\HomeController::class, 'index'])->name('index');
    Route::get('pembayaran/report',[App\Http\Controllers\Staff\PembayaranController::class,'report'])->name('pembayaran.report');
    Route::resource('pembayaran', App\Http\Controllers\Staff\PembayaranController::class);
    Route::get('pembayaran/check/{contact}',[App\Http\Controllers\Staff\PembayaranController::class,'check'])->name('pembayaran.check');
    Route::get('pembayaran/approve/{contact}',[App\Http\Controllers\Staff\PembayaranController::class,'approve'])->name('pembayaran.approve');
    
    Route::get('siswa/kelulusan',[App\Http\Controllers\Staff\SiswaController::class,'kelulusan'])->name('siswa.kelulusan');
    Route::get('siswa/report',[App\Http\Controllers\Staff\SiswaController::class,'report'])->name('siswa.report');
    Route::get('siswa/daftar-ulang',[App\Http\Controllers\Staff\SiswaController::class,'daftarUlang'])->name('siswa.daftar-ulang');
    Route::resource('siswa', App\Http\Controllers\Staff\SiswaController::class);
    Route::post('siswa/daftar-ulang/{formulir}',[App\Http\Controllers\Staff\SiswaController::class,'submitDaftarUlang'])->name('siswa.daftar-ulang.post');
    Route::post('siswa/daftar-ulang/verify/{daftarUlang}',[App\Http\Controllers\Staff\SiswaController::class,'verifyDaftarUlang'])->name('siswa.daftar-ulang.verify');
    Route::get('siswa/delete/{formulir}',[App\Http\Controllers\Staff\SiswaController::class,'delete'])->name('siswa.delete');
    Route::get('siswa/approve/{formulir}',[App\Http\Controllers\Staff\SiswaController::class,'approve'])->name('siswa.approve');
    Route::get('siswa/decline/{formulir}',[App\Http\Controllers\Staff\SiswaController::class,'decline'])->name('siswa.decline');
    Route::get('siswa/lulus/{formulir}',[App\Http\Controllers\Staff\SiswaController::class,'lulus'])->name('siswa.lulus');
    Route::get('siswa/gagal/{formulir}',[App\Http\Controllers\Staff\SiswaController::class,'gagal'])->name('siswa.gagal');
});

Route::middleware(['auth'])->group(function(){
    Route::match(['get', 'post'], 'formulir', [App\Http\Controllers\HomeController::class, 'formulir'])->name('formulir');
    Route::get('send', [App\Http\Controllers\HomeController::class, 'send'])->name('send');
    Route::get('home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
    Route::get('siswa', [App\Http\Controllers\HomeController::class, 'siswa'])->name('siswa');
    Route::get('pembayaran', [App\Http\Controllers\HomeController::class, 'pembayaran'])->name('pembayaran');
    // Route::get('kartu', [App\Http\Controllers\HomeController::class, 'kartu'])->name('kartu');
    // Route::get('pernyataan', [App\Http\Controllers\HomeController::class, 'pernyataan'])->name('pernyataan');
    Route::get('isian', [App\Http\Controllers\HomeController::class, 'isian'])->name('isian');
    Route::get('berkas', [App\Http\Controllers\HomeController::class, 'berkas'])->name('berkas');
    Route::match(['get','post'],'daftar-ulang', [App\Http\Controllers\HomeController::class, 'daftarUlang'])->name('daftar-ulang');
    Route::get('download/{row}', [App\Http\Controllers\HomeController::class, 'download'])->name('download');
});


