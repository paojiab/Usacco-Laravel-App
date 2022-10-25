<x-admin>
    <div class="container-fluid mt-3">
        <h4>SAVING PRODUCTS</h4>
        <button class="btn btn-primary btn-sm mt-2 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Create Saving Product</button>
        @unless (count($products) == 0)
        <div class="table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Account Type</th>
                <th scope="col">Minimum Balance</th>
                <th scope="col">Withdraw Charge</th>
                <th scope="col">Transfer Fee</th>
                <th scope="col">Closing Charge</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <th scope="row">{{$product->type}}</th>
                    <td>{{number_format($product->minimum_balance,2)}}</td>
                    <td>{{$product->withdraw_charge}}%</td>
                    <td>{{$product->transfer_fee}}%</td>
                    <td>{{$product->closing_charge}}%</td>
                    <td>
                        <form action="/saving-product/delete/{{$product->id}}" method="post">
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
        <p class="pt-2">No saving products available</p>
        @endunless

        <div class="modal" tabindex="-1" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Create Saving Product</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{route('product.store')}}" method="post">
                    @csrf 
                    <label for="type" class="form-label">Account type</label>
                    <input name="type" type="text" class="form-control" placeholder="Enter name of new savings product">
                    @error('type')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="minimum_balance" class="form-label">Minimum balance</label>
                            <input type="number" name="minimum_balance" id="" class="form-control">
                            @error('minimum_balance')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="withdraw_charge" class="form-label">Withdraw Charge (%)</label>
                            <input type="number" name="withdraw_charge" id="" class="form-control" step="0.01" min="0" max="100">
                            @error('withdraw_charge')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="closing_charge" class="form-label">Closing Charge (%)</label>
                            <input type="number" name="closing_charge" id="" class="form-control" step="0.01" min="0" max="100">
                            @error('closing_charge')
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