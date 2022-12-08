<x-admin>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-5 border-bottom">
<h1 class="h2">Dashboard</h1>
</div>

<div class="row">
  

  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4"></div>
          <div class="col-lg-8 text-end">
            <h4>{{number_format($monthlyDeposits)}}/=</h4>
            <p>Monthly Deposits</p>
          </div>
        </div>

        <div class="text-end">
          <button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#deposit">Deposit</button>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4"></div>
          <div class="col-lg-8 text-end">
            <h4>{{number_format($monthlyWithdraws)}}/=</h4>
            <p>Monthly Withdraws</p>
          </div>
        </div>

        <div class="text-end">
          <button class="btn btn-warning btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#withdraw">Withdraw</button>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4"></div>
          <div class="col-lg-8 text-end">
            <h4>{{$monthlyUsers}}</h4>
            <p>New Monthly Users</p>
          </div>
        </div>

        <div class="text-end">
          <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#user">Create New User</button>
        </div>
      </div>
      
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4"></div>
          <div class="col-lg-8 text-end">
            <h4>{{$monthlyAccounts}}</h4>
            <p>New Monthly Accounts</p>
          </div>
        </div>

        <div class="text-end">
          <button class="btn btn-info btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#account">Open New Account</button>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4"></div>
          <div class="col-lg-8 text-end">
            <h4>{{$pendingReview}}</h4>
            <p>Accounts Pending Review</p>
          </div>
        </div>

        <div class="text-end">
          <a href="{{route('dashboard.review')}}" class="btn btn-outline-dark btn-sm">Review</a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4"></div>
          <div class="col-lg-8 text-end">
            <h4>{{$openLoans}}</h4>
            <p>Open Loans</p>
          </div>
        </div>

        <div class="text-end">
          <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#borrow">New Loan</button>
        </div>
      </div>
    </div>
  </div>


  

  
</div>

<div class="row mt-4 mb-5">
  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4"></div>
          <div class="col-lg-8 text-end">
            <h4>{{$defaultedLoans}}</h4>
            <p>Defaulted Loans</p>
          </div>
        </div>

        <div class="text-end">
          <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#repay">Repay</button>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4"></div>
          <div class="col-lg-8 text-end">
            <h4>{{$loansPendingReviewCount}}</h4>
            <p>Loans Pending Review</p>
          </div>
        </div>

        <div class="text-end">
          <a href="{{route('loans.pending')}}" class="btn btn-dark btn-sm">Review</a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4"></div>
          <div class="col-lg-8 text-end">
            <h4>{{$shareProductCount}}</h4>
            <p>Share Products</p>
          </div>
        </div>

        <div class="text-end">
          <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#shares">Buy Shares</button>
        </div>
      </div>
      
    </div>
  </div>

 
</div>


<div class="row mt-4 mb-5">
  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4"></div>
          <div class="col-lg-8 text-end">
            <h4>{{$welfareProductCount}}</h4>
            <p>Welfare Products</p>
          </div>
        </div>

        <div class="text-end">
          <button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#welfare">Contribute</button>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4"></div>
          <div class="col-lg-8 text-end">
            <h4>);-</h4>
            <p>In-App Notifications</p>
          </div>
        </div>

        <div class="text-end">
          <button class="btn btn-warning btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#notification">Send Notification</button>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4"></div>
          <div class="col-lg-8 text-end">
            <h4>10</h4>
            <p>Monthly Emails</p>
          </div>
        </div>

        <div class="text-end">
          <button class="btn btn-primary btn-sm">Send Email</button>
        </div>
      </div>
      
    </div>
  </div>

  

 
</div>

<div class="row mt-4 mb-5">
  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4"></div>
          <div class="col-lg-8 text-end">
            <h4>10</h4>
            <p>SMS Credits</p>
          </div>
        </div>

        <div class="text-end">
          <button class="btn btn-success btn-sm">Send SMS</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" id="user" aria-labelledby="userLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('dashboard.user')}}" method="post">
          @csrf 
         
              
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" id="" class="form-control">
          @error('name')
              <p class="text-danger">{{$message}}</p>
          @enderror
          
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" id="" class="form-control">
                  @error('email')
                      <p class="text-danger">{{$message}}</p>
                  @enderror
             
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
  </form>
    </div>
  </div>
</div>


