<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CompanyProfile;
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
    }

    public function registercheck(Request $request){
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create($validation);
        Auth::login($user);

        return redirect()->route('login');
    }

    public function godashboard(){
        if(Auth::check() && Auth::user()->userType== 'admin'){
            return view('admin.dashboard');
        }
        else if(Auth::check() && Auth::user()->userType== 'perusahaan'){
            return view('dashboard');
        }
        else if(Auth::check() && Auth::user()->userType== 'pelamar'){
            return view('user.dashboard');
        }
        else{
            return redirect()->route('login');
        }
    }

    public function companyView(){
        if(Auth::check() && Auth::user()->userType == 'perusahaan'){
            $companyProfile = CompanyProfile::where('user_id', Auth::id())->first();
            return view('company-view', compact('companyProfile'));
        }
        return redirect()->route('login');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
