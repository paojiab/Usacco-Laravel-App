<form wire:submit.prevent="submit" wire:key="depositForm">
    <div wire:loading.block wire:target="submit">
        <div style="height: 10px" class="progress rounded-0" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%"></div>
          </div>
    </div>
    @if (session()->has('message'))
    <div class="alert alert-warning rounded-0">
        {{ session('message') }}
    </div>
@endif
    @if (!$completed)
    <div class="modal-body">
        <div class="mb-3">
            <label for="walletBalance" class="form-label">Wallet Balance</label>
            <input type="text" readonly value="UGX {{number_format(auth()->user()->wallet,2)}}" class="form-control" id="walletBalance">
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
        <input type="number" wire:model.lazy="amount" class="form-control" id="amount">
    @error('amount') <span class="form-text text-danger">{{ $message }}</span> @enderror
        </div>
        
    </div>
 
    
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Deposit</button>
    </div>
    @else
    <div class="modal-body m-3">
        <p class="h1 text-primary text-center"><i class="bi bi-check-circle-fill"></i></p>
        <p class="text-center">Successfull</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
    @endif
</form>


