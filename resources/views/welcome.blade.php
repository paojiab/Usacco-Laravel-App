<x-main>
    <section class="container">
        <div class="row mt-5">
            <div class="col-lg-6 mt-5">
                <h1 class="mt-5">Online Sacco</h1>
                <h4>Transact at your convenience</h4>
                @guest
                <a class="btn btn-primary me-5 mt-3 mb-5" href="{{route('register')}}">Signup to Open Account</a>
                @else
                <a class="btn btn-primary me-5 mt-3 mb-5" href="{{route('dashboard')}}">Go to Dashboard</a>
                @endguest
            </div>
            <div class="col-lg-6">
                <img src="{{asset('images/hero-img.png')}}" alt="businessman" class="img-fluid w-75 d-block m-auto mb-5" style="border-radius: 5px;">
            </div>
        </div>
      </section>
</x-main>