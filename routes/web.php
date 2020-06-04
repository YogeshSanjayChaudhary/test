<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

/*login*/
Route::get('login', ['as' => 'login', 'uses' => 'LoginController@index']);
Route::post('login', 'LoginController@postLogin');
Route::get('logout', 'LoginController@logout');
/*login end*/

Route::get('/', function () {
	if (Auth::user()) {
		return redirect('dashboard');
	} else {
		return view('login');
	}
});

/*Super Admin Middleware Start*/
Route::group(['middleware' => ['auth']], function () {

	Route::get('dashboard', 'DashboardController@index');

	/*Content Master*/
	Route::any('content/search', 'Admin\ContentController@search');
	Route::get('content', 'Admin\ContentController@index');
	Route::get('content/add', 'Admin\ContentController@getAdd');
	Route::post('content/add', 'Admin\ContentController@postAdd');
	Route::get('content/edit/{id}/{last_page}', 'Admin\ContentController@getEdit');
	Route::post('content/edit/{id}', 'Admin\ContentController@postEdit');
	Route::get('content/delete/{id}', 'Admin\ContentController@destroy');
	Route::get('channel', 'Admin\ChannelController@index');
	Route::get('channel/add', 'Admin\ChannelController@getAdd');
	Route::post('channel/add', 'Admin\ChannelController@postAdd');
	Route::get('channel/edit/{id}/{last_page}', 'Admin\ChannelController@getEdit');
	Route::post('channel/edit/{id}', 'Admin\ChannelController@postEdit');
	Route::get('channel/delete/{id}', 'Admin\ChannelController@destroy');

});
