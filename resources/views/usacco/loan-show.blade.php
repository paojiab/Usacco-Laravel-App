<x-main>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6"><h4>{{$loan->title}} - {{$loanId}}</h4></div>
                    <div class="col-lg-6 text-end">
                        <h5>Loan Balance: UGX {{number_format($loan->balance,2)}}</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('loan.repay', $loan->id)}}" method="post">
                    @csrf
                    <label for="" class="form-label">Wallet Balance</label>
                    <input readonly value="UGX {{number_format(auth()->user()->wallet,2)}}" class="form-control">
                    <label for="" class="form-label">Loan Balance</label>
                    <input readonly value="UGX {{number_format($loan->balance,2)}}" class="form-control">
                    <label for="" class="form-label">Amount</label>
                    <input type="number" name="amount" id="" class="form-control">
                    @error('amount')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                    <button type="button" data-bs-toggle="modal" data-bs-target="#details" class="btn btn-outline-success mt-3 me-5">Details</button>
                    <button type="submit" class="btn btn-primary mt-3">Repay</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="details" aria-labelledby="detailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Loan Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Loan ID</th>
                                    <td>{{"USL/" . auth()->id() . "/" . $loan->id}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Loan Title</th>
                                    <td>{{$loan->title}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Reason</th>
                                    <td>{{$loan->reason}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Principal</th>
                                    <td>UGX {{number_format($loan->principal,2)}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Interest</th>
                                    <td>{{$loan->interest}}%</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Duration</th>
                                    <td>{{$loan->duration}} month(s)</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Disbursed Amount</th>
                                    <td>UGX {{number_format($loan->disburse_amount,2)}}</td>
                                  </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Loan Fee</th>
                                    <td>UGX {{number_format($loan->loan_fee,2)}}</td>
                                  </tr>
                              <tr>
                                <th scope="row">Release Date</th>
                                <td>{{$loan->release_date}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Maturity Date</th>
                                <td>{{$loan->maturity_date}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Status</th>
                                <td>{{$loan->status}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Loan Balance</th>
                                <td>UGX {{number_format($loan->balance,2)}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Guarantor</th>
                                <td>{{$loan->Guarantor}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Collateral</th>
                                <td>{{$loan->collateral}}</td>
                              </tr>
                             
                            </tbody>
                          </table>
                    </div>
                </div>
               
          </div>
        </div>
      </div>
</x-main>