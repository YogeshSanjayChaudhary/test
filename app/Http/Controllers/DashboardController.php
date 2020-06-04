<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller {
	public function index() {
		$data['sidebar_dashboard'] = '1';
		return view('dashboard', $data);
	}

}
