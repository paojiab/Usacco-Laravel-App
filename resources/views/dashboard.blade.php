<x-main>
  <div class="container">
    @if ($accounts == null)
    <div class="alert alert-dark" role="alert">
      You have no accounts!
    </div>
        <a href="{{route('accounts.create')}}" class="btn btn-primary mt-2">Create Account</a>
     @else
  <h2 class="pt-5 pb-4">Saving Accounts</h2>

  @foreach($accounts as $account)
  <a href="{{route('savings',$account->id)}}" class="btn btn-light border-dark w-100 py-4 my-3">
    <div class="row">
      <div class="col-lg-6">
        <h4 class="d-inline me-2"><i class="bi bi-wallet2"></i></h4>  {{$account->savingProduct->type}}
        <p class="text-secondary d-inline">{{$account->acct_no}}</p>
      </div>
      <div class="col-lg-6">
        UGX {{number_format($account->account_balance,2)}}
      </div>
    </div>
  </a>
  @endforeach
  @endif
  </div>
</x-main>