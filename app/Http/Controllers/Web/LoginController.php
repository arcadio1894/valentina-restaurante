<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller{
    public function __construct(){
        $this->middleware('guest:customer')->except('logout');
    }

    public function showLoginForm(){
    	return view('web.auth.login');
    }

    public function login(Request $request){
        //dd(bcrypt($request['password']));
    	$this->validate($request,[
    		'email'=>'required|email',
    		'password'=>'required|min:6'
    	]);

    	if(Auth::guard('customer')->attempt(['email'=> $request->email,'password'=>$request->password],
            false, false
		)){
    		return redirect()->intended(route('web.home'));
		}
		return redirect()->back()->withInpput($request->only('email','remember'));
    }

    public function logout(){
    	Auth::guard('customer')->logout();

    	return redirect()->route('web.home');
    }
}