<div class="modal" tabindex="-1" id="deposit" aria-labelledby="depositLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Savings Deposit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('dashboard.deposit')}}" method="post">
          @csrf 
         
              
          <label for="account_no" class="form-label">Account Number</label>
          <input type="number" name="account_no" id="" class="form-control">
          @error('account_no')
              <p class="text-danger">{{$message}}</p>
          @enderror
          
                  <label for="amount" class="form-label">Amount</label>
                  <input type="number" name="amount" id="" class="form-control">
                  @error('amount')
                      <p class="text-danger">{{$message}}</p>
                  @enderror
             
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Deposit</button>
      </div>
  </form>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" id="withdraw" aria-labelledby="withdrawLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Savings Withdraw</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('dashboard.withdraw')}}" method="post">
          @csrf 
          
          <label for="account_no" class="form-label">Account Number</label>
          <input type="number" name="account_no" id="" class="form-control">
          @error('account-no')
              <p class="text-danger">{{$message}}</p>
          @enderror
                  <label for="amount" class="form-label">Amount</label>
                  <input type="number" name="amount" id="" class="form-control">
                  @error('amount')
                      <p class="text-danger">{{$message}}</p>
                  @enderror
              
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-warning">Withdraw</button>
      </div>
  </form>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" id="account" aria-labelledby="accountLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">   
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('dashboard.account')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-lg-6">
              <label for="" class="form-label">User</label>
              <select name="user_id" id="" class="form-select">
                      <option value="">...</option>
                      @if(count($users) == 0)
                      <option value="">No users available</option>
                      @endif
                      @foreach ($users as $user)
                          <option value="{{$user->id}}" class="">{{$user->name}} | {{$user->email}}</option>
                      @endforeach
              </select>
              @error('user_id')
                  <p class="text-danger">{{$message}}</p>
              @enderror
          </div>
              <div class="col-lg-6">
          <label for="" class="form-label">Account type</label>
          <select name="saving_product_id" id="" class="form-select">
                  <option value="">...</option>
                  @if(count($products) == 0)
                      <option value="">No account types available</option>
                      @endif
                  @foreach ($products as $product)
                      <option value="{{$product->id}}" class="">{{$product->type}}</option>
                  @endforeach
          </select>
          @error('saving_product_id')
              <p class="text-danger">{{$message}}</p>
          @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">First Name</label>
          <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}">
          @error('first_name')
              <p class="text-danger">{{$message}}</p>
          @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">Last Name</label>
          <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}">
          @error('last_name')
          <p class="text-danger">{{$message}}</p>
      @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">Gender</label>
          <select name="sex" id="" class="form-select">
              <option value="">...</option>
              <option value="Mr.">Mr.</option>
              <option value="Ms.">Ms.</option>
          </select>
          @error('sex')
          <p class="text-danger">{{$message}}</p>
      @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">Telephone</label>
          <input type="text" name="tel" class="form-control" value="{{old('tel')}}">
          @error('tel')
          <p class="text_danger">{{$message}}</p>
      @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">Nationality</label>
          <input type="text" name="nationality" class="form-control" value="{{old('nationality')}}">
          @error('nationality')
          <p class="text-danger">{{$message}}</p>
      @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">Date of birth</label>
          <input type="date" name="date_of_birth" class="form-control" value="{{old('date_of_birth')}}">
          @error('date_of_birth')
          <p class="text-danger">{{$message}}</p>
          @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">Occupation</label>
          <input type="text" name="occupation" class="form-control" value="{{old('occupation')}}">
          @error('occupation')
          <p class="text-danger">{{$message}}</p>
      @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">Residential Address</label>
          <input type="text" name="address" class="form-control" value="{{old('address')}}">
          @error('address')
          <p class="text-danger">{{$message}}</p>
      @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">Next of Kin</label>
          <input type="text" name="next_of_kin" class="form-control" value="{{old('next_of_kin')}}">
          @error('next_of_kin')
          <p class="text-danger">{{$message}}</p>
      @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">Relationship with Kin</label>
          <input type="text" name="rel_kin" class="form-control" value="{{old('rel_kin')}}">
          @error('rel_kin')
          <p class="text-danger">{{$message}}</p>
      @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">Kin's Tel</label>
          <input type="text" name="tel_kin" class="form-control" value="{{old('tel_kin')}}">
          @error('tel_kin')
          <p class="text-danger">{{$message}}</p>
      @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">Identification type</label>
          <select name="id_type" id="" class="form-select">
              <option value="">...</option>
              <option value="National ID">Ugandan National ID</option>
              <option value="Driver's Permit">Ugandan Driver's License</option>
              <option value="Passport">Passport</option>
          </select>
          @error('id_type')
          <p class="text-danger">{{$message}}</p>
      @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">Identification no.</label>
          <input type="text" name="id_no" class="form-control" value="{{old('id_no')}}">
          @error('id_no')
          <p class="text-danger">{{$message}}</p>
      @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">ID Front</label>
          <input type="file" name="id_front" id="" class="form-control">
          @error('id_front')
          <p class="text-danger">{{$message}}</p>
      @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">ID Back</label>
          <input type="file" name="id_back" id="" class="form-control">
          @error('id_back')
          <p class="text-danger">{{$message}}</p>
      @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">Passport Photo</label>
          <input type="file" name="passport_photo" id="" class="form-control">
          @error('passport_photo')
          <p class="text-danger">{{$message}}</p>
      @enderror
      </div>
      <div class="col-lg-6">
          <label for="" class="form-label">Signature</label>
          <input type="file" name="signature" id="" class="form-control">
          @error('signature')
          <p class="text-danger">{{$message}}</p>
      @enderror
      </div>
      </div> 
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">Open</button>
      </div>
  </form>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" id="shares" aria-labelledby="sharesLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Shares</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('dashboard.shares')}}" method="post">
          @csrf 
         
              
          <label for="user_id" class="form-label">User</label>
          <select name="user_id" id="" class="form-select">
            <option value="">...</option>
            @if (count($users) == 0)
            <option value="">No users available</option>
            @endif
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}} | {{$user->email}}</option>
            @endforeach
          </select>
          @error('user_id')
              <p class="text-danger">{{$message}}</p>
          @enderror

          <label for="share_product_id" class="form-label">Share Product</label>
          <select name="share_product_id" id="" class="form-select">
            <option value="">...</option>
            @if (count($shareProducts) == 0)
            <option value="">No share products available</option>
            @endif
            @foreach($shareProducts as $shareProduct)
            <option value="{{$shareProduct->id}}">{{$shareProduct->name}} @ UGX {{$shareProduct->price}}</option>
            @endforeach
          </select>
          @error('share_product_id')
              <p class="text-danger">{{$message}}</p>
          @enderror
          
                  <label for="amount" class="form-label">Amount</label>
                  <input type="number" name="amount" id="" class="form-control">
                  @error('amount')
                      <p class="text-danger">{{$message}}</p>
                  @enderror
             
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-primary">Buy</button>
      </div>
  </form>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" id="welfare" aria-labelledby="welfareLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Welfare</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('dashboard.welfare')}}" method="post">
          @csrf 
         
              
          <label for="user_id" class="form-label">User</label>
          <select name="user_id" id="" class="form-select">
            <option value="">...</option>
            @if (count($users) == 0)
            <option value="">No users available</option>
            @endif
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}} | {{$user->email}}</option>
            @endforeach
          </select>
          @error('user_id')
              <p class="text-danger">{{$message}}</p>
          @enderror

          <label for="welfare_product_id" class="form-label">Share Product</label>
          <select name="welfare_product_id" id="" class="form-select">
            <option value="">...</option>
            @if (count($welfareProducts) == 0)
            <option value="">No welfare products available</option>
            @endif
            @foreach($welfareProducts as $welfareProduct)
            <option value="{{$welfareProduct->id}}">{{$welfareProduct->name}} @ UGX {{$welfareProduct->contribution}}</option>
            @endforeach
          </select>
          @error('welfare_product_id')
              <p class="text-danger">{{$message}}</p>
          @enderror
          
                  <label for="amount" class="form-label">Amount</label>
                  <input type="number" name="amount" id="" class="form-control">
                  @error('amount')
                      <p class="text-danger">{{$message}}</p>
                  @enderror
             
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-success">Contribute</button>
      </div>
  </form>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" id="borrow" aria-labelledby="borrowLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Loan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body container">
        @unless (count($loanPrdoucts) == 0)
            
       
        <form action="{{route('dashboard.loans')}}" method="POST" enctype="multipart/form-data">
          @csrf 
         
          <div class="row">
            
              <label for="user_id" class="form-label">User</label>
          <select name="user_id" id="" class="form-select">
            <option value="">...</option>
            @if (count($users) == 0)
            <option value="">No users available</option>
            @endif
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}} | {{$user->email}}</option>
            @endforeach
          </select>
          @error('user_id')
              <p class="text-danger">{{$message}}</p>
          @enderror
           
            <div class="col-lg-6">
              <label for="loan_product_id" class="form-label">Loan Product</label>
              <select name="loan_product_id" id="" class="form-select mb-2">
                <option value="">...</option>
                @foreach ($loanPrdoucts as $loanPrdouct)
                <option value="{{$loanPrdouct->id}}">{{$loanPrdouct->name}} | UGX {{number_format($loanPrdouct->minimum)}} - UGX {{number_format($loanPrdouct->maximum)}} | {{$loanPrdouct->loan_duration}} months</option>
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
        <button type="submit" class="btn btn-danger">Open</button>
      </div>
  </form>
  @else 
  <p>No Loan Products available</p>
  @endunless
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" id="repay" aria-labelledby="repayLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Loan Repay</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('dashboard.repay')}}" method="post">
          @csrf 
         
              
          <label for="loan_id" class="form-label">Loan ID</label>
          <input type="number" name="loan_id" id="" class="form-control">
          @error('loan_id')
              <p class="text-danger">{{$message}}</p>
          @enderror
          
                  <label for="amount" class="form-label">Amount</label>
                  <input type="number" name="amount" id="" class="form-control">
                  @error('amount')
                      <p class="text-danger">{{$message}}</p>
                  @enderror
             
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-secondary">Repay</button>
      </div>
  </form>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" id="notification" aria-labelledby="notificationLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">In-App Notification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('dashboard.notification')}}" method="post">
          @csrf 
         
              
          <label for="message" class="form-label">Message</label>
          <textarea class="form-control" name="message" id="" cols="30" rows="10"></textarea>
          @error('message')
              <p class="text-danger">{{$message}}</p>
          @enderror
          
                 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-warning">Send to all Users</button>
      </div>
  </form>
    </div>
  </div>
</div>
</x-admin>