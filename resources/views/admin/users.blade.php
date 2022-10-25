<x-admin>
        <div class="container-fluid mt-3">
            <h4>Members</h4>
            <a href="{{route('admin.users.register')}}" class="btn btn-primary btn-sm mt-2 mb-2">Register new member & account</a>
            @unless (count($users) == 0)
            <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Registration Date</th>
                    <th scope="col">Details</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{$user->name}}</th>
                        <td>{{$user->email}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                              <a href="{{route('member', $user->id)}}" class="btn btn-success btn-sm" type="submit">View</a>
                      </td>
                        <td>
                            <form action="" method="post">
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
              <div class="d-flex">
                {!! $users->links() !!}
            </div>
              @else
            <p class="pt-2">No users available</p>
            @endunless
        </div>
</x-admin>