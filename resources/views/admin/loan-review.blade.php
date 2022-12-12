<x-admin>
    <div class="container text-center mt-5">
      @if ($loan->status == 'Pending' || $loan->status == 'Rejected') 
     
        <form action="{{route('loans.store',$loan->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
            <label for="" class="form-label">Title</label>
            <input type="text" name="title" value="{{$loan->title}}" class="form-control">
            @error('title')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Principal</label>
            <input type="number" readonly name="principal" class="form-control" value="{{$loan->principal}}">
            @error('principal')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Interest (%)</label>
            <input type="number" name="interest" class="form-control" value="{{$loan->interest}}">
            @error('interest')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Loan Duration in months</label>
            <input type="number" name="duration" value="{{$loan->duration}}" id="" class="form-control">
            @error('duration')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Loan Fee</label>
            <input type="number" name="loan_fee" class="form-control" value="{{$loan->loan_fee}}">
            @error('loan_fee')
            <p class="text_danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Disburse Amount</label>
            <input type="number" name="disburse_amount" class="form-control" value="{{$loan->disburse_amount}}">
            @error('disburse_amount')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        
            <label for="" class="form-label my-2">Reason</label>
            <textarea name="reason" cols="30" rows="2" class="form-control">{{$loan->reason}}</textarea>
            @error('reason')
            <p class="text-danger">{{$message}}</p>
            @enderror
       
       
       
      
      
        <div class="col-lg-6">
            <label for="" class="form-label">Guarantor</label>
            <input type="text" name="guarantor" class="form-control" value="{{$loan->guarantor}}">
            @error('guarantor')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Collateral</label>
            <input type="text" name="collateral" class="form-control" value="{{$loan->collateral}}">
            @error('collateral')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
       
       
        <div class="col-lg-6">
            <div> <img src="{{asset('storage/' . $loan->collateral_url)}}" alt="" class="img-fluid w-25"></div>
            <label for="" class="form-label">Collateral Image</label>
            <input type="file" name="collateral_url" id="" class="form-control">
            @error('collateral_url')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Collateral Ownership Document</label>
            <div> <img src="{{asset('storage/' . $loan->collateral_ownership_url)}}" alt="" class="img-fluid w-25"></div>
            <input type="file" name="collateral_ownership_url" id="" class="form-control">
            @error('collateral_ownership_url')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        </div>
        <button type="submit" class="btn btn-warning mt-5 mb-4">Approve Loan</button>
        </form>

        <form action="" method="post">
            @csrf 
            <button type="submit" class="btn btn-danger mb-5">Reject Loan</button>
        </form>

        {{-- ###################### If loan is open ######################################### --}}
        @else 
        <form action="{{route('loans.update', $loan->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
            <label for="" class="form-label">Title</label>
            <input type="text" name="title" value="{{$loan->title}}" class="form-control">
            @error('title')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Principal</label>
            <input type="number" readonly name="principal" class="form-control" value="{{$loan->principal}}">
            @error('principal')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Interest (%)</label>
            <input type="number" name="interest" class="form-control" value="{{$loan->interest}}">
            @error('interest')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Loan Duration in months</label>
            <input type="number" name="duration" value="{{$loan->duration}}" id="" class="form-control">
            @error('duration')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Loan Fee</label>
            <input type="number" name="loan_fee" class="form-control" value="{{$loan->loan_fee}}">
            @error('loan_fee')
            <p class="text_danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Disburse Amount</label>
            <input type="number" name="disburse_amount" class="form-control" value="{{$loan->disburse_amount}}">
            @error('disburse_amount')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Reason</label>
            <textarea name="reason" cols="30" rows="2" class="form-control my-2">{{$loan->reason}}</textarea>
            @error('reason')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
            <div class="col-lg-6">
                <label for="" class="form-label">Loan Balance</label>
            <input type="number" name="balance" class="form-control" value="{{$loan->balance}}">
            @error('balance')
            <p class="text-danger">{{$message}}</p>
        @enderror
            </div>
            <div class="col-lg-6">
                <label for="" class="form-label">Status</label>
                <select name="status" id="" class="form-select">
                    <option value="">...</option>
                    <option value="Open">Open</option>
                    <option value="Open">Defaulted</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label for="" class="form-label">Maturity date</label>
                <input type="date" name="maturity_date" class="form-control">
                @error('maturity_date')
                <p class="text-danger">{{$message}}</p>
            @enderror
            </div>
      
        <div class="col-lg-6">
            <label for="" class="form-label">Guarantor</label>
            <input type="text" name="guarantor" class="form-control" value="{{$loan->guarantor}}">
            @error('guarantor')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Collateral</label>
            <input type="text" name="collateral" class="form-control" value="{{$loan->collateral}}">
            @error('collateral')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
       
       
        <div class="col-lg-6">
            <div> <img src="{{asset('storage/' . $loan->collateral_url)}}" alt="" class="img-fluid w-25"></div>
            <label for="" class="form-label">Collateral Image</label>
            <input type="file" name="collateral_url" id="" class="form-control">
            @error('collateral_url')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Collateral Ownership Document</label>
            <div> <img src="{{asset('storage/' . $loan->collateral_ownership_url)}}" alt="" class="img-fluid w-25"></div>
            <input type="file" name="collateral_ownership_url" id="" class="form-control">
            @error('collateral_ownership_url')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        </div>
            <button type="submit" class="btn btn-warning mt-5 mb-5" disabled>Approve Loan</button>
            <button type="submit" class="btn btn-danger mt-5 mb-5" disabled>Reject Loan</button>
            <button type="submit" class="btn btn-primary mt-5 mb-5">Restructure Loan</button>
        </form>
        @endif
    </div>
</x-admin>