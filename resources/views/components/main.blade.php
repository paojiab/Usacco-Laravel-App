<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
    <!-- Bootstrap icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    />
    <title>USACCO</title>
  </head>
  <body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg" style="background-color: #4b7be5">
      <div class="container-fluid">
        <a class="navbar-brand text-white" href="{{route('dashboard')}}">USACCO</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav m-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-white" href="{{route('wallet')}}">Wallet</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{route('dashboard')}}">Savings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{route('shares')}}">Shares</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{route('loans')}}">Loans</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{route('welfare')}}">Welfare</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{route('portfolio')}}">Portfolio</a>
            </li>
          </ul>

          @auth
          
        <div class="nav-item dropdown text-white">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{auth()->user()->name}} <i class="bi bi-person-fill"></i
                  >
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/user/profile">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{route('logout')}}" method="post">
                @csrf
                <button class="btn btn-primary d-block m-auto" type="submit">Logout</button>
              </form>
            </li>
          </ul>
        </>
      </div>
      {{-- Notifications --}}
      @unless(count(auth()->user()->unreadNotifications) == 0)
      <div class="position-relative me-2">
      <a class="nav-link text-white me-2 ms-3" href="{{route('notifications')}}"
          >Notifications
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          @if(count(auth()->user()->unreadNotifications) > 99)) 
            99+
          @else 
            {{count(auth()->user()->unreadNotifications)}}
          @endif
        </span>
      </a>
    </div>
    @else
    <a class="nav-link text-white me-2 ms-3" href="{{route('notifications')}}">Notifications</a>
    @endunless
    {{-- End notifications --}}
          @else
          <a class="nav-link text-white me-3" href="{{route('login')}}"
          >Signin</a>
          @endauth
          
        </div>
        
      </div>
    </nav>
    {{-- End Navbar --}}

    @if (session('status'))
            <div class="container alert alert-success mt-3" role="alert">
                {{ session('status') }}
            </div>
        @endif

    {{$slot}}

    <footer class="text-white p-2 text-center fixed-bottom" style="background-color: #4b7be5;">
      &copy; USACCO  <script>
        document.write(new Date().getFullYear())
    </script>. All rights reserved.
    </footer>

    <!--Bootstrap JavaScript Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
