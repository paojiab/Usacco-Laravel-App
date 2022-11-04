<x-main>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6">
                        <h5>{{$product->name}} @ UGX {{number_format($product->price,2)}}</h5>
                    </div>
                    <div class="col-lg-6">
                        <p class="fw-bold text-end">Shares: {{$product->shares()->where('user_id',auth()->id())->get()->sum('shares')}} | Amount: UGX {{number_format($product->shares()->where('user_id', auth()->id())->get()->sum('shares') * $product->price, 2)}}</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 text-center">
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#sellModal">Sell</button>
                    </div>
                    <div class="col-lg-6 text-center">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#buyModal">Buy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="sellModal" aria-labelledby="sellModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Sell Shares</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('sell')}}" method="post">
                @csrf 
                <label for="share_product_id" class="form-label">Share</label>
                <select name="share_product_id" id="" class="form-select">
                  <option value="{{$product->id}}">{{$product->name}}</option>
                </select>
                @error('share_product_id')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="row my-2">
                    <div class="col-lg-6">
                        <label for="share_balance" class="form-label">Share Balance</label>
                <input type="text" readonly name="share_balance" value="{{$product->shares()->where('user_id',auth()->id())->sum('shares')}}" class="form-control">
                @error('share_balance')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                    </div>
                    <div class="col-lg-6">
                        <label for="worth" class="form-label">Worth</label>
                        <input type="text" readonly name="worth" value="UGX {{number_format($product->shares()->where('user_id',auth()->id())->sum('shares') * $product->price,2)}}" class="form-control">
                        @error('worth')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                
              
             
                    {{-- <div class="col-lg-6">
                        <label for="shares" class="form-label">No. of shares</label>
                        <input type="number" name="shares" id="" class="form-control">
                        @error('shares')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div> --}}
              
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" id="" class="form-control">
                        @error('amount')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                   
                   
               
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Sell</button>
            </div>
        </form>
          </div>
        </div>
      </div>

      <div class="modal" tabindex="-1" id="buyModal" aria-labelledby="buyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Buy Shares</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('buy')}}" method="post">
                @csrf 
                
                <label for="wallet_balance" class="form-label">Wallet Balance</label>
                <input type="text" readonly name="wallet_balance" value="UGX {{number_format(auth()->user()->wallet,2)}}" class="form-control">
                @error('wallet_balance')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                <label for="share_product_id" class="form-label">Share</label>
                <select name="share_product_id" id="" class="form-select">
                  <option value="{{$product->id}}">{{$product->name}}</option>
                </select>
                @error('share_product_id')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="row">
                  <div class="col-lg-6">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" readonly name="price" id="" class="form-control" value="{{$product->price}}">
                    @error('price')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                    {{-- <div class="col-lg-6">
                        <label for="shares" class="form-label">No. of shares</label>
                        <input type="number" name="shares" id="" class="form-control">
                        @error('shares')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div> --}}
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
              <button type="submit" class="btn btn-primary">Buy</button>
            </div>
        </form>
          </div>
        </div>
      </div>
</x-main>