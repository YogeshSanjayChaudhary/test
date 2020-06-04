<?php

namespace App\Http\Controllers\Api;

use App\Classes;
use App\Http\Controllers\Controller;
use App\SubscriptionPlan;
use App\SubscriptionPlanItem;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
	public function getSubscriptionPlans(Request $request)
	{
		$plans = SubscriptionPlan::select('id', 'name', 'description', 'amount', 'status')->where('status', 'active');
		if ($request->input('board_id')) {
			$plans->where('board_id', $request->input('board_id'));
		}
		if ($request->input('grade_id')) {
			$plans->where('grade_id', $request->input('grade_id'));
		}
		if ($request->input('school_id')) {
			$plans->where('school_id', $request->input('school_id'));
		}
		$plans = $plans->orderby('name', 'asc')->get();
		if ($plans) {
			$data['status'] = 'success';
			$data['plans'] = $plans;
		} else {
			$data['status'] = 'fail';
			$data['message'] = 'Subscription plans not found.';
		}
		return response()->json($data);
	}

	/**
	 *@SWG\Get(
	 *     path="/api/subscription-plans",
	 *     summary="Get all subscription plans",
	 *     operationId="all_subscription_plans",
	 *     @SWG\Response(response=200, description="Successful operation")
	 * )
	 */

	public function getSubscriptionPlanDetails(Request $request, $plan_id)
	{
		$plan = SubscriptionPlan::select('id', 'name', 'description', 'amount', 'status')->find($plan_id);
		if ($plan) {
			$subscription_plan_item = SubscriptionPlanItem::where('subscription_plan_id', $plan_id)->get();
			$plan_classes = array();
			foreach ($subscription_plan_item as $key => $item) {
				$plan_classes[] = Classes::select('id', 'class_name', 'description', 'status')->where('status', 'active')->find($item->class_id);
			}
			$data['status'] = 'success';
			$data['plan'] = $plan;
			$data['plan_classes'] = $plan_classes;
		} else {
			$data['status'] = 'fail';
			$data['message'] = 'Plan not found.';
		}
		return response()->json($data);
	}

	/**
	 *@SWG\Get(
	 *     path="/api/subscription-plan-details/{planid}",
	 *     summary="Get subscription plan details",
	 *     operationId="subscription_plan_details",
	 *     @SWG\Response(response=200, description="Successful operation")
	 * )
	 */
}
