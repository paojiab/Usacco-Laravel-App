 <div class="">
    @unless (count($notifications) == 0)
            <div class="card" style="border-bottom: none; border-radius: 5px 0 0">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            @unless(count(auth()->user()->unreadNotifications) == 0)
                            <form action="{{route('read.all')}}" method="post" style="display: inline">
                                @csrf
                                <button class="btn btn-outline-primary" style="">Mark all as read</button>
                            </form>
                            @endunless
                        </div>
                        <div class="col-6 text-end">
                           
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
                        <p>
                            {{$notification->data['notify']}}
                        </p>
                        <p class="text-secondary">{{$notification->created_at}}</p>
                        <div class="col-6">
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
                              
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                               
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
