<x-admin>
    <div class="container-fluid">
      @if (count($accounts) == 0)
      <div class="alert alert-dark" role="alert">
        Member has no accounts!
      </div>
      @else
        <div class="row mt-4">
          <div class="col-lg-6">
            <h3>
              <i class="bi bi-person-badge-fill"></i>
               {{$user->accounts()->latest()->first()->sex}} {{$user->name}}
              
            </h3>
          </div>
          <div class="col-lg-6 text-end">
            <a href="{{route('admin.users.profile',$user->id)}}" class="btn btn-outline-dark">Edit Profile</a>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-lg-3 mb-5">
            <div class="card card-body">
              <div class="text-center">
                <img src="{{asset('storage/' . $user->accounts()->latest()->first()->passport_photo)}}" alt="" class="img-fluid w-50">
              </div>
              <h6>{{$user->name}}</h6>
              <p class="text-primary fw-bold">US000{{$user->id}}</p>
              <p><i class="bi bi-envelope-fill"></i> {{$user->email}}</p>
              <p><i class="bi bi-telephone-fill"></i> {{$user->accounts()->latest()->first()->tel}}</p>
              <p><i class="bi bi-geo-alt-fill"></i> {{$user->accounts()->latest()->first()->address}}</p>
              <hr />
              <hr />
              <img src="{{asset('storage/' . $user->accounts()->latest()->first()->signature)}}" alt="" class="img-fluid w-50">
              <img src="{{asset('storage/' . $user->accounts()->latest()->first()->id_front)}}" alt="" class="img-fluid w-50">
              <img src="{{asset('storage/' . $user->accounts()->latest()->first()->id_back)}}" alt="" class="img-fluid w-50">
            </div>
          </div>
          <div class="col-lg-9">
            <div class="card card-body">
              <div class="row">
                <div class="col-lg-6">
                  Shares: <span class="h4 fw-bold">8</span>
                </div>
                <div class="col-lg-6 text-end">
                  <a href="" class="nav-link d-inline text-primary">Purchase</a>
                  <div class="vr"></div>
                  <a href="" class="nav-link d-inline text-primary">Transfer</a>
                </div>
              </div>
            </div>
  
            <div class="card mt-5">
              <div class="card-header bg-primary text-white">
                <div class="row">
                  <div class="col-lg-6">
                    <h6>Saving Accounts</h6>
                  </div>
                  <div class="col-lg-6 text-end">
                    <a href="{{route('account.new',$user->id)}}" class="nav-link d-inline"
                      >Open New Account</a
                    >
                    <div class="vr"></div>
                    <a href="{{route('closed', $user->id)}}" class="nav-link d-inline"
                      >Closed Savings Accounts</a
                    >
                  </div>
                </div>
              </div>
              @foreach ($accounts as $account)
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6">
                    <h6 class="d-inline">{{$account->savingProduct->type}}</h6> 
                    <i class="bi bi-dot"></i>
                    <p class="d-inline text-secondary fst-italic">{{$account->status}}</p>
                  </div>
                  <div class="col-lg-6 text-end">
                    UGX <span class="fw-bold h4">{{number_format($account->account_balance,2)}}</span>
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-lg-6">{{$account->acct_no}}
                    @unless(count($account->savingTransactions()->get())==0)
                    <div class="dropdown"  style="display: inline;">
                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Download
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{route('admin.savings.month',$account->id)}}">30 Days</a></li>
                          <li><a class="dropdown-item" href="{{route('admin.savings.quarter',$account->id)}}">90 Days</a></li>
                          <li><a class="dropdown-item" href="{{route('admin.savings.half',$account->id)}}">180 Days</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="{{route('admin.savings.stat',$account->id)}}">All time</a></li>
                        </ul>
                      </div>
                      @endunless
                      <form action="/account/close/{{$account->id}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm mt-2">Close</button>
                    </form>
                </div>
                  
                  <div class="col-lg-6 text-end">
                    <a href="{{route('transact',$account->id)}}" class="btn btn-success btn-sm mt-4 mb-2">Transact</a>
                    
                  </div>
                </div>
              </div>
              @endforeach
            </div>
  
            <div class="card mt-5 mb-5">
              <div class="card-header bg-primary text-white">
                <div class="row">
                  <div class="col-lg-6">
                    <h6>Loans</h6>
                  </div>
                  <div class="col-lg-6 text-end">
                    <a href="" class="nav-link d-inline"
                      >Apply for New Loan</a
                    >
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6">
                    <h6>Start a retail business</h6>
                  </div>
                  <div class="col-lg-6 text-end">
                    UGX <span class="fw-bold h5">20,000,000.00</span>
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-lg-6">Disbursed</div>
                  <div class="col-lg-6 text-end">
                    <a href="" class="nav-link d-inline text-primary">Make Payment</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

     

  @endif
</div>
</x-admin>