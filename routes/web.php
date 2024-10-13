<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormCustomerController as FormCustomer;
use App\Http\Controllers\APIStorageController as APIStorage;
use App\Http\Controllers\HomeController;
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
Route::get('/form-customer', [FormCustomer::class, 'index'])->name('form_customer.index');
Route::get('/form-customer/{menu}', [FormCustomer::class, 'view'])->name("form_customer.view");
Route::post('/form-customer/{menu}/store', [FormCustomer::class, 'store'])->name('form_customer.store');
Route::get('/form-customer/{menu}/detail', [FormCustomer::class, 'detail'])->name('form_customer.detail');
Route::post('/form-customer/{menu}/confirmation', [FormCustomer::class, 'confirmation'])->name('form_customer.confirmation');
Route::get('/form-customer/{menu}/pdf/{id}', [FormCustomer::class, 'download_pdf'])->name('form_customer.pdf');

// API URL
Route::post('/api/storage', [APIStorage::class, 'store'])->name('api_storage_store');

// Get data select
Route::get('/select/{id}', [FormCustomer::class, 'select'])->name('form_customer.select');

Route::middleware('web')->group(function() {
    Route::get('/panel', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/panel/detail', [HomeController::class, 'detail'])->name('home.detail');
});
