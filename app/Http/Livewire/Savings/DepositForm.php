<?php

namespace App\Http\Livewire\Savings;

use App\Models\Account;
use App\Models\SavingTransaction;
use App\Models\WalletTransaction;
use Livewire\Component;

class DepositForm extends Component
{    
    public $accountId;

    public $amount;

    public $completed = false;

    protected $rules = [
        'amount' => 'required|numeric|gte:500'
    ];

    protected $listeners = ['toggle'];

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    public function submit()
    {

        $this->validate();

        $amount = $this->amount;

        $id = $this->accountId;

        $account = Account::find($id);

        $user = auth()->user();

        $wallet_balance = $user->wallet;

        $balance = $account->account_balance;

        if($amount > $wallet_balance) 
        {
            session()->flash('message', 'Insufficient funds. Add more money to your wallet to continue.');
        }  
        else 
        {
            $txn_data['amount'] = $amount;

            $txn_data['txn_type'] = 'deposit';

            $txn_data['balance'] = $balance + $amount;

            $txn_data['account_id'] = $id;

            SavingTransaction::create($txn_data);

            $account->increment('account_balance', $amount);

            $txn_data['txn_type'] = 'transfer to savings';

            $txn_data['user_id'] = auth()->id();

            $txn_data['reference'] = '17' . mt_rand(100000000, 999999999);

            $txn_data['status'] = 'successful';

            $txn_data['balance'] = auth()->user()->wallet - $amount;

            WalletTransaction::create($txn_data);

            $account->user->decrement('wallet', $amount);

            $this->reset('amount');

            $this->completed = true;

            $this->dispatchBrowserEvent('successful', []);

        }
    }

    public function toggle()
    {
        $this->completed = false;

        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.savings.deposit-form');
    }
}
