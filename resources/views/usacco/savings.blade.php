<x-main>
    <section class="container mt-5">
        @if ($account->status == 'pending')
        <div class="alert alert-primary" role="alert">
          Your account is pending verification, keep around!
        </div>
        @elseif ($account->status == 'rejected')
        <div class="alert alert-danger" role="alert">
          Your account has been rejected! Contact us for help.
        </div>
      @elseif ($account->status == 'verified')
     
        <div class="card-element w-75 d-block m-auto mb-5"  style="position: relative;">
          <div class="card" style="background-color: #4b7be5">
            <div class="card-body text-white">
              <p>{{$account->acct_type}} Account ({{$account->acct_no}})</p>  
            </div>
          </div>
  
          <div class="card w-100" style="position: absolute; top: 50px; border-radius: 20px;">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6">
                    <h5>Available: UGX {{number_format($account->account_balance,2)}}</h5>
                  </div>
                  <div class="col-lg-6 text-end">
                    <h5>Actual: UGX {{number_format($actual_bal,2)}}</h5>
                  </div>
                </div>
                
              </div>
            </div>
        </div>
  
        <div class="row pt-4 text-center">
        <div class="col-lg-6">
          <button class="btn btn-outline-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#withdraw">Withdraw</button>
        </div>
  
        <div class="col-lg-6">
          <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#deposit">Deposit</button>
        </div>
      </div>
  
      <div class="text-center mt-3">
          <h3 class="pb-3" style="display: inline;">Savings Statement</h3>
          @unless (count($txns)==0)
          <div class="dropdown"  style="display: inline;">
            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Download
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{route('savings.month',$account->id)}}">30 Days</a></li>
              <li><a class="dropdown-item" href="{{route('savings.quarter',$account->id)}}">90 Days</a></li>
              <li><a class="dropdown-item" href="{{route('savings.half',$account->id)}}">180 Days</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{{route('savings.stat',$account->id)}}">All time</a></li>
            </ul>
          </div>
          <div class="table-responsive">
          <table class="table">
              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Transaction</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Fee</th>
                  <th scope="col">Balance</th>
                </tr>
              </thead>
              <tbody>
               
                @foreach ($txns as $txn)
                <tr>
                  <th scope="row">{{$txn->created_at}}</th>
                  <td>{{$txn->txn_type}}</td>
                  <td>{{number_format($txn->amount,2)}}</td>
                  <td>{{number_format($txn->fee,2)}}</td>
                  <td>{{number_format($txn->balance,2)}}</td>
                </tr>
                @endforeach
                @else 
                <p class="fst-italic pt-2">No transactions to show</p>
                @endunless
               
               
              </tbody>
            </table>
          </div>
            <div class="d-flex mb-5">
              {!! $txns->links() !!}
          </div>
      </div>

      <div class="modal" tabindex="-1" id="deposit" aria-labelledby="depositLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Savings Deposit</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('user.savings.deposit')}}" method="post">
                @csrf 
               
                    
                        <input type="hidden" name="account_id" value="{{$account->id}}">
                        <label for="wallet_balance" class="form-label">Wallet Balance</label>
                <input type="text" readonly name="wallet_balance" value="UGX {{number_format(auth()->user()->wallet,2)}}" class="form-control">
                @error('wallet_balance')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" id="" class="form-control">
                        @error('amount')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                   
                
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
              <h5 class="modal-title">Wallet Withdraw</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('user.savings.withdraw')}}" method="post">
                @csrf 
                
                        <input type="hidden" name="account_id" value="{{$account->id}}">
                        <label for="balance" class="form-label">Savings Actual Balance</label>
                        <input readonly name="balance" value="UGX {{number_format($actual_bal,2)}}" class="form-control">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" id="" class="form-control">
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
</div>
      @endif
      </section>
</x-main>
