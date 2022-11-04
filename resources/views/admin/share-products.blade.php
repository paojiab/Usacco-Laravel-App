<x-admin>
    <div class="container-fluid mt-3">
        <h4>SHARE PRODUCTS</h4>
        <button class="btn btn-primary btn-sm mt-2 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Create Shares Product</button>
        @unless (count($shares) == 0)
        <div class="table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Share Name</th>
                <th scope="col">Share Price</th>
                <th scope="col">Selling Fee</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($shares as $share)
                <tr>
                    <th scope="row">{{$share->name}}</th>
                    <td>{{number_format($share->price,2)}}</td>
                    <td>{{$share->selling_fee}}%</td>
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
          @else
        <p class="pt-2">No Share products available</p>
        @endunless

        <div class="modal" tabindex="-1" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Create shares Product</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{route('share.store')}}" method="post">
                    @csrf 
                    <label for="name" class="form-label">Name</label>
                    <input name="name" type="text" class="form-control" placeholder="Enter name of new shares product">
                    @error('type')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="price" class="form-label">Share Price</label>
                            <input type="number" name="price" id="" class="form-control">
                            @error('price')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="selling_fee" class="form-label">Selling Fee(%)</label>
                            <input type="number" name="selling_fee" id="" class="form-control">
                            @error('selling_fee')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                       
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
              </div>
            </div>
          </div>
    </div>
</x-admin>