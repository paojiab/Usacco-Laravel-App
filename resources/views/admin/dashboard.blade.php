<p>DASHBOARD</p>

<p>Name: {{Auth::guard('admin')->user()->name}}</p>

<p>Username: {{Auth::guard('admin')->user()->username}}</></p>

<p>Email: {{Auth::guard('admin')->user()->email}}</p>

<a href="/admin/logout">Logout</a>