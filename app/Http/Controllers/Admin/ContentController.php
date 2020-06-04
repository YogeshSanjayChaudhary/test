<?php

namespace App\Http\Controllers\Admin;

use App\Content;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddContentRequest;
use App\Http\Requests\EditContentRequest;
use Illuminate\Http\Request;

class ContentController extends Controller {
	public function search(Request $request) {
		$search = $request->all();
		if (isset($search['search_text'])) {
			$search_text = $search['search_text'];
		} else {
			$search_text = '';
		}

		if ($search_text !== null && $search_text !== '') {
			$content = Content::where('content_id', 'like', '%' . $request->input('search_text') . '%')->paginate(20);
		} else {
			$content = Content::orderBy('id', 'desc')->paginate(20);
		}
		$data['sidebar_master'] = '1';
		$data['sidebar_content'] = '1';
		$data['content'] = $content;
		$data['search_text'] = $search_text;
		return view('content/index', $data);
	}

	public function index() {
		$data['sidebar_master'] = '1';
		$data['sidebar_content'] = '1';
		$data['content'] = Content::orderBy('id', 'desc')->paginate(20);
		$data['search_text'] = '';
		return view('content/index', $data);
	}

	public function getAdd() {
		$data['sidebar_master'] = '1';
		$data['sidebar_content'] = '1';
		return view('content/add', $data);
	}

	public function postAdd(AddContentRequest $request) {
		$content = new Content();
		$content->fill($request->input());
		$content->save();

		\Session::flash('success', 'Content successfully added');
		return redirect('content');
	}

	public function getEdit($id, $last_page) {
		$data['sidebar_master'] = '1';
		$data['sidebar_content'] = '1';
		$data['content'] = Content::find($id);
		$data['last_page'] = $last_page;
		return view('content/edit', $data);
	}

	public function postEdit(EditContentRequest $request, $id) {
		$content = Content::find($id);
		$content->fill($request->input());
		$content->save();

		\Session::flash('success', 'Content successfully Updated');
		return redirect('content?page=' . $request->input('last_page'));
	}

	public function destroy($id) {
		$content = Content::find($id);
		$content->save();

		$content->delete();
		\Session::flash('success', 'Content removed successfully');
		return redirect('content');
	}

}
