<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
	public function login(Request $request)
	{
		$credentials = $request->only('email', 'password');
		$credentials['status'] = 'active';

		try {
			\Config::set('auth.model', \App\User::class);

			//print_r(JWTAuth::attempt($credentials));exit();
			// attempt to verify the credentials and create a token for the user
			if (!$token = JWTAuth::attempt($credentials)) {
				return response()->json(['error' => 'invalid_login_credentials'], 401);
				$status = "error";
			} else {
				$user = \App\User::where('email', $request->input('email'))->first();

				$status = "success";
				$data['user'] = $user;
				$data['token'] = $token;
			}
		} catch (JWTException $e) {
			// something went wrong whilst attempting to encode the token
			return response()->json(['error' => 'could_not_create_token'], 500);
		}
		$data['status'] = $status;
		$data['version'] = 1.0;
		return response()->json($data);
	}
	/**
	 *
	 * @SWG\Post(
	 *    path="/api/login",
	 *    summary="Login",
	 *    operationId="login",
	 *         @SWG\Parameter(
	 *             name="email",
	 *             in="query",
	 *             description="Email",
	 *             required=true,
	 *             type="string"
	 *             ),
	 *         @SWG\Parameter(
	 *             name="password",
	 *             in="query",
	 *             description="Password",
	 *             required=true,
	 *             type="string"
	 *             ),
	 *    @SWG\Response(response=200, description="Successful operation")
	 * )
	 */

	public function register(Request $request)
	{
		$validator = \Validator::make($request->all(), [
			'password' => 'required|min:6',
			'first_name' => 'required|regex:/^[a-zA-Z ]+$/u|max:150',
			'last_name' => 'required|regex:/^[a-zA-Z ]+$/u|max:150',
			'email' => 'required|email|unique:user',
		]);

		// then, if it fails, return the error messages in JSON format
		if ($validator->fails()) {
			$data['status'] = "fail";
			$data['messages'] = $validator->messages();
		} else {
			$user = new User;
			$user->fill($request->input());
			$user->password = bcrypt($request->input('password'));
			$user->username = $request->input('email');
			$user->save();

			/*Login*/
			$credentials = array('email' => $request->input('email'), 'password' => $request->input('password'));
			$credentials['status'] = 'active';
			try {
				\Config::set('auth.model', \App\User::class);
				// attempt to verify the credentials and create a token for the user
				if (!$token = JWTAuth::attempt($credentials)) {
					return response()->json(['error' => 'invalid_login_credentials'], 401);
					$status = "error";
				} else {
					$status = "success";
					$data['token'] = $token;
					$data['user'] = $user;
					$data['message'] = "Logged in successfully.";
				}
			} catch (JWTException $e) {
				// something went wrong whilst attempting to encode the token
				return response()->json(['error' => 'could_not_create_token'], 500);
			}
			$data['status'] = $status;
		}
		$data['version'] = 1.0;
		return response()->json($data);
	}
	/**
	 *
	 * @SWG\Post(
	 *    path="/api/signup",
	 *    summary="Register",
	 *    operationId="register",
	 *         @SWG\Parameter(
	 *             name="first_name",
	 *             in="query",
	 *             description="First name",
	 *             required=true,
	 *             type="string"
	 *             ),
	 *         @SWG\Parameter(
	 *             name="last_name",
	 *             in="query",
	 *             description="Last name",
	 *             required=true,
	 *             type="string"
	 *             ),
	 *         @SWG\Parameter(
	 *             name="password",
	 *             in="query",
	 *             description="Password",
	 *             required=true,
	 *             type="string"
	 *             ),
	 *         @SWG\Parameter(
	 *             name="email",
	 *             in="query",
	 *             description="Email",
	 *             required=true,
	 *             type="string"
	 *             ),
	 *         @SWG\Parameter(
	 *             name="status",
	 *             in="query",
	 *             description="Status",
	 *             required=true,
	 *             enum={"active", "inactive"},
	 *             type="string"
	 *             ),
	 *         @SWG\Parameter(
	 *             name="user_type",
	 *             in="query",
	 *             description="User Type",
	 *             required=true,
	 *             enum={"user"},
	 *             type="string"
	 *             ),
	 *    @SWG\Response(response=200, description="Successful operation")
	 * )
	 */
}
