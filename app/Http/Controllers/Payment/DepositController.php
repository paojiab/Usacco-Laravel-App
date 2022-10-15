<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\SavingTransaction;
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

        $account_id = auth()->user()->accounts()->first()->id;

        $key = \config('rave.key');

        $response = Http::withHeaders([
            'Authorization' =>  $key
        ])->post('https://api.flutterwave.com/v3/payments',[
            'tx_ref' => $tx_ref,
            'amount' => $amount,
            'currency' => 'UGX',
            'redirect_url' => route('deposit.callback', [$account_id, $amount]),
            'customer' => [
              'name' => $name,
              'email' => $email
            ],
            'customizations' => [
                'title' => 'Usacco',
                'description' => 'Savings Deposit',
            ]
            ]);

            

            $body = $response->object();

            $link = $body->data->link;

            if ($response->successful()) {
                return redirect($link);
            } else {
                return redirect('dashboard')->with('status', 'Unexpected Error');
            }

            

    }

    public function callback(Request $request, $account_id, $amount)
    {
        $status = $request->status;
        
        $ref = $request->tx_ref;

        $account_id = $request->account_id;

        $amount = $request->amount;

        if ($status ==  'successful') {
            $txn_data['amount'] = $amount;
            $txn_data['account_id'] = $account_id;
            $txn_data['txn_type'] = 'deposit';
            $txn_data['reference'] = $ref;
            $txn_data['status'] = $status;
    
            SavingTransaction::create($txn_data)->account()->increment('account_balance', $request->amount);

            return redirect('dashboard')->with('status', 'Your deposit is successful with reference code: ' . $ref);

        } elseif ($status ==  'cancelled') {
            $txn_data['amount'] = $amount;
            $txn_data['account_id'] = $account_id;
            $txn_data['txn_type'] = 'deposit';
            $txn_data['reference'] = $ref;
            $txn_data['status'] = $status;

            SavingTransaction::create($txn_data);

            return redirect('dashboard')->with('status', 'Your deposit transaction has been cancelled with reference code: ' . $ref);
        } else if ($status ==  'failed'){
            $txn_data['amount'] = $amount;
            $txn_data['account_id'] = $account_id;
            $txn_data['txn_type'] = 'deposit';
            $txn_data['reference'] = $ref;
            $txn_data['status'] = 'failed';

            SavingTransaction::create($txn_data);

            return redirect('dashboard')->with('status', 'Your deposit transaction has failed with reference code: ' . $ref);
        } else {
            return redirect('dashboard')->with('status', 'Unknown error');
        }
    }
}
