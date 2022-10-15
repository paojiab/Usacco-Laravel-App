<x-admin>
    <div class="container-fluid mt-3">
        <h4>SAVINGS</h4>
        <button class="btn btn-outline-primary mt-2 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#withdraw">Withraw</button>
        <button class="btn btn-primary mt-2 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#deposit">Deposit</button>
        @unless (count($saving_txns) == 0)
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Account No</th>
                <th scope="col">Name</th>
                <th scope="col">Account Type</th>
                <th scope="col">Transaction Type</th>
                <th scope="col">Amount</th>
                <th scope="col">Fee</th>
                <th scope="col">Reference</th>
                <th scope="col">Status</th>
                <th scope="col">Review</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($saving_txns as $saving_txn)
                <tr>
                    <th scope="row">{{$saving_txn->account()->first()->acct_no}}</th>
                    <td>{{$saving_txn->account()->first()->first_name." ".$saving_txn->account()->first()->last_name}}</td>
                    <td>{{$saving_txn->account()->first()->acct_type}}</td>
                    <td>{{$saving_txn->txn_type}}</td>
                    <td>{{number_format($saving_txn->amount,2)}}</td>
                    <td>{{number_format($saving_txn->fee,2)}}</td>
                    <td>{{$saving_txn->reference}}</td>
                    <td>{{$saving_txn->status}}</td>
                    
                    <td>
                        <a href="/saving-txns/show/{{$saving_txn->id}}" class="btn btn-warning">View</a>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
          <div class="d-flex">
            {!! $saving_txns->links() !!}
        </div>
          @else
        <p class="pt-2">No saving transactions available</p>
        @endunless

        <div class="modal" tabindex="-1" id="deposit" aria-labelledby="depositLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Savings Deposit</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{route('admin.savings.deposit')}}" method="post">
                    @csrf 
                    <label for="account_no" class="form-label">Account Number</label>
                    <input name="account_no" type="text" class="form-control" placeholder="Enter account number">
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
    </div>

    <div class="modal" tabindex="-1" id="withdraw" aria-labelledby="withdrawLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Savings Withdraw</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('admin.savings.withdraw')}}" method="post">
                @csrf 
                <label for="account_no" class="form-label">Account Number</label>
                <input name="account_no" type="text" class="form-control" placeholder="Enter account number">
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
</x-admin>