<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    //
    public function __construct(){
    	$this->middleware('guest:admin');
    }
    public function showLoginForm(){
    	return view('auth.admin-login');
    }

    public function login(Request $request){

    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:5'
    		]);

    	if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

    		return redirect()->intended(route('admin.index'));
    	}
    	return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
