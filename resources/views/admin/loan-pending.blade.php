<x-admin>
    <div class="container-fluid mt-3">
        <h4>LOANS</h4>
        
        @unless (count($loans) == 0)
        <table class="table-responsive table">
          <tbody>
            <tr>
              <th>Title</th>
              <th>Principal</th>
              <th>Interest</th>
              <th>Loan fee</th>
              <th>Disburse amount</th>
              <th>Status</th>
              <th>Release date</th>
              <th>Maturity date</th>
              <th>Loan balance</th>
              <th>Action</th>
            </tr>
            @foreach ($loans as $loan)
            <tr>
              <th scope="row">{{$loan->title}}</th>
              <td>UGX {{number_format($loan->principal,2)}}</td>
              <td>{{$loan->interest}}%</td>
              <td>UGX {{number_format($loan->loan_fee, 2)}}</td>
              <td>UGX {{number_format($loan->disburse_amount, 2)}}</td>
              <td>{{$loan->status}}</td>
              @unless ($loan->release_date == null)
              <td>{{$loan->release_date}}</td>
              @else 
              <td class="text-center">-</td>
              @endunless
              @unless ($loan->maturity_date == null)
              <td>{{$loan->maturity_date}}</td>
              @else 
              <td class="text-center">-</td>
              @endunless
              @unless ($loan->balance == null)
              <td>UGX {{number_format($loan->balance,2)}}</td>
              @else 
              <td class="text-center">-</td>
              @endunless
             <td><a href="{{route('loan.review', $loan->id)}}" class="btn btn-warning btn-sm">Review</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="d-flex mb-5">
          {!! $loans->links() !!}
      </div>
      @else
      <p class="py-2">No Pending Loans Available</p>
      @endunless

</div>
</x-admin>