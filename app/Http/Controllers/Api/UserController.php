<?php

namespace App\Http\Controllers\Api;

use App\Classes;
use App\Http\Controllers\Controller;
use App\Subscription;
use App\SubscriptionClass;
use Illuminate\Http\Request;

class UserController extends Controller
{

	public function getUserdetails(Request $request)
	{
		$validations = [
			'user_id' => 'required'
		];

		$validator = \Validator::make($request->all(), $validations);

		if ($validator->fails()) {
			$data['status'] = "failure";
			$data['message'] = $validator->messages()->first();
		} else {
			$subscription = Subscription::where('user_id', $request->input('user_id'))->first();
			if ($subscription) {
				$subscription_class = SubscriptionClass::where('subscription_id', $subscription->id)->get();
				$classes = array();
				foreach ($subscription_class as $key => $sc) {
					$classes[] = Classes::select('id', 'class_name', 'description', 'status')->where('status', 'active')->find($sc->class_id);
				}
				$subscription['classes'] = $classes;
			}

			// $data['user'] = $user;
			$data['subscription'] = $subscription;
			$data['status'] = 'success';
		}
		return response()->json($data);
	}

	/**
	 *
	 *@SWG\Get(
	 *    path="/api/user-details",
	 *    summary="Get User Details",
	 *    operationId="user_id",
	 *    @SWG\Parameter(
	 *        name="user_id",
	 *        in="query",
	 *        description="user id",
	 *        required=true,
	 *        type="string"
	 *        ),
	 *    @SWG\Response(response=200, description="Successful operation")
	 *)
	 */

	public function getUserEntitlement(Request $request)
	{
		$validations = [
			'user_id' => 'required',
			'content_id' => 'required'
		];

		$validator = \Validator::make($request->all(), $validations);

		if ($validator->fails()) {
			$data['status'] = "failure";
			$data['message'] = $validator->messages()->first();
		} else {
			$content = \App\Content::find($request->input('content_id'));
			if (!$content) {
				$data['status'] = "failure";
				$data['message'] = 'content not found';
				return response()->json($data);
			}
			$subscription_class_ids = array();
			$content_class_ids = \App\ContentClass::where('content_id', $request->input('content_id'))->pluck('class_id')->toArray();
			$subscription_ids = Subscription::whereRaw('"' . date('Y-m-d H:i:s') . '" between start_date and end_date')->where('user_id', $request->input('user_id'))->pluck('id');
			if ($subscription_ids) {
				$subscription_class_ids = \App\SubscriptionClass::whereIn('subscription_id', $subscription_ids)->pluck('class_id')->toArray();
			}
			// $subscription = Subscription::whereRaw('now() between start_date and end_date')->where('user_id', $request->input('user_id'))->first();

			$diff_ids = array_intersect($subscription_class_ids, $content_class_ids);

			$data['status'] = 'success';
			$data['allowed_content'] = $diff_ids ? true : false;
			if ($diff_ids) {
				$data['content'] = $content;
			}
		}
		return response()->json($data);
	}

	/**
	 *
	 *@SWG\Post(
	 *    path="/api/entitlement",
	 *    summary="Get Entitlement",
	 *    operationId="get_entitlement",
	 *    @SWG\Parameter(
	 *        name="user_id",
	 *        in="query",
	 *        description="user id",
	 *        required=true,
	 *        type="string"
	 *        ),
	 *    @SWG\Parameter(
	 *        name="content_id",
	 *        in="query",
	 *        description="content id",
	 *        required=true,
	 *        type="string"
	 *        ),
	 *    @SWG\Response(response=200, description="Successful operation")
	 *)
	 */
}
