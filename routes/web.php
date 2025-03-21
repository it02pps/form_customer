<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormCustomerController as FormCustomer;
use App\Http\Controllers\APIStorageController as APIStorage;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PreviewPdfController;
use Illuminate\Support\Facades\Auth;

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
Route::get('/form-customer/{menu}', [FormCustomer::class, 'index'])->name('form_customer.index');
Route::post('/form-customer/{menu}/store', [FormCustomer::class, 'store'])->name('form_customer.store');
Route::get('/form-customer/{menu}/detail', [FormCustomer::class, 'detail'])->name('form_customer.detail');
Route::post('/form-customer/{menu}/detail/upload/{id}', [FormCustomer::class, 'upload_pdf'])->name('form_customer.upload_pdf');
Route::get('/form-customer/{menu}/pdf/{id}', [FormCustomer::class, 'download_pdf'])->name('form_customer.pdf');

// Get data select
Route::get('/select/{id}', [FormCustomer::class, 'select'])->name('form_customer.select');
Route::get('/form-customer/search/{keyword}', [FormCustomer::class, 'search'])->name('form_customer.search');

// Login
Route::get('/form-customer/panel/login', [LoginController::class, 'index'])->name('form_customer.login');
Route::post('/form-customer/panel/login-store', [LoginController::class, 'login'])->name('form_customer.login.store');
Route::get('/form-customer/panel/lupa-password', [LoginController::class, 'lupa_password'])->name('form_customer.lupa_password');

Route::middleware('web')->group(function () {
    Route::get('/internal/panel', [HomeController::class, 'index'])->name('home');
    Route::get('/internal/panel/table', [HomeController::class, 'datatable'])->name('home.datatable');
    Route::get('/internal/panel/detail/{id}', [HomeController::class, 'detail'])->name('home.detail');
    Route::post('/internal/panel/edit-store', [HomeController::class, 'edit_store'])->name('home.edit_store');
    Route::get('/internal/panel/edit/{id}', [HomeController::class, 'edit'])->name('home.edit');
    Route::get('/internal/panel/get-pdf/{id}', [HomeController::class, 'getPdf'])->name('home.getPdf');
    Route::get('/internal/panel/select/{id}', [HomeController::class, 'select'])->name('home.select');

    // Update profil & Password
    Route::post('/internal/panel/update-profil', [HomeController::class, 'update_profil'])->name('home.update_profil');
    Route::post('/internal/panel/forgot-password', [HomeController::class, 'forgot_password'])->name('home.forgot_password');
});
