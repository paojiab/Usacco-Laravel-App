<x-main>
    <section class="container mt-5">
        <div class="card-element w-75 d-block m-auto mb-5"  style="position: relative;">
          <div class="card" style="background-color: #4b7be5">
            <div class="card-body text-white">
              <p>Wallet Balance</p>  
            </div>
          </div>
    <div class="card w-100" style="position: absolute; top: 50px; border-radius: 20px;">
        <div class="card-body">
            <h5>UGX {{number_format($balance,2)}}</h5>
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
  <h3 class="pb-3" style="display: inline;">Wallet Statement</h3>
  @unless (count($txns)==0)
  <div class="dropdown"  style="display: inline;">
    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Download
    </a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="{{route('wallet.month')}}">30 Days</a></li>
      <li><a class="dropdown-item" href="{{route('wallet.quarter')}}">90 Days</a></li>
      <li><a class="dropdown-item" href="{{route('wallet.half')}}">180 Days</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="{{route('wallet.statement')}}">All time</a></li>
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
          <th scope="col">Reference</th>
          <th scope="col">Status</th>
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
          <td>{{$txn->reference}}</td>
          <td>{{$txn->status}}</td>
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
          <h5 class="modal-title">Wallet Deposit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('wallet.deposit')}}" method="post">
            @csrf 
            <div class="row">
                <div class="col-lg-6">
                    <input type="hidden" name="account_id" value="">
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
          <form action="{{route('wallet.withdraw')}}" method="post">
            @csrf 
            <div class="row">
                <div class="col-lg-6">
                    <input type="hidden" name="account_id" value="">
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
    </section>
</x-main>