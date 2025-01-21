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
Route::get('/', [FormCustomer::class, 'index'])->name('form_customer.index');
// Route::get('/showimage/{category}/{filename}', [ImageController::class, 'index'])->name("showimage.view");
Route::get('/{menu}', [FormCustomer::class, 'view'])->name("form_customer.view");
Route::post('/{menu}/store', [FormCustomer::class, 'store'])->name('form_customer.store');
Route::get('/{menu}/detail', [FormCustomer::class, 'detail'])->name('form_customer.detail');
Route::post('/{menu}/confirmation', [FormCustomer::class, 'confirmation'])->name('form_customer.confirmation');
Route::get('/{menu}/pdf/{id}', [FormCustomer::class, 'download_pdf'])->name('form_customer.pdf');

// Get data select
Route::get('/select/{id}', [FormCustomer::class, 'select'])->name('form_customer.select');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login-store', [LoginController::class, 'login'])->name('login.store');

Route::middleware('web')->group(function () {
    Route::get('/internal/panel', [HomeController::class, 'index'])->name('home');
    Route::get('/internal/panel/detail', [HomeController::class, 'detail'])->name('home.detail');
    Route::get('/internal/panel/edit/{id}', [HomeController::class, 'edit'])->name('home.edit');
    Route::post('/internal/panel/edit-store', [HomeController::class, 'edit_store'])->name('home.edit_store');
    Route::get('/internal/panel/select/{id}', [HomeController::class, 'select'])->name('home.select');

    // Update profil
    Route::post('/internal/panel/update-profil', [HomeController::class, 'update_profil'])->name('home.update_profil');

    // Fix ui
    Route::get('/internal/panel/fix', [HomeController::class, 'fixIndex'])->name('fixHome');
    Route::get('/internal/panel/fix/table', [HomeController::class, 'datatable'])->name('fixHome.datatable');
    Route::get('/internal/panel/fix/detail/{id}', [HomeController::class, 'fixDetail'])->name('fixHome.detail');
    Route::get('/internal/panel/fix/edit/testing/{id}', [HomeController::class, 'fixEdit'])->name('fixHome.edit');
});

// Fix view form customer
Route::get('/fix-form-customer/testing/menu', [FormCustomer::class, 'menuFix'])->name('form_customer.menuFix');
Route::get('/fix-form-customer/{menu}', [FormCustomer::class, 'indexBadanUsaha'])->name('form_customer.indexBadanUsaha');
Route::get('/fix-form-customer/{menu}/detail', [FormCustomer::class, 'indexDetailView'])->name('form_customer.detailView');
Route::get('/login/fix', [LoginController::class, 'loginFix'])->name('form_customer.loginFix');
Route::get('/lupa-password/fix/1', [LoginController::class, 'lupa_password'])->name('form_customer.lupa_password');
// Route::get('/fix-form-customer/perseorangan', [FormCustomer::class, 'indexPerseorangan'])->name('form_customer.indexPerseorangan');
