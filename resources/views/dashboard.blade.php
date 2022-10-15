<x-main>
    <section class="container mt-5">
      @if ($account == null)
      <div class="alert alert-dark" role="alert">
        You have no accounts!
      </div>
          <a href="{{route('accounts.create')}}" class="btn btn-primary mt-2">Create Account</a>
        @elseif ($account->status == 'pending')
        <div class="alert alert-primary" role="alert">
          Your account is pending verification, keep around!
        </div>
        @elseif ($account->status == 'rejected')
        <div class="alert alert-danger" role="alert">
          Your account has been rejected!
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
                <h5>Available: UGX {{number_format($account->account_balance,2)}}</h5>
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
          <a href="">Download</a>
          <table class="table">
              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Transaction</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Fee</th>
                  <th scope="col">Reference</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($txns as $txn)
                <tr>
                  <th scope="row">{{$txn->created_at}}</th>
                  <td>{{$txn->txn_type}}</td>
                  <td>{{number_format($txn->amount,2)}}</td>
                  <td>{{number_format($txn->fee,2)}}</td>
                  <td>{{$txn->reference}}</td>
                  <td>{{$txn->status}}</td>
                </tr>
                @endforeach
                <tr>
                </tr>
               
              </tbody>
            </table>
            <div class="d-flex">
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
              <h5 class="modal-title">Mobile Money Withdraw</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('user.savings.withdraw')}}" method="post">
                @csrf 
                <div class="row">
                    <div class="col-lg-6">
                      <label for="tel" class="form-label">Telephone</label>
                        <input type="number" name="tel" id="" class="form-control" placeholder="E.g 07xxxxxxxx">
                        @error('tel')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
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
      @endif
      </section>
</x-main>
