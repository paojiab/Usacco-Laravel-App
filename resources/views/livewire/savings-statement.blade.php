<div class="text-center mt-3">
    <h3 class="pb-3" style="display: inline;">Savings Statement</h3>
    @unless (count($txns)==0)
    <div class="dropdown"  style="display: inline;">
      <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Download
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="" wire:click.prevent="month">30 Days</a></li>
        {{-- <li><a class="dropdown-item" href="{{route('savings.quarter',$account->id)}}">90 Days</a></li>
        <li><a class="dropdown-item" href="{{route('savings.half',$account->id)}}">180 Days</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="{{route('savings.stat',$account->id)}}">All time</a></li> --}}
      </ul>
    </div>
    <div class="table-responsive">
    <table class="table">
        <thead>
          <tr>
            <th scope="col" class="d-none d-lg-block">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Transaction</th>
            <th scope="col">Amount</th>
            <th scope="col" class="d-none d-lg-block">Fee</th>
            <th scope="col">Balance</th>
          </tr>
        </thead>
        <tbody>
         
          @foreach ($txns as $txn)
          <tr>
            <th scope="row" class="d-none d-lg-block">{{$txn->created_at}}</th>
            <td >{{$txn->created_at->diffForHumans()}}</td>
            <td>{{$txn->txn_type}}</td>
            <td>{{number_format($txn->amount,2)}}</td>
            <td class="d-none d-lg-block">{{number_format($txn->fee,2)}}</td>
            <td>{{number_format($txn->balance,2)}}</td>
          </tr>
          @endforeach
          @else 
          <p class="fst-italic pt-2">No transactions to show</p>
          @endunless
         
         
        </tbody>
      </table>
    </div>
      <div class="d-flex mb-5">
        {{ $txns->links() }}
    </div>
</div>
