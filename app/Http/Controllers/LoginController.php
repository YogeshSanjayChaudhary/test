<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

	public function index() {
		return view('login');
	}

	/*After login request*/

	public function postLogin(LoginRequest $request) {
		$credentials = $request->only('username', 'password');
		$credentials['status'] = 'active';
		if (Auth::attempt($credentials, true)) {
			$user = Auth::user();
			if ($user->user_type == 'admin') {
				return redirect('dashboard');
			} else {
				\Session::flash('error', 'Invalid Username/Password');
				return redirect()->back()->withInput();
			}
		} else {
			\Session::flash('error', 'Invalid Username/Password');
			return redirect()->back()->withInput();
		}
	}

	public function logout() {
		auth()->logout();
		\Session::flush();
		return redirect('/');
	}
}
