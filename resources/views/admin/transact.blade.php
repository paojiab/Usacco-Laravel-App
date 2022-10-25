<x-admin>
    <div class="container text-center" style="margin-top: 30vh">
        <button class="btn btn-outline-primary mt-2 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#withdraw">Withraw</button>
        <i class="bi bi-dot"></i>
        <button class="btn btn-outline-success mt-2 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#transfer">Transfer</button>
        <i class="bi bi-dot"></i>
        <button class="btn btn-primary mt-2 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#deposit">Deposit</button>
    </div>

    <div class="modal" tabindex="-1" id="deposit" aria-labelledby="depositLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Savings Deposit</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('admin.savings.deposit',$account->id)}}" method="post">
                @csrf 
                <label for="account_no" class="form-label">Account Number</label>
                <input name="account_no" type="text" readonly value="{{$account->acct_no}}" class="form-control" placeholder="Enter account number">
                @error('account_no')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="row">
                    <div class="col-lg-6">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" id="" class="form-control">
                        @error('amount')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Deposit</button>
            </div>
        </form>
          </div>
        </div>
      </div>


<div class="modal" tabindex="-1" id="withdraw" aria-labelledby="withdrawLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Savings Withdraw</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('admin.savings.withdraw',$account->id)}}" method="post">
            @csrf 
            <label for="account_no" class="form-label">Account Number</label>
            <input name="account_no" type="text" readonly value="{{$account->acct_no}}" class="form-control" placeholder="Enter account number">
            @error('account_no')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="row">
                <div class="col-lg-6">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" name="amount" id="" class="form-control">
                    @error('amount')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-primary">Withdraw</button>
        </div>
    </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" id="transfer" aria-labelledby="transferLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Savings Transfer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('savings.transfer',$account->id)}}" method="post">
            @csrf 
            <div class="row">
                <div class="col-lg-6">
                    <label for="account_no" class="form-label">From</label>
            <input name="account_no" type="text" readonly value="{{$account->acct_no}}" class="form-control" placeholder="Enter account number">
            @error('account_no')
                <p class="text-danger">{{$message}}</p>
            @enderror
                </div>

                <div class="col-lg-6">
                    <label for="receive" class="form-label">To</label>
            <input name="receive" type="text" class="form-control" placeholder="Enter account number">
            @error('receive')
                <p class="text-danger">{{$message}}</p>
            @enderror
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-lg-6">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" name="amount" id="" class="form-control">
                    @error('amount')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-success">Transfer</button>
        </div>
    </form>
      </div>
    </div>
  </div>
</x-admin>