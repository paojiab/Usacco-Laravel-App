<x-main>
    
    <section class="container mt-5">
        <div class="card-element w-75 d-block m-auto mb-5"  style="position: relative;">
          <div class="card" style="background-color: #4b7be5">
            <div class="card-body text-white">
              <p>Open Loans Balance</p>  
            </div>
          </div>
  
          <div class="card w-100" style="position: absolute; top: 50px; border-radius: 20px;">
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h5>UGX {{number_format($balance,2)}}</h5>
                  </div>
                  <div class="col-6 text-end">
                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#borrow">Borrow</button>
                  </div>
                </div>
                
              </div>
            </div>
        </div>
  
      <br>

      <div>
        <h3 class="py-2 text-center">My Loans</h3>
        @unless (count($loans) == 0)
        <table class="table-responsive table">
          <tbody>
            <tr>
              <th>Loan ID</th>
              <th>Title</th>
              <th>Status</th>
              <th>Maturity Date</th>
              <th>Loan Balance</th>
              <th>Action</th>
            </tr>
            @foreach ($loans as $loan)
            <tr>
              <th scope="row">{{'USL/'. auth()->id() . "/" . $loan->id}}</th>
              <td>{{$loan->title}}</td>
              <td>{{$loan->status}}</td>
              @unless ($loan->maturity_date == null)
              <td>{{$loan->maturity_date}}</td>
              @else 
              <td class="text-center">-</td>
              @endunless
              @unless ($loan->balance == null)
              <td>UGX {{number_format($loan->balance,2)}}</td>
              @else 
              <td class="text-center">-</td>
              @endunless
              @if ($loan->balance == 0 || $loan->balance == null)
              <td>
                <button disabled class="btn btn-primary">Repay</button>
              </td>
              @else 
              <td>
                <a href="{{route('loan.show',$loan->id)}}" class="btn btn-primary">Repay</a>
              </td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="d-flex mb-5">
          {!! $loans->links() !!}
      </div>
      @else
      <p class="py-2">No Loans Available</p>
      @endunless
    </div>
  
    <div class="text-center mt-3">
      <h3 class="pb-3" style="display: inline;">Loan Transactions</h3>
      @unless (count($txns)==0)
      
      <div class="table-responsive">
      <table class="table">
          <thead>
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Loan ID</th>
              <th scope="col">Title</th>
              <th scope="col">Transaction</th>
              <th scope="col">Amount</th>
              <th scope="col">Fee</th>
              <th scope="col">Loan Balance</th>
            </tr>
          </thead>
          <tbody>
           
            @foreach ($txns as $txn)
            <tr>
              <th scope="row">{{$txn->created_at}}</th>
              <td>{{"USL/" . auth()->id() . "/" . $txn->loan_id}}</td>
              <td>{{$txn->loan->title}}</td>
              <td>{{$txn->txn_type}}</td>
              <td>UGX {{number_format($txn->amount,2)}}</td>
              <td>UGX {{number_format($txn->fee,2)}}</td>
              <td>{{$txn->balance}}</td>
             
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

      <div class="modal" tabindex="-1" id="borrow" aria-labelledby="borrowLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Loan Request</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container">
              @unless (count($products) == 0)
                  
             
              <form action="{{route('loan.store')}}" method="POST" enctype="multipart/form-data">
                @csrf 
               
                <div class="row">
                  <div class="col-lg-6">
                    <label for="loan_product_id" class="form-label">Loan Product</label>
                    <select name="loan_product_id" id="" class="form-select mb-2">
                      <option value="">...</option>
                      @foreach ($products as $product)
                      <option value="{{$product->id}}">{{$product->name}} | UGX {{number_format($product->minimum)}} - UGX {{number_format($product->maximum)}} | {{$product->loan_duration}} months</option>
                      @endforeach
                    </select>
                    @error('loan_product_id')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                   
                  </div>
                  <div class="col-lg-6">
                    <label for="principal" class="form-label">Principal Amount</label>
                        <input type="number" name="principal" id="" class="form-control">
                        @error('principal')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                  </div>
                </div>
                <label for="reason" class="form-label mt-2">Reason for loan request</label>
                <textarea name="reason" cols="20" rows="2" class="form-control"></textarea>
                @error('reason')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="row my-2">
                  <div class="col-lg-6">
                    <label for="guarantor" class="form-label my-2">Guarantor Usacco Email: Optional if amount lower than Savings Security</label>
                    <input type="email" name="guarantor" id="" class="form-control my-1">
                    @error('guarantor')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                  </div>
                  <div class="col-lg-6">
                    <label for="collateral" class="form-label my-2">Collateral Name: Optional if Savings Security or Guarantee given</label>
                    <input type="text" name="collateral" id="" class="form-control my-1">
                    @error('collateral')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <label for="collateral_url" class="my-2">Collateral Image: Optional if collateral not provided</label>
                        <input type="file" name="collateral_url" class="form-control my-1">
                        @error('collateral_url')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                  </div>
                  <div class="col-lg-6">
                    <label for="collateral_ownership_url" class="my-2">Collateral Ownership Proof: Optional if collateral not provided</label>
                        <input type="file" name="collateral_ownership_url" class="form-control my-1">
                        @error('collateral_ownership_url')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                  </div>
                </div>
              
                       
                      
                    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        @else 
        <p>No Loan Products available</p>
        @endunless
          </div>
        </div>
      </div>
</x-main>