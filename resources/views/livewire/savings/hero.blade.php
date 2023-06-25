<div>
  {{-- Account Balances --}}
  <div class="card-element w-75 d-block m-auto mb-5"  style="position: relative;">
    <div class="card bg-primary">
      <div class="card-body text-white">
        <p>{{$account->acct_type}} Account ({{$account->acct_no}})</p>  
      </div>
    </div>

    <div class="card w-100" style="position: absolute; top: 50px; border-radius: 20px;">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <h5>Available: UGX {{number_format($accountBalance,2)}}</h5>
            </div>
            <div class="d-none d-lg-block col-lg-6 text-end">
              <h5>Actual: UGX {{number_format($actualBalance,2)}}</h5>
            </div>
          </div>
          
        </div>
      </div>
  </div>

  {{-- Saving actions --}}
  <div class="row pt-4 text-center">
    <div class="col-6">
      <button class="btn btn-outline-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#withdraw">Withdraw</button>
    </div>
  
    <div class="col-6">
      <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#deposit">Deposit</button>
    </div>
</div>

{{-- Deposit modal --}}
  <div wire:ignore.self class="modal" tabindex="-1" id="deposit" aria-labelledby="depositLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Savings Deposit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <livewire:savings.deposit-form :accountId="$account->id" wire:key="{{now() . mt_rand()}}">

      </div>
    </div>
  </div>

  {{-- Withdraw modal --}}
  <div class="modal" tabindex="-1" id="withdraw" aria-labelledby="withdrawLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Wallet Withdraw</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('user.savings.withdraw')}}" method="post">
            @csrf 
            
                    <input type="hidden" name="account_id" value="{{$account->id}}">
                    <label for="balance" class="form-label">Savings Actual Balance</label>
                    <input id="balance" readonly name="balance" value="UGX {{number_format($actualBalance,2)}}" class="form-control">
                    <label for="amount" class="form-label">Amount</label>
                    <input id="amount" type="number" name="amount" id="" class="form-control">
                    @error('amount')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-primary">Withdraw</button>
        </div>
    </form>
      </div>
    </div>
  </div>  

  {{-- Script --}}
  <script>
    window.addEventListener('successful', event => 
    {
      Livewire.emit('refresh-event')
      Livewire.emitTo('savings-statement', 'refresh-me')
    });
    const depositModal = document.getElementById('deposit')
    depositModal.addEventListener('hidden.bs.modal', event => 
    {
      Livewire.emit('toggle')
    })
  </script>
</div>




