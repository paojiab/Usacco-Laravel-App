<x-main>
    
    <section class="container mt-5">
        <div class="card-element w-75 d-block m-auto mb-5"  style="position: relative;">
          <div class="card" style="background-color: #4b7be5">
            <div class="card-body text-white">
              <p>Monthly Welfare Balance</p>  
            </div>
          </div>
  
          <div class="card w-100" style="position: absolute; top: 50px; border-radius: 20px;">
              <div class="card-body">
                <h5>UGX {{number_format($monthly_amount,2)}}</h5>
              </div>
            </div>
        </div>
  
        <div class="row pt-4 text-center">
        <div class="col-lg-6">
          <button class="btn btn-outline-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#redeem">Redeem Request</button>
        </div>
  
        <div class="col-lg-6">
          <button class="btn btn-primary mb-3" type="button" data-bs-toggle="modal" data-bs-target="#contribute">Contribute</button>
        </div>
      </div>
  
      <div class="text-center mt-3">
        <h3 class="pb-3" style="display: inline;">Welfare Transactions</h3>
        @unless (count($txns)==0)
        
        <div class="table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Name</th>
                <th scope="col">Transaction</th>
                <th scope="col">Amount</th>
              </tr>
            </thead>
            <tbody>
             
              @foreach ($txns as $txn)
              <tr>
                <th scope="row">{{$txn->created_at}}</th>
                <td>{{$txn->welfareProduct->name}}</td>
                
                @if ($txn->amount>0)
                <td>Contribution</td>
                <td>{{number_format($txn->amount,2)}}</td>
                @else
                <td>Redeem</td>
                <td>{{number_format(($txn->amount) *-1,2)}}</td>
                @endif
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

      </section>

      <div class="modal" tabindex="-1" id="redeem" aria-labelledby="redeemLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Welfare Redeem Request</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container">
              <form action="">
                @csrf 
                        <input type="hidden" name="account_id" value="">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" id="" class="form-control">
                        @error('amount')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        <label for="reason" class="form-label">Reason</label>
                        <textarea name="reason" cols="20" rows="5" class="form-control"></textarea>
                        @error('reason')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        <label for="proof" class="my-2">Attach Proof</label>
                        <input type="file" name="proof" class="form-control">
                        @error('proof')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        <div class="form-check mt-3">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                            I confirm not to have missed any routine welfare contribution
                          </label>
                        </div>
                    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
          </div>
        </div>
      </div>

      <div class="modal" tabindex="-1" id="contribute" aria-labelledby="contributeLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Welfare Contribution</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('contribute')}}" method="post">
                @csrf 
                        <label for="" class="form-label">Wallet Balance</label>
                        <input type="text" readonly value="UGX {{number_format(auth()->user()->wallet,2)}}" class="form-control">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" id="" class="form-control">
                        @error('amount')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Contribute</button>
            </div>
        </form>
          </div>
        </div>
      </div>
</x-main>