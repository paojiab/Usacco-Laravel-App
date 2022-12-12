<x-admin>
    <div class="container text-center mt-5">
      @if ($account->status == 'pending' || $account->status == 'rejected') 
     
        <form action="{{route('account.verify', $account->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
            <label for="" class="form-label">Account type</label>
            <select name="acct_type" id="" class="form-select">
                    <option value="{{$account->savingProduct->type}}">{{$account->savingProduct->type}}</option>
            </select>
            @error('acct_type')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{$account->first_name}}">
            @error('first_name')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{$account->last_name}}">
            @error('last_name')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Gender</label>
            <input type="text" name="sex" value="{{$account->sex}}" id="" class="form-control">
            @error('sex')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Telephone</label>
            <input type="text" name="tel" class="form-control" value="{{$account->tel}}">
            @error('tel')
            <p class="text_danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Nationality</label>
            <input type="text" name="nationality" class="form-control" value="{{$account->nationality}}">
            @error('nationality')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Date of birth</label>
            <input type="date" name="date_of_birth" class="form-control" value="{{$account->date_of_birth}}">
            @error('date_of_birth')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Occupation</label>
            <input type="text" name="occupation" class="form-control" value="{{$account->occupation}}">
            @error('occupation')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Residential Address</label>
            <input type="text" name="address" class="form-control" value="{{$account->address}}">
            @error('address')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Next of Kin</label>
            <input type="text" name="next_of_kin" class="form-control" value="{{$account->next_of_kin}}">
            @error('next_of_kin')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Relationship with Kin</label>
            <input type="text" name="rel_kin" class="form-control" value="{{$account->rel_kin}}">
            @error('rel_kin')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Kin's Tel</label>
            <input type="text" name="tel_kin" class="form-control" value="{{$account->tel_kin}}">
            @error('tel_kin')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Identification type</label>
            <select name="id_type" id="" class="form-select">
                <option value="{{$account->id_type}}">{{$account->id_type}}</option>
            </select>
            @error('id_type')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Identification no.</label>
            <input type="text" name="id_no" class="form-control" value="{{$account->id_no}}">
            @error('id_no')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        
            <div> <img src="{{asset('storage/' . $account->id_front)}}" alt="" class="img-fluid w-25"></div>
            <label for="" class="form-label">ID Front</label>
            <input type="file" name="id_front" id="" class="form-control" value="{{old('id_front')}}">
            @error('id_front')
            <p class="text-danger">{{$message}}</p>
        @enderror
        
            <label for="" class="form-label">ID Back</label>
            <div> <img src="{{asset('storage/' . $account->id_back)}}" alt="" class="img-fluid w-25"></div>
            <input type="file" name="id_back" id="" class="form-control" value="{{old('id_back')}}">
            @error('id_back')
            <p class="text-danger">{{$message}}</p>
        @enderror
       
       
            <label for="" class="form-label">Passport Photo</label>
            <div> <img src="{{asset('storage/' . $account->passport_photo)}}" alt="" class="img-fluid w-25"></div>
            <input type="file" name="passport_photo" id="" class="form-control" value="{{old('passport_photo')}}">
            @error('passport_photo')
            <p class="text-danger">{{$message}}</p>
        @enderror
       
      
            <label for="" class="form-label">Signature</label>
            <div> <img src="{{asset('storage/' . $account->signature)}}" alt="" class="img-fluid w-25"></div>
            <input type="file" name="signature" id="" class="form-control" value="{{old('signature')}}">
            @error('signature')
            <p class="text-danger">{{$message}}</p>
        @enderror
       
        </div>
        <button type="submit" class="btn btn-warning mt-5 mb-4">Verify Account</button>
        </form>

        <form action="{{route('account.reject', $account->id)}}" method="post">
            @csrf 
            <button type="submit" class="btn btn-danger mb-5">Reject Account</button>
        </form>

        @else 
        <form action="{{route('account.update', $account->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
            <label for="" class="form-label">Account type</label>
            <select name="acct_type" id="" class="form-select">
                    <option value="{{$account->savingProduct->type}}">{{$account->savingProduct->type}}</option>
            </select>
            @error('acct_type')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{$account->first_name}}">
            @error('first_name')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{$account->last_name}}">
            @error('last_name')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Gender</label>
            <input type="text" name="sex" value="{{$account->sex}}" id="" class="form-control">
            @error('sex')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Telephone</label>
            <input type="text" name="tel" class="form-control" value="{{$account->tel}}">
            @error('tel')
            <p class="text_danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Nationality</label>
            <input type="text" name="nationality" class="form-control" value="{{$account->nationality}}">
            @error('nationality')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Date of birth</label>
            <input type="date" name="date_of_birth" class="form-control" value="{{$account->date_of_birth}}">
            @error('date_of_birth')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Occupation</label>
            <input type="text" name="occupation" class="form-control" value="{{$account->occupation}}">
            @error('occupation')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Residential Address</label>
            <input type="text" name="address" class="form-control" value="{{$account->address}}">
            @error('address')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Next of Kin</label>
            <input type="text" name="next_of_kin" class="form-control" value="{{$account->next_of_kin}}">
            @error('next_of_kin')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Relationship with Kin</label>
            <input type="text" name="rel_kin" class="form-control" value="{{$account->rel_kin}}">
            @error('rel_kin')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Kin's Tel</label>
            <input type="text" name="tel_kin" class="form-control" value="{{$account->tel_kin}}">
            @error('tel_kin')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Identification type</label>
            <select name="id_type" id="" class="form-select">
                <option value="{{$account->id_type}}">{{$account->id_type}}</option>
            </select>
            @error('id_type')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        <div class="col-lg-6">
            <label for="" class="form-label">Identification no.</label>
            <input type="text" name="id_no" class="form-control" value="{{$account->id_no}}">
            @error('id_no')
            <p class="text-danger">{{$message}}</p>
        @enderror
        </div>
        
            <label for="" class="form-label">ID Front</label>
            <div> <img src="{{asset('storage/' . $account->id_front)}}" alt="" class="img-fluid w-25"></div>
            <input type="file" name="id_front" id="" class="form-control">
            @error('id_front')
            <p class="text-danger">{{$message}}</p>
        @enderror
        
      
            <label for="" class="form-label">ID Back</label>
            <div> <img src="{{asset('storage/' . $account->id_back)}}" alt="" class="img-fluid w-25"></div>
            <input type="file" name="id_back" id="" class="form-control">
            @error('id_back')
            <p class="text-danger">{{$message}}</p>
        @enderror
       
       
            <label for="" class="form-label">Passport Photo</label>
            <div> <img src="{{asset('storage/' . $account->passport_photo)}}" alt="" class="img-fluid w-25"></div>
            <input type="file" name="passport_photo" id="" class="form-control">
            @error('passport_photo')
            <p class="text-danger">{{$message}}</p>
        @enderror
        
        
            <label for="" class="form-label">Signature</label>
            <div> <img src="{{asset('storage/' . $account->signature)}}" alt="" class="img-fluid w-25"></div>
            <input type="file" name="signature" id="" class="form-control">
            @error('signature')
            <p class="text-danger">{{$message}}</p>
        @enderror
       
        </div>
            <button type="submit" class="btn btn-warning mt-5 mb-5" disabled>Verify Account</button>
            <button type="submit" class="btn btn-danger mt-5 mb-5" disabled>Reject Account</button>
            <button type="submit" class="btn btn-primary mt-5 mb-5">Update Account</button>
        </form>
        @endif
    </div>
</x-admin>