<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  text-align: left;
  padding: 8px;
}

th{
  background-color: #4b7be5;
  color: white;
}

tr:nth-child(even) {
  background-color: #edeff5;
}

.blue{
  color: #4b7be5
}

.grey{
  color: grey
}

.row::after{
display: flex;
content: "";
  display: table;
  clear: both;
}
.column{
  float: left;
  width: 25%;
}
.column-x{
  float: left;
  width: 50%;
}
.right{
  text-align: right
}
.center{
  text-align: center
}
</style>
</head>
<body>

  <h1 class="blue">USACCO</h1>
  <p class="blue">Online Sacco</p>
<br>

<div class="row">
  <div class="column-x">
    <h4>{{$account->savingProduct->type}} Statement</h4>
<p class="grey">Details as on {{$now}}</p>
  </div>
  <div class="column-x right">
    <h4>Account Number: {{$account->acct_no}}</h4>
<p class="grey">Account Name: {{$account->first_name . ' ' . $account->last_name}}</p>
  </div>
</div>

<br>

<div class="row">
  <div class="column">
    <p class="grey">From date</p>
    <h4>{{$from}}</h4>
  </div>
  <div class="column">
    <p class="grey">To date</p>
  <h4>{{$to}}</h4>
  </div>
  <div class="column center">
    <p class="grey">Opening balance:</p>
<h4>UGX {{number_format($opening_balance,2)}}</h4>
  </div>
  <div class="column center">
    <p class="grey">Closing balance:</p>
    <h4>UGX {{number_format($closing_balance,2)}}</h4>
  </div>
</div>



<br>

<table>
    <thead>
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Transaction</th>
          <th scope="col">Amount</th>
          <th scope="col">Fee</th>
          <th scope="col">Balance</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($txns as $txn)
        <tr>
          <td scope="row">{{$txn->created_at->toDateString()}}</td>
          <td>{{$txn->txn_type}}</td>
          <td>{{number_format($txn->amount,2)}}</td>
          <td>{{number_format($txn->fee,2)}}</td>
          <td>{{number_format($txn->balance,2)}}</td>
        </tr>
        @endforeach
       
      </tbody>
 
</table>

</body>
</html>
