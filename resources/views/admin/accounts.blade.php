<x-admin>
    <div class="container-fluid mt-3">
        <h4>ACCOUNTS</h4>
        @unless (count($accounts) == 0)
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Account No</th>
                <th scope="col">Name</th>
                <th scope="col">Account Type</th>
                <th scope="col">Account Balance</th>
                <th scope="col">Status</th>
                <th scope="col">Details</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
                <tr>
                    <th scope="row">{{$account->acct_no}}</th>
                    <td>{{$account->first_name." ".$account->last_name}}</td>
                    <td>{{$account->acct_type}}</td>
                    <td>UGX {{number_format($account->account_balance,2)}}</td>
                    <td>{{$account->status}}</td>
                    <td>
                        <a href="/accounts/show/{{$account->id}}" class="btn btn-warning    ">Review</a>
                    </td>
                    <td>
                        <form action="/account/close/{{$account->id}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">Close</button>
                        </form>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
          @else
        <p class="pt-2">No accounts available</p>
        @endunless
</x-admin>