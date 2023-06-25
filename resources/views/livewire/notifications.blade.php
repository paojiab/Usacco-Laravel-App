<div>
    @unless (count($notifications) == 0)
            <div class="card" style="border-bottom: none; border-radius: 5px 0 0">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            @unless(count(auth()->user()->unreadNotifications) == 0)
                                <button class="btn btn-outline-primary" type="button" wire:click="readAll">Mark all as read</button>
                            @endunless
                        </div>
                        <div class="col-6 text-end">
                           <button class="btn btn-primary" type="button" wire:click="clearAll">Clear all</button>
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
                            <button class="btn btn-outline-dark btn-sm" type="button" wire:click="markRead('{{ $notification->id }}')">Mark as read</button>
                            @endif
                            @if($notification->read_at != null)
                            <button class="btn btn-outline-dark btn-sm" type="button" wire:click="unread('{{ $notification->id }}')">Mark as unread</button>
                            </form>
                            @endif
                              
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                               
                                <button class="btn btn-dark btn-sm" type="button" wire:click="remove('{{ $notification->id }}')"><i class="bi bi-trash3-fill"></i></button>
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
