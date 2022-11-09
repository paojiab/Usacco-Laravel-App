<x-main>
    <section class="container mt-5">
      <div class="card-element w-75 d-block m-auto mb-5"  style="position: relative;">
        <div class="card" style="background-color: #4b7be5">
          <div class="card-body text-white">
            <p>Total Share Amount</p>  
          </div>
        </div>

        <div class="card w-100" style="position: absolute; top: 50px; border-radius: 20px;">
            <div class="card-body">
              <h5>UGX {{number_format($worth,2)}}</h5>
            </div>
          </div>
      </div>
      <br><br>
      <div>
            <table class="table-responsive table">
              <tbody>
                <tr>
                  <th>PORTFOLIO</th>
                  <th>PRICE</th>
                  <th>SHARES</th>
                  <th>AMOUNT</th>
                  <th>ACTION</th>
                </tr>
                @foreach ($products as $product)
                <tr>
                  <th scope="row">{{$product->name}}</th>
                  <td>UGX {{number_format($product->price,2)}}</td>
                  <td>{{$product->shares()->where('user_id',auth()->id())->get()->sum('shares')}}</td>
                  <td>UGX {{number_format($product->shares()->where('user_id', auth()->id())->get()->sum('amount'), 2)}}</td>
                  <td>
                   <a href="{{route('share.show', $product->id)}}" class="btn btn-primary"> <i class="bi bi-chevron-right"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex mb-5">
              {!! $products->links() !!}
          </div>
        </div>
    
     

      <div class="text-center mt-3">
        <h3 class="pb-3" style="display: inline;">Share Transactions</h3>
        @unless (count($txns)==0)
        
        <div class="table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Share Name</th>
                <th scope="col">Transaction</th>
                <th scope="col">Shares</th>
                <th scope="col">Amount</th>
                <th scope="col">Fee</th>
              </tr>
            </thead>
            <tbody>
             
              @foreach ($txns as $txn)
              <tr>
                <th scope="row">{{$txn->created_at}}</th>
                <td>{{$txn->shareProduct->name}}</td>
                
                @if ($txn->shares>0)
                <td>Bought</td>
                <td>{{$txn->shares}}</td>
                <td>{{number_format($txn->shares * $txn->shareProduct->price,2)}}</td>
                @else
                <td>Sold</td>
                <td>{{$txn->shares * -1}}</td>
                <td>{{number_format(($txn->shares * $txn->shareProduct->price) *-1,2)}}</td>
                @endif
                <td>{{number_format($txn->shareProduct->selling_fee,2)}}</td>
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
</x-main>