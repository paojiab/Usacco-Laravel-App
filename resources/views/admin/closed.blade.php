<x-admin>
    @if (count($accounts) == 0)
    <div class="alert alert-dark" role="alert">
      User has no closed accounts!
    </div>
     @else
  <h2 class="pt-5 pb-4">Closed Accounts</h2>

  <div class="table-responsive">
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
                <td>{{$account->savingProduct->type}}</td>
                <td>UGX {{number_format($account->account_balance,2)}}</td>
                <td>{{$account->status}}</td>
                <td>
                    <form action="{{route('restore',$account->id)}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Restore</button>
                    </form>
                </td>
                <td>
                    <form action="" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
    </div>
 
  @endif
</x-admin>