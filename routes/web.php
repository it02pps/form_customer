<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormCustomerController as FormCustomer;
use App\Http\Controllers\APIStorageController as APIStorage;

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

Route::get('/', [FormCustomer::class, 'index'])->name('form_customer.index');
Route::post('/store', [FormCustomer::class, 'store'])->name('form_customer.store');
Route::get('/detail', [FormCustomer::class, 'detail'])->name('form_customer.detail');
Route::post('/confirmation', [FormCustomer::class, 'confirmation'])->name('form_customer.confirmation');

// API URL
Route::post('/api/storage', [APIStorage::class, 'store'])->name('api_storage_store');

// Get data select
Route::get('/select/{id}', [FormCustomer::class, 'select'])->name('form_customer.select');
