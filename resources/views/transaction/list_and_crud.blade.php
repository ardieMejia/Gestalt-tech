<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


    </head>
    <body>
        <div class="container">
            <h1>Transaction Maintenance</h1>
            <div class="row">
                <div class="col-md-3 border p-4">
                    <div class="text-right">
                        <label>Search</label>
                        <input id="transactionSearchInput" type="text" />
                    </div>

                    <br/><br/><br/><br/>
                    <h3>New Transaction Details</h3>
                    <form class="form" action="/transaction" method="post">
                        {{ csrf_field() }}
                        <label>Amount</label><br/>
                        <input type="text" name="amount" />
                        <br/>
                        <label>Transaction Date</label><br/>
                        <input id="datepicker" name="transaction_date" placeholder="MM/DD/YYY" type="text"/>
                        <br/>

                        <label>Member Number</label><br/>
                        <select name="member_number" required>
                            <option value="582-84-8181">582-84-8181</option>
                            <option value="020">020</option>
                        </select>
                        <br/>
                        <br/>
                        <br/><br/>
                        <input type="submit" value="Create new transaction" />
                    </form>

                </div>
                <div class="col-md-9 border p-4">
                    <table id="example2" class="display">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>amount</th>
                                <th>transaction_date</th>
                                <th>member_number</th>

                            </tr>
                        </thead>
                    </table>
                </div>

            </div>





        </div>

        <script>

         
         dataSet2 = [
             @foreach ($allTransactionData as $transactionData)
             {
                 "id" : "{{$transactionData->id}}",
                 "amount" : "{{$transactionData->amount}}",
                 "transaction_date" : "{{$transactionData->transaction_date}}",
                 "member_number" : "{{$transactionData->member_number}}",
             },
             @endforeach

         ];


         $(document).ready(function() {
             // ---------- datepicker ----------
             $('#datepicker').datepicker();
             // ---------- datepicker ----------


             // the rest is datatable stuff



             // ---------- wait ----------
             var mytable = $('#example2').DataTable( {
                 sDom: 'lrtip', // hide original search without disabling filtering
                 data: dataSet2,
                 columns: [
                     { data: "id" },
                     { data: "amount" },
                     { data: "transaction_date" },
                     { data: "member_number" },

                 ],

             } );
             // ---------- wait ----------

             $('#transactionSearchInput').on('keyup', function(){
                 mytable.search(this.value).draw();
             });
         } );
        </script>
    </body>
</html>
