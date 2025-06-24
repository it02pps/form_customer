<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormCustomerController as FormCustomer;
use App\Http\Controllers\APIStorageController as APIStorage;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PreviewPdfController;
use App\Models\IdentitasPerusahaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return redirect('/form-customer');
});
Route::get('/form-customer', [FormCustomer::class, 'menu'])->name('form_customer.menu');
Route::get('/testing', function () {
    return view('customer.menu2');
});

// Login
Route::get('/form-customer/panel/login', [LoginController::class, 'index'])->name('form_customer.login');
Route::post('/form-customer/panel/login-store', [LoginController::class, 'login'])->name('form_customer.login.store');
Route::get('/form-customer/panel/lupa-password', [LoginController::class, 'lupa_password'])->name('form_customer.lupa_password');

// View Badan Usaha
Route::get('/form-customer/{menu}/{status}/{status2?}/{param?}', [FormCustomer::class, 'view_badan_usaha'])->where('menu', 'badan-usaha|perseorangan')->where('status', 'customer-baru|customer-lama')->where('status2', 'pengkinian-data|cabang-baru')->name('form_customer.view_badan_usaha');

// View Perseorangan
// Route::get('/form-customer/{menu}/{status}/{status2?}/{param?}', [FormCustomer::class, 'view_perseorangan'])->where('menu', 'perseorangan')->where('status', 'customer-baru|customer-lama')->where('status2', 'pengkinian-data|cabang-baru')->name('form_customer.view_perseorangan');

Route::get('/form-customer/{menu}/{status}/{status2?}/{param?}/check', [FormCustomer::class, 'pengkinian'])->where('menu', 'badan-usaha|perseorangan')->where('status', 'customer-baru|customer-lama')->where('status2', 'pengkinian-data|cabang-baru')->name('form_customer.pengkinian');

Route::post('/form-customer/{menu}/store', [FormCustomer::class, 'store'])->name('form_customer.store');
Route::get('/form-customer/{menu}/detail', [FormCustomer::class, 'detail'])->name('form_customer.detail');
Route::post('/form-customer/{menu}/detail/upload/{id}', [FormCustomer::class, 'upload_pdf'])->name('form_customer.upload_pdf');
Route::get('/form-customer/{menu}/pdf/{id}', [FormCustomer::class, 'download_pdf'])->name('form_customer.pdf');

// Get data select
Route::get('/form-customer/select/{menu}/{id}', [FormCustomer::class, 'select'])->name('form_customer.select');

Route::middleware('web')->group(function () {
    Route::get('/internal/panel', [HomeController::class, 'index'])->name('home');
    Route::get('/internal/panel/table', [HomeController::class, 'datatable'])->name('home.datatable');
    Route::get('/internal/panel/detail/{id}', [HomeController::class, 'detail'])->name('home.detail');
    Route::post('/internal/panel/edit-store', [HomeController::class, 'edit_store'])->name('home.edit_store');
    Route::get('/internal/panel/edit/{id}', [HomeController::class, 'edit'])->name('home.edit');
    Route::get('/internal/panel/get-pdf/{id}', [HomeController::class, 'getPdf'])->name('home.getPdf');
    Route::get('/internal/panel/select/{id}', [HomeController::class, 'select'])->name('home.select');
    Route::get('/internal/panel/delete-cust', [HomeController::class, 'hapusCustomer'])->name('home.delete');

    // Update profil & Password
    Route::post('/internal/panel/update-profil', [HomeController::class, 'update_profil'])->name('home.update_profil');
    Route::post('/internal/panel/forgot-password', [HomeController::class, 'forgot_password'])->name('home.forgot_password');
});
