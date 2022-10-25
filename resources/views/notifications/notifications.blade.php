<x-main>
 <div class="container mt-4 mb-5">
    @unless (count($notifications) == 0)
            <div class="card" style="border-bottom: none; border-radius: 5px 0 0">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>Notifications</h5>
                        </div>
                        <div class="col-lg-6 text-end">
                            @unless(count(auth()->user()->unreadNotifications) == 0)
                            <form action="{{route('read.all')}}" method="post" style="display: inline">
                                @csrf
                                <button class="btn btn-outline-primary" style="">Mark all as read</button>
                            </form>
                            @endunless
                            <form action="{{route('clear.all')}}" method="post" style="display: inline">
                                @csrf
                           <button class="btn btn-primary" type = "submit">Clear all</button>
                        </form>
                        
                        </div>
                    </div>
                </div>
            </div>
            
            @foreach ($notifications as $notification)
            @if ($notification->read_at == null)
            <div class="card" style="border-radius: 0; background-color: lightgray; border-top: none;">
           @else 
            <div class="card" style="border-radius: 0; border-top: none;">
                @endunless
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                                    <p>
                                        {{$notification->data['notify']}}
                                    </p>
                                    <p class="text-secondary">{{$notification->created_at}}</p>
                              
                        </div>
                        <div class="col-lg-4">
                            <div class="text-end">
                                @if($notification->read_at == null)
                                <form action="mark/read/{{$notification->id}}" method="post" style="display: inline">
                                    @csrf
                                <button class="btn btn-outline-dark btn-sm" type="submit">Mark as read</button>
                                </form>
                                @endif
                                @unless($notification->read_at == null)
                                <form action="unread/{{$notification->id}}" method="post" style="display: inline">
                                    @csrf
                                <button class="btn btn-outline-dark btn-sm" type="submit">Mark as unread</button>
                                </form>
                                @endunless
                                <form action="remove/{{$notification->id}}" method="post" style="display: inline">
                                    @csrf
                                <button class="btn btn-dark btn-sm" type="submit"><i class="bi bi-trash3-fill"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else 
            <p class="text-center">No Notifications available</p>
            @endunless
           
        
</div>

</x-main>