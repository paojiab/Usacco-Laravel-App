<?php

namespace App\Jobs;

use App\Models\SavingTransaction;
use App\Models\User;
use App\Notifications\WithdrawNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class CheckWithdrawStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $response = Http::withHeaders([
            'Authorization' => $this->data['key']
        ])->get('https://api.flutterwave.com/v3/transfers/' . $this->data['id']);

        if($response->successful()) {
            if($response->object()->status == 'success'){
                $status = $response->object()->data->status;
                $amount = $response->object()->data->amount;
                $fee = $response->object()->data->fee;
                $total = $amount + $fee;
                $ref = $response->object()->data->reference;
                $user = $this->data['user'];
                $account_balance = $this->data['account_balance'];
                $txn_data = [
                    'amount' => $amount,
                    'reference' => $ref,
                    'status' => $status
                ];
        
                if ($status == 'SUCCESSFUL') {
                    SavingTransaction::find($this->data['txn_id'])->update([
                        'status' => $status,
                        'amount' => $amount,
                        'ref' =>  $ref,
                        'fee' => $fee,
                        'balance' => $account_balance - $amount
                    ]);
        
                    $user->notify(new WithdrawNotification($txn_data));
                } else if ($status == 'FAILED') {
                    SavingTransaction::find($this->data['txn_id'])->update([
                        'status' => $status,
                        'amount' => $amount,
                        'ref' =>  $ref,
                        'fee' => $fee,
                        'balance' => $account_balance + $amount
                    ])->increment('account_balance', $total);
        
                    $user->notify(new WithdrawNotification($txn_data));
                } else if ($status == 'PENDING') {
                    SavingTransaction::find($this->data['txn_id'])->update([
                        'status' => $status,
                        'amount' => $amount,
                        'ref' =>  $ref,
                        'fee' => $fee
                    ]);
        
                    $user->notify(new WithdrawNotification($txn_data));
                }
            } else{
            }
        } else {
        }

  
    }
}
