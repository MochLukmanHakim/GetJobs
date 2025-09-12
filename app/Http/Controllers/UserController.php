<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CompanyProfile;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(){
        return view('login');
    }

    public function signup(){
        return view('registration');
    }

    public function logincheck(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if(Auth::attempt($credentials)){ 
            return redirect()->route('dashboard');
        }
        
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function registercheck(Request $request){
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Hash password dan set userType
        $validation['password'] = bcrypt($validation['password']);
        $validation['userType'] = 'user';

        $user = User::create($validation);
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function godashboard(){
        if(Auth::check() && Auth::user()->userType== 'admin'){
            return view('admin.dashboard');
        }
        else if(Auth::check() && Auth::user()->userType== 'perusahaan'){
            $pekerjaan = Pekerjaan::orderBy('created_at', 'desc')->take(5)->get();
            return view('dashboard', compact('pekerjaan'));
        }
        else if(Auth::check() && Auth::user()->userType== 'user'){
            return view('beranda');
        }
        
        return redirect()->route('login');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
