<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {
	public function search(Request $request) {
		$search = $request->all();
		if (isset($search['search_text'])) {
			$search_text = $search['search_text'];
		} else {
			$search_text = '';
		}

		if ($search_text !== null && $search_text !== '') {
			$user = User::where('user_type', 'user')->where('first_name', 'like', '%' . $request->input('search_text') . '%')->paginate(20);
		} else {
			$user = User::where('user_type', 'user')->orderBy('id', 'desc')->paginate(20);
		}
		$data['sidebar_user'] = '1';
		$data['user'] = $user;
		$data['search_text'] = $search_text;
		return view('user/index', $data);
	}

	public function index() {
		$data['sidebar_user'] = '1';
		$data['user'] = User::where('user_type', 'user')->orderBy('id', 'desc')->paginate(20);
		$data['search_text'] = '';
		return view('user/index', $data);
	}

	public function getAdd() {
		$data['sidebar_user'] = '1';
		return view('user/add', $data);
	}

	public function postAdd(AddUserRequest $request) {
		$user = new User();
		$user->fill($request->input());
		$user->save();
		\Session::flash('success', 'User successfully added');
		return redirect('user');
	}

	public function getEdit($id, $last_page) {
		$data['sidebar_user'] = '1';
		$data['user'] = User::find($id);
		$data['last_page'] = $last_page;
		return view('user/edit', $data);
	}

	public function postEdit(EditUserRequest $request, $id) {
		$user = User::find($id);
		$user->fill($request->input());
		$user->save();
		\Session::flash('success', 'User successfully Updated');
		return redirect('user?page=' . $request->input('last_page'));
	}

	public function destroy($id) {
		$user = User::find($id);
		$user->save();

		$user->delete();
		\Session::flash('success', 'User removed successfully');
		return redirect('user');
	}

}
