<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="BOP">
    <title>USACCO</title>
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


<meta name="theme-color" content="#712cf9">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow" style="background-color: #4b7be5">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">USACCO</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      {{-- <a class="nav-link px-3" href="#">Sign out</a> --}}
      <form action="{{route('admin.logout')}}" method="get">
        @csrf
      <button type="submit" class="btn btn-primary btn-sm text-white" style="border: none; background-color: #4b7be5">Sign out</button>
    </form>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('admin.dashboard')}}">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.users')}}">
              <span data-feather="file" class="align-text-bottom"></span>
              Members
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.accounts')}}">
              <span data-feather="shopping-cart" class="align-text-bottom"></span>
              Accounts
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('saving.products')}}">
              <span data-feather="bar-chart-2" class="align-text-bottom"></span>
              Saving Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('share.products')}}">
              <span data-feather="bar-chart-2" class="align-text-bottom"></span>
              Share Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('welfare.products')}}">
              <span data-feather="bar-chart-2" class="align-text-bottom"></span>
              Welfare Product
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('loan.products')}}">
              <span data-feather="bar-chart-2" class="align-text-bottom"></span>
              Loan Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.loans')}}">
              <span data-feather="bar-chart-2" class="align-text-bottom"></span>
              Loans
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.loans')}}">
              <span data-feather="bar-chart-2" class="align-text-bottom"></span>
              Collateral Register
            </a>
          </li>
          
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>More</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle" class="align-text-bottom"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text" class="align-text-bottom"></span>
                 Notifications
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.finances')}}">
                  <span data-feather="file-text" class="align-text-bottom"></span>
                 Accounting
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('monthly.cashflow')}}">
                  <span data-feather="file-text" class="align-text-bottom"></span>
                 Cashflow
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('profit.loss')}}">
                  <span data-feather="file-text" class="align-text-bottom"></span>
                 Profit/Loss
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('balance.sheet')}}">
                  <span data-feather="file-text" class="align-text-bottom"></span>
                 Balance Sheet
                </a>
              </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.statistics')}}">
              <span data-feather="file-text" class="align-text-bottom"></span>
              Statistics
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text" class="align-text-bottom"></span>
              Charts
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text" class="align-text-bottom"></span>
              Supervisors
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text" class="align-text-bottom"></span>
              Settings
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      
        @if (session('status'))
        <div class="container-fluid alert alert-success mt-3" role="alert">
            {{ session('status') }}
        </div>
    @endif
       
        {{$slot}}
     
    </main>
  </div>
</div>

 <!--Bootstrap JavaScript Bundle with Popper -->
 <script
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
 crossorigin="anonymous"
></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html> 