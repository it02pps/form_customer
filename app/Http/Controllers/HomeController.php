<?php

namespace App\Http\Controllers;

use App\Models\IdentitasPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = IdentitasPerusahaan::all();
        return view('home', compact('data'));
    }

    public function detail(Request $request) {
        $data = IdentitasPerusahaan::with('data_identitas', 'informasi_bank')->where('id', Crypt::decryptString($request->id))->first();
        return view('home_detail', compact('data'));
    }
}
