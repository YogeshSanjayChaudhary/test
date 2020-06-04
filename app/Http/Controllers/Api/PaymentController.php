<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $gateways = array('razorpay', 'paytm', 'gooaleiap', 'appleiap');

        $validations = [
            'gateway' => 'required|in:' . implode(',', $gateways),
            'plan_id' => 'required',
            'user_id' => 'required'
        ];

        if ($request->input('gateway') == 'paytm') {
            $validations['email_id'] = 'required';
            $validations['mobile_number'] = 'required';
        }

        $validator = \Validator::make($request->all(), $validations);

        if ($validator->fails()) {
            $data['status'] = "failure";
            $data['message'] = $validator->messages()->first();
        } else {
            $user_id = $request->input('user_id');

            if ($subscription_plan = \App\SubscriptionPlan::find($request->input('plan_id'))) {
                $payment_log = new \App\PaymentLog();
                $payment_log->gateway = $request->input('gateway');
                $payment_log->plan_id = $request->input('plan_id');
                $payment_log->amount = $subscription_plan->amount;
                $payment_log->user_id = $user_id;
                $payment_log->save();

                $gatewaySettings = \App\Setting::where('settings_key', $request->input('gateway'))->value('settings_value');
                if (!$gatewaySettings) {
                    $data['status'] = "failure";
                    $data['message'] = 'Invalid gateway settings';
                    return response()->json($data);
                }
                switch ($request->input('gateway')) {
                    case 'razorpay':
                        $gatewaySettings = json_decode($gatewaySettings, true);
                        $api_key = $gatewaySettings['api_key'];
                        $api_secret = $gatewaySettings['api_secret'];

                        $api = new Api($api_key, $api_secret);

                        // Orders
                        $order  = $api->order->create(
                            array(
                                'receipt' => $payment_log->id,
                                'amount' => $subscription_plan->amount * 100,
                                'currency' => 'INR'
                            )
                        );
                        $order = $order->toArray();
                        $order['api_key'] = $api_key;

                        $payment_log->transaction_id = $order['id'];
                        $payment_log->save();

                        $data['status'] = 'success';
                        $data['order_details'] = $order;
                        $data['subscription_plan_details'] = $subscription_plan;

                        break;
                    case 'paytm':
                        $gatewaySettings = json_decode($gatewaySettings, true);

                        $paytm_merchant_key = $gatewaySettings['merchant_key'];

                        $mode = \App\Setting::where('settings_key', $request->input('gateway') . '_mode')->value('settings_value') ?? 'Staging';
                        $mode == 'live' ? $mode = 'Production' : $mode = 'Staging';

                        $paramList = array();
                        $paramList["mid"] = $gatewaySettings['merchant_id'];
                        $paramList["order_id"] = $payment_log->id . "";
                        $paramList["cust_id"] = $user_id . "";
                        $paramList["industry_type_id"] = $gatewaySettings['industry_type'];
                        $paramList["channel_id"] = $gatewaySettings['channel_id'];
                        $paramList["txn_amount"] = $subscription_plan->amount . "";
                        $paramList["website"] = $gatewaySettings['website'];

                        $paramList["email"] = $request->input('email_id');
                        $paramList["mobile_no"] = $request->input('mobile_number') . "";
                        $paramList["callback_url"] = 'https://securegw.paytm.in/theia/paytmCallback?ORDER_ID=' . $paramList["order_id"];
                        // $paramList["CALLBACK_URL"] = url('api/paytm-webhook');

                        //Here checksum string will return by getChecksumFromArray() function.
                        $checkSum = getChecksumFromArray($paramList, $paytm_merchant_key);
                        $order = $paramList;
                        $order['checksum'] = $checkSum;
                        $order['mode'] = $mode;

                        $payment_log->transaction_id = $paramList['order_id'];
                        $payment_log->save();

                        $data['status'] = 'success';
                        $data['order_details'] = $order;
                        $data['subscription_plan_details'] = $subscription_plan;

                        return response()->json($data);
                        break;
                    case 'googleiap':
                        break;
                    case 'appleiap':
                        break;
                }
            } else {
                $data['status'] = "failure";
                $data['message'] = 'Invalid plan id';
            }
        }
        return response()->json($data);
    }
    /**
     *
     * @SWG\Post(
     *    path="/api/create-order",
     *    summary="Create Order",
     *    operationId="create_order",
     *         @SWG\Parameter(
     *             name="user_id",
     *             in="query",
     *             description="User Id",
     *             required=true,
     *             type="string"
     *             ),
     *         @SWG\Parameter(
     *             name="plan_id",
     *             in="query",
     *             description="Plan Id",
     *             required=true,
     *             type="string"
     *             ),
     *         @SWG\Parameter(
     *             name="gateway",
     *             in="query",
     *             description="Payment Gateway",
     *             required=true,
     *             enum={"razorpay", "paytm", "gooaleiap", "appleiap"},
     *             type="string"
     *             ),
     *    @SWG\Response(response=200, description="Successful operation")
     * )
     */
}
