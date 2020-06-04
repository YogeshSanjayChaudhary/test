<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebhookController extends Controller
{
    public function razorpayWebhook(Request $request)
    {
        $inputRequest = file_get_contents("php://input");
        $inputRequest = json_decode($inputRequest, true);
        switch ($inputRequest['event']) {
            case 'payment.authorized':
                $payload = $inputRequest['payload']['payment']['entity'];
                $payment_log = \App\PaymentLog::where('transaction_id', $payload['order_id'])->first();

                if (!$payment_log) {
                    $response = array();
                    $response['status'] = 'failure';
                    $response['messsage'] = 'Invalid order id';
                    return response()->json($response, 200);
                }

                if ($payment_log->status == 'completed') {
                    $response = array();
                    $response['status'] = 'failure';
                    $response['messsage'] = 'Order is already processed';
                    return response()->json($response, 200);
                }

                if ($payment_log->amount * 100 != $payload['amount']) {
                    $response = array();
                    $response['status'] = 'failure';
                    $response['messsage'] = 'Amount Mismatch';
                    return response()->json($response, 200);
                }

                $subscription_plan = \App\SubscriptionPlan::with('items.class')->find($payment_log->plan_id);

                $start_date = date('Y-m-d H:i:s');
                if ($active_subscription =  \App\Subscription::whereRaw('now() < end_date')->where('user_id', $payment_log->user_id)->orderBy('end_date', 'desc')->first()) {
                    $start_date = date('Y-m-d H:i:s',  strtotime($active_subscription->end_date));
                }
                $end_date = date('Y-m-d H:i:s', strtotime('+ ' . $subscription_plan->duration . ' ' . $subscription_plan->frequency, strtotime($start_date)));

                $subscription = new \App\Subscription();
                $subscription->user_id = $payment_log->user_id;
                $subscription->plan_id = $payment_log->plan_id;
                $subscription->start_date = $start_date;
                $subscription->end_date = $end_date;
                $subscription->status = 'active';
                $subscription->save();

                if ($subscription_plan->items) {
                    foreach ($subscription_plan->items as $item) {
                        if ($item->class) {
                            $subscription_class = new \App\SubscriptionClass();
                            $subscription_class->subscription_id = $subscription->id;
                            $subscription_class->class_id = $item->class->id;
                            $subscription_class->save();
                        }
                    }
                }
                $payment_log->status = 'completed';
                $payment_log->save();
                break;
            case 'payment.failed':
                $payload = $inputRequest['payload']['payment']['entity'];
                $payment_log = \App\PaymentLog::where('transaction_id', $payload['order_id'])->first();

                if (!$payment_log) {
                    $response = array();
                    $response['status'] = 'failure';
                    $response['messsage'] = 'Invalid order id';
                    return response()->json($response, 200);
                }

                if ($payment_log->status == 'completed') {
                    $response = array();
                    $response['status'] = 'failure';
                    $response['messsage'] = 'Order is already processed';
                    return response()->json($response, 200);
                }

                if ($payment_log->amount * 100 != $payload['amount']) {
                    $response = array();
                    $response['status'] = 'failure';
                    $response['messsage'] = 'Amount Mismatch';
                    return response()->json($response, 200);
                }
                $payment_log->status = 'failed';
                $payment_log->save();
                break;
        }
        $response = array();
        $response['status'] = 'success';
        $response['messsage'] = 'order successful';
        return response()->json($response, 200);
    }

    public function paytmWebhook(Request $request)
    {
        $gatewaySettings = \App\Setting::where('settings_key', 'paytm')->value('settings_value');
        if (!$gatewaySettings) {
            $data['status'] = "failure";
            $data['message'] = 'Invalid gateway settings';
            return response()->json($data);
        }
        $gatewaySettings = json_decode($gatewaySettings, true);

        $paytm_merchant_key = $gatewaySettings['merchant_key'];

        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = FALSE;

        $paramList = $request->input();
        $return_array = $request->input();
        $paytmChecksum = $request->input("CHECKSUMHASH");

        $isValidChecksum = verifychecksum_e($paramList, $paytm_merchant_key, $paytmChecksum);

        if ($isValidChecksum && $request->input("STATUS") == 'TXN_SUCCESS') {
            $payment_log = \App\PaymentLog::where('transaction_id', $paramList['ORDERID'])->first();

            if (!$payment_log) {
                $response = array();
                $response['status'] = 'failure';
                $response['messsage'] = 'Invalid order id';
                return response()->json($response, 200);
            }

            if ($payment_log->status == 'completed') {
                $response = array();
                $response['status'] = 'failure';
                $response['messsage'] = 'Order is already processed';
                return response()->json($response, 200);
            }

            $subscription_plan = \App\SubscriptionPlan::with('items.class')->find($payment_log->plan_id);

            $start_date = date('Y-m-d H:i:s');
            if ($active_subscription =  \App\Subscription::whereRaw('now() < end_date')->where('user_id', $payment_log->user_id)->orderBy('end_date', 'desc')->first()) {
                $start_date = date('Y-m-d H:i:s',  strtotime($active_subscription->end_date));
            }
            $end_date = date('Y-m-d H:i:s', strtotime('+ ' . $subscription_plan->duration . ' ' . $subscription_plan->frequency, strtotime($start_date)));

            $subscription = new \App\Subscription();
            $subscription->user_id = $payment_log->user_id;
            $subscription->plan_id = $payment_log->plan_id;
            $subscription->start_date = $start_date;
            $subscription->end_date = $end_date;
            $subscription->status = 'active';
            $subscription->save();

            if ($subscription_plan->items) {
                foreach ($subscription_plan->items as $item) {
                    if ($item->class) {
                        $subscription_class = new \App\SubscriptionClass();
                        $subscription_class->subscription_id = $subscription->id;
                        $subscription_class->class_id = $item->class->id;
                        $subscription_class->save();
                    }
                }
            }
            $payment_log->status = 'completed';
            $payment_log->save();
        } else {
            $response = array();
            $response['status'] = 'failure';
            $response['messsage'] = 'Checksum Validation Failed';
            return response()->json($response, 200);
        }

        $return_array["IS_CHECKSUM_VALID"] = $isValidChecksum ? "Y" : "N";
        unset($return_array["CHECKSUMHASH"]);
        $return_array['status'] = 'success';
        return response()->json($return_array);
    }
}
