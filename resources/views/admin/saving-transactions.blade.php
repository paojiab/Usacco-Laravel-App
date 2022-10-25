<x-admin>
    <div class="container-fluid mt-3">
        <h4>SAVING TRANSACTIONS</h4>
        @unless (count($saving_txns) == 0)
        <div class="table-responsive">
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
                    <th scope="row">{{$account->acct_no}}</th>
                    <td>{{$account->first_name." ".$saving_txn->account()->first()->last_name}}</td>
                    <td>{{$account->acct_type}}</td>
                    <td>{{$saving_txn->txn_type}}</td>
                    <td>{{number_format($saving_txn->amount,2)}}</td>
                    <td>{{number_format($saving_txn->fee,2)}}</td>
                    <td>{{$saving_txn->reference}}</td>
                    <td>{{$saving_txn->status}}</td>
                    
                    <td>
                        <a href="/saving-txns/show/{{$saving_txn->id}}" class="btn btn-warning btn-sm">View</a>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
          <div class="d-flex">
            {!! $saving_txns->links() !!}
        </div>
          @else
        <p class="pt-2">No saving transactions available</p>
        @endunless

  
</div>
</x-admin>