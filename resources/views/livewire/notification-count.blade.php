<div>
    @if($notificationsCount > 99)) 
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">99+</span>
    @elseif($notificationsCount == 0)
    <span></span>
  @else 
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{$notificationsCount}}</span>
  @endif
</div>
