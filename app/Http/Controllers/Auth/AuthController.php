<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login(){
        if(Session::get('userLogin')){
            return redirect()->route('admin.blogposts.index');
        }
        return view('auth.login');
    }
    public  function dashboard(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            Session::put('userLogin', 'user_log_in');
            return redirect()->route('admin.blogposts.index');
        }
        else{
            return redirect()->back();
        }
    }
    public function logout(){
        if (Auth::check()) {
            Session::forget('userLogin');
            Auth::logout();
            return redirect()->route('login');
        }
        return redirect()->back();
    }
}
