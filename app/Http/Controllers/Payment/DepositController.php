<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\SavingTransaction;
use App\Notifications\DepositNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DepositController extends Controller
{
    public function initialize(Request $request)
    {
        $request->validate([
            'amount' => 'required'
        ]);

        $amount = $request->amount;

        $tx_ref = '90' . mt_rand(100000000, 999999999);

        $email = auth()->user()->email;

        $name = auth()->user()->name;

        $key = \config('rave.key');

        $response = Http::withHeaders([
            'Authorization' =>  $key
        ])->post('https://api.flutterwave.com/v3/payments', [
            'tx_ref' => $tx_ref,
            'amount' => $amount,
            'currency' => 'UGX',
            'redirect_url' => route('deposit.callback',$request->account_id),
            'customer' => [
                'name' => $name,
                'email' => $email
            ],
            'customizations' => [
                'title' => 'Usacco',
                'description' => 'Savings Deposit',
            ]
        ]);

        if ($response->successful()) {

            $body = $response->object();

            if ($body->status == 'success') {

                $link = $body->data->link;


                return redirect($link);
            } else {
                return redirect()->route('savings',$request->account_id)->with('status', $body->message);
            }
        } else {
            return redirect()->route('savings',$request->account_id)->with('status', 'Unexpected Error');
        }
    }

    public function callback(Request $request,$account_id)
    {
        $key = \config('rave.key');

        $status = $request->status;

        $ref = $request->tx_ref;

        if ($status ==  'successful') {
            $txn_id = $request->transaction_id;

            $response = Http::withHeaders([
                'Authorization' => $key
            ])->get('https://api.flutterwave.com/v3/transactions/' . $txn_id . '/verify');

            if ($response->successful()) {

                $body = $response->object();

                if ($body->status == 'success') {
                    $amount = $body->data->amount;
                    $charged_amount = $body->data->charged_amount;
                    $tx_ref = $body->data->tx_ref;
                    $flw_ref = $body->data->flw_ref;
                    $status = $body->data->status;
                    $currency = $body->data->currency;
                    $account = Account::find($account_id);

                    $txn_data['amount'] = $amount;
                    $txn_data['account_id'] = $account_id;
                    $txn_data['txn_type'] = 'deposit';
                    $txn_data['reference'] = $flw_ref;
                    $txn_data['status'] = $status;
                    $txn_data['balance'] = $account->account_balance + $amount;

                    if (
                        $status == 'successful'
                        && $currency == 'UGX'
                        && $charged_amount == $amount
                        && $tx_ref == $ref
                    ) {

                        SavingTransaction::create($txn_data)->account()->increment('account_balance', $amount);

                        auth()->user()->notify(new DepositNotification($txn_data));

                        return redirect()->route('savings',$account_id)->with('status', 'Your deposit is successful with reference code: ' . $flw_ref);
                    } elseif (
                        $status == 'successful'
                        && $currency == 'UGX'
                        && $charged_amount > $amount
                        && $tx_ref == $ref
                    ) {

                        SavingTransaction::create($txn_data)->account()->increment('account_balance', $amount);

                        auth()->user()->notify(new DepositNotification($txn_data));

                        return redirect()->route('savings',$account_id)->with('status', 'Your deposit is successful with an extra charge refund in progress. For 
                        any queries contact us with reference: ' . $flw_ref);
                    } else {
                        return redirect()->route('savings',$account_id)->with('status', 'Your deposit verification was unsuccessful');
                    }
                } else {
                    return redirect()->route('savings',$account_id)->with('status', $body->message);
                }
            } else {
                return redirect()->route('savings',$account_id)->with('status', 'Unexpected Error');
            }
        } elseif ($status ==  'cancelled') {
            return redirect()->route('savings',$account_id)->with('status', 'Your deposit transaction has been cancelled');
        } else if ($status ==  'failed') {
            return redirect()->route('savings',$account_id)->with('status', 'Your deposit transaction has failed');
        }
    }
}
