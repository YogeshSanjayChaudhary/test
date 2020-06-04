<?php

namespace App\Http\Controllers\Admin;

use App\Channel;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddChannelRequest;
use App\Http\Requests\EditChannelRequest;
use App\Stream;
use Illuminate\Http\Request;

class ChannelController extends Controller {
	public function search(Request $request) {
		$search = $request->all();
		if (isset($search['search_text'])) {
			$search_text = $search['search_text'];
		} else {
			$search_text = '';
		}

		if ($search_text !== null && $search_text !== '') {
			$content = Content::where('content_name', 'like', '%' . $request->input('search_text') . '%')->paginate(20);
		} else {
			$content = Content::orderBy('id', 'desc')->paginate(20);
		}
		$data['sidebar_channel'] = '1';
		$data['content'] = $content;
		$data['search_text'] = $search_text;
		return view('content/index', $data);
	}

	public function index() {
		$data['sidebar_channel'] = '1';
		$data['channel'] = Channel::orderBy('id', 'desc')->paginate(20);
		$data['search_text'] = '';
		return view('channel/index', $data);
	}

	public function getAdd() {
		$data['sidebar_channel'] = '1';
		$data['streams'] = Stream::orderBy('id', 'asc')->get();
		return view('channel/add', $data);
	}

	public function postAdd(AddChannelRequest $request) {
		$channel = new Channel();
		$channel->fill($request->input());
		$channel->save();

		\Session::flash('success', 'Channel successfully added');
		return redirect('channel');
	}

	public function getEdit($id, $last_page) {
		$data['sidebar_channel'] = '1';
		$data['channel'] = Channel::find($id);
		$data['streams'] = Stream::orderBy('id', 'asc')->get();
		$data['last_page'] = $last_page;
		return view('channel/edit', $data);
	}

	public function postEdit(EditChannelRequest $request, $id) {
		$channel = Channel::find($id);
		$channel->fill($request->input());
		$channel->save();

		\Session::flash('success', 'Channel successfully Updated');
		return redirect('channel?page=' . $request->input('last_page'));
	}

	public function destroy($id) {
		$channel = Channel::find($id);
		$channel->save();

		$channel->delete();
		\Session::flash('success', 'Channel removed successfully');
		return redirect('channel');
	}

}
