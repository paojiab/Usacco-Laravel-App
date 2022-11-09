<x-admin>
    <div class="container-fluid mt-3">
        <h4>WELFARE PRODUCT</h4>
        
        @unless (count($products) == 0)
        <div class="table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Contribution Fee</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <th scope="row">{{$product->name}}</th>
                    <td>{{number_format($product->contribution,2)}}</td>
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
        <p class="pt-2">No Welfare product available</p>
        <button class="btn btn-primary btn-sm mt-2 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Create Welfare Product</button>
        @endunless

        <div class="modal" tabindex="-1" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Create Welfare Product</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{route('welfare.store')}}" method="post">
                    @csrf 
                    <label for="name" class="form-label">Name</label>
                    <input name="name" type="text" class="form-control" placeholder="Enter name of new shares product">
                    @error('type')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                   
                            <label for="contribution" class="form-label">Share Price</label>
                            <input type="number" name="contribution" id="" class="form-control">
                            @error('contribution')
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
    </div>
</x-admin>