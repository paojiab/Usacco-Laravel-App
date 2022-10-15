<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\SavingProduct;
use App\Models\SavingTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WithdrawController extends Controller
{
    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'tel' => 'required|digits:9'
        ]);

        $amount = $request->amount;

        $tel = $request->tel;

        $key = \config('rave.key');

        $fees = Http::withHeaders([
            'Authorization' => $key
        ])->get('https://api.flutterwave.com/v3/transfers/fee?currency=UGX&type=mobilemoney&amount=' . $amount);

        $fee = $fees->object()->data[0]->fee;

        if ($fees->object()->status == 'success') {

            $total = $fee + $amount;

            $account_id = auth()->user()->accounts()->first()->id;

            $type = auth()->user()->accounts()->first()->acct_type;

            $min_bal = SavingProduct::where('type', $type)->first()->minimum_balance;

            $balance = auth()->user()->accounts()->first()->account_balance;

            $actual_bal = $balance - $min_bal;

            if ($total > $actual_bal) {
                return redirect()->back()->with('status', 'Insufficient funds');
            } else {

                $response = Http::withHeaders([
                    'Authorization' => $key
                ])->post('https://api.flutterwave.com/v3/transfers', [
                    "account_bank" => "MPS",
                    "account_number" => '256' . $tel,
                    "amount" => $amount,
                    "currency" => "UGX",
                    "beneficiary_name" => "Paul Barasa",
                    "meta" => [
                        "sender" => "Usacco",
                        "sender_country" => "UG",
                        "mobile_number" => "2560760109642",
                    ]
                ]);

                $body = $response->object();

                if ($body->status == 'success') {

                    $id = $body->data->id;

                    return redirect()->route('withdraw.callback', [$id, $account_id]);
                } else {
                    return redirect('dashboard')->with('status', 'Unknown Error');
                }
            }
        } else {
            return redirect('dashboard')->with('status', 'Unknown Error');
        }
    }

    public function callback(Request $request, $id, $account_id)
    {
        $key = \config('rave.key');

        $response = Http::withHeaders([
            'Authorization' => $key
        ])->get('https://api.flutterwave.com/v3/transfers/' . $id);

        $status = $response->object()->data->status;

        $amount = $response->object()->data->amount;

        $fee = $response->object()->data->fee;

        $ref = $response->object()->data->reference;

        $total = $amount + $fee;

        if ($status == 'NEW') {
            $txn_data['amount'] = $amount;
            $txn_data['account_id'] = $account_id;
            $txn_data['txn_type'] = 'withdraw';
            $txn_data['reference'] = $ref;
            $txn_data['status'] = $status;
            $txn_data['fee'] = $fee;

            SavingTransaction::create($txn_data)->account()->decrement('account_balance', $total);

            return redirect('dashboard')->with('status', 'A new withdraw transaction has been initiated with reference code: ' . $ref);
        } else if ($status == 'PENDING') {
        } else if ($status == 'SUCCESSFUL') {
            $txn_data['amount'] = $amount;
            $txn_data['account_id'] = $account_id;
            $txn_data['txn_type'] = 'withdraw';
            $txn_data['reference'] = $ref;
            $txn_data['status'] = $status;
            $txn_data['fee'] = $fee;

            SavingTransaction::create($txn_data);

            return redirect('dashboard')->with('status', 'Withdraw completed successfully');
        } else if ($status == 'FAILED') {
            $txn_data['amount'] = $amount;
            $txn_data['account_id'] = $account_id;
            $txn_data['txn_type'] = 'withdraw';
            $txn_data['reference'] = $ref;
            $txn_data['status'] = $status;
            $txn_data['fee'] = $fee;

            SavingTransaction::create($txn_data)->account()->increment('account_balance', $total);

            SavingTransaction::create($txn_data);

            return redirect('dashboard')->with('status', 'Withdraw Failed');
        } else {
            return redirect('dashboard')->with('status', 'Unknown Error');
        }
    }
}
