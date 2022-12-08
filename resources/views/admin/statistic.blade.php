<x-admin>
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h2">Usacco All Time Statistics</h1>
            </div>
            <div class="col-lg-6 text-end">
                <button class="btn btn-primary btn-sm">Generate Report</button>
            </div>
        </div>
        </div>
        <h3 class="mb-4">SAVINGS</h3>
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8 text-end">
                            <h4 >{{$users}}</h4>
                            <p>Users</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8 text-end">
                            <h4>{{$accounts}}</h4>
                            <p>Saving Accounts</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8 text-end">
                            <h4 >{{$deposits}}</h4>
                            <p>Total Deposits</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8 text-end">
                            <h4 >{{$withdraws}}</h4>
                            <p>Total Withdraws</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
          

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        
                        <div class="col text-end">
                            <h4 >{{number_format($savings)}}/=</h4>
                            <p>Savings Balance</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        
                        <div class="col text-end">
                            <h4 >{{number_format($wFee)}}/=</h4>
                            <p>Withdraw Fees</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8 text-end">
                            <h4 >{{number_format($interest)}}/=</h4>
                            <p>Interest Paid</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                       
                        <div class="col text-end">
                            <h4 >{{$inactive}}</h4>
                            <p>Inactive Accounts</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            
        </div>

        <div class="row mt-4">
           
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8 text-end">
                            <h4 >{{$closed}}</h4>
                            <p>Closed Accounts</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        
                        <div class="col text-end">
                            <h4 >{{number_format($close)}}/=</h4>
                            <p>Closed Accounts Bal</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            
           

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        
                        <div class="col text-end">
                            <h4 >{{$sTxns}}</h4>
                            <p>Saving Transactions</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        
                        <div class="col text-end">
                            <h4 >{{number_format($deposit)}}/=</h4>
                            <p>Deposits</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                       
                        <div class="col text-end">
                            <h4 >{{number_format($withdraw)}}/=</h4>
                            <p>Withdraws</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
           

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                       
                        <div class="col text-end">
                            <h4 >{{number_format($inactiv)}}/=</h4>
                            <p>Inactive Accounts Bal</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            
        </div>
</x-admin>