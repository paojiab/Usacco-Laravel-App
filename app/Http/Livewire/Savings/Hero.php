<?php

namespace App\Http\Livewire\Savings;

use Livewire\Component;

class Hero extends Component
{
    public $account;

    public $accountBalance;

    public $actualBalance;

    protected $listeners = 
    [
        'refresh-event' => 'refreshEvent',
    ];

    public function refreshEvent()
    {
        $this->mount($this->account);
    }

    public function mount($account)
    {
        $minBal = $account->savingProduct->minimum_balance;
        $accountBalance = $account->account_balance;
        $this->accountBalance = $accountBalance;
        $this->actualBalance = $accountBalance - $minBal;
    }

    public function render()
    {
        return view('livewire.savings.hero');
    }
}
