<x-admin>
        <div class="container-fluid mt-3">
            <h4>Users</h4>
            <button class="btn btn-primary mt-2 mb-2" type="button" data-bs-toggle="modal" data-bs-target="#deposit">Create User</button>
            @unless (count($users) == 0)
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Created</th>
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
                            <form action="" method="post">
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              <div class="d-flex">
                {!! $users->links() !!}
            </div>
              @else
            <p class="pt-2">No users available</p>
            @endunless
        </div>
</x-admin>