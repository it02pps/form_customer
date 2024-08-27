<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormCustomerController extends Controller
{
    public function index() {
        // return view('');
    }

    public function store(Request $request) {
        try {
            
        } catch(\Exception $e) {
            return ['status' => false, 'error' => 'Terjadi kesalahan'];
        }
    }
}
