<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    // protected $redirectTo = '/panel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    public function login(Request $request) {
        // dd($request->all());
        try {
            if(Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                // dd(true);
                return redirect()->route('home');
            } else {
                // dd(false);
                return redirect()->back()->withErrors(['error' => 'Username atau password salah']);
            }
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi Kesalahan']);
        }
    }

    public function index() {
        return view('auth.loginfix');
    }

    public function lupa_password() {
        return view('auth.lupa_password');
    }
}
