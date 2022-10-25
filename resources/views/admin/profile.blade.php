<x-admin>
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-lg-8">
                
        <h2 class="py-4">Edit Profile</h2>
                <form action="{{route('user.profile.store',$user->id)}}" method="post">
                    @csrf
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" value="{{$user->name}}" id="" class="form-control">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" value="{{$user->email}}" id="" class="form-control">
                    <label for="" class="form-label">Username</label>
                    <input type="text" name="username" value="{{$user->username}}" id="" class="form-control">
                    
            
                    <button type="submit" class="btn btn-primary my-3">Update</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    
</div>
</x-admin>