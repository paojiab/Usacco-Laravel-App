<x-admin>
        <div class="container text-center mt-5">
            @unless (count($products)==0)
            <form action="{{route('admin.users.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                <label for="" class="form-label">Account type</label>
                <select name="saving_product_id" id="" class="form-select">
                        <option value="">...</option>
                        @foreach ($products as $product)
                            <option value="{{$product->id}}" class="">{{$product->type}}</option>
                        @endforeach
                </select>
                @error('saving_product_id')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-lg-6">
                <label for="" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{old('email')}}">
                @error('email')
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
            <div class="col-lg-6">
                <label for="" class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">...</option>
                    <option value="pending">pending</option>
                    <option value="verified">verified</option>
                </select>
            </div>
            </div>
            
                <button type="submit" class="btn btn-primary mt-5 mb-5">Create user & open account</button>
            </form>
    
            @else 
                    <option value="">No accounts can be created at the moment</option>
                    @endunless
        </div>
</x-admin>