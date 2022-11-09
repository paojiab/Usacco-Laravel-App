<x-admin>
    <div class="container-fluid mt-3">
        <h4>LOAN PRODUCTS</h4>
        <button class="btn btn-primary btn-sm mt-2 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Create Loan Product</button>
        @unless (count($products) == 0)
        <div class="table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Interest</th>
                <th scope="col">Loan Fee</th>
                <th scope="col">Minimum Amount</th>
                <th scope="col">Maximum Amount</th>
                <th scope="col">Payable In</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <th scope="row">{{$product->name}}</th>
                    <td>{{$product->interest}}%</td>
                    <td>UGX {{number_format($product->loan_fee,2)}}</td>
                    <td>UGX {{number_format($product->minimum,2)}}</td>
                    <td>UGX {{number_format($product->maximum,2)}}</td>
                    <td>{{$product->loan_duration}} months</td>
                    <td>
                        <form action="">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
          @else
        <p class="pt-2">No loan products available</p>
        @endunless

        <div class="modal" tabindex="-1" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Create Loan Product</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{route('loan.products.store')}}" method="post">
                    @csrf 
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="name" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                              
                    <label for="interest" class="form-label">Interest (%)</label>
                    <input type="number" name="interest" id="" class="form-control"  step="0.01" min="0" max="100">
                    @error('interest')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                        </div>
                    </div>
                   
                  
                
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <label for="loan_fee" class="form-label">Loan Fee</label>
                            <input type="number" name="loan_fee" id="" class="form-control">
                            @error('loan_fee')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="minimum" class="form-label">Minimum Amount</label>
                            <input type="number" name="minimum" id="" class="form-control">
                            @error('minimum')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <label for="maximum" class="form-label">Maximum Amount</label>
                            <input type="number" name="maximum" id="" class="form-control">
                            @error('maximum')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="loan_duration" class="form-label">Max Loan Duration in Months</label>
                            <input type="number" name="loan_duration" id="" class="form-control">
                            @error('loan_duration')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
              </div>
            </div>
          </div>
    </div>
</x-admin>