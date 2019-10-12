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
            <h1>Transation Enquiry</h1>
            <div class="row">
                <div class="col-md-4 border p-4">


                </div>
                <div class="col-md-8 border p-4">
                    <table>
                        <tr>
                            <th>Job Title</th>
                            <th>Total Transaction Amount</th>
                            <th>Average <small>(example: "average transactions done by an Accountant Assistant")</small></th>
                        </tr>
                        @foreach ($transArray as $eachTransItem)
                            <tr>
                                <td>
                                    @if($eachTransItem["job_title"] == "")
                                        ---
                                    @else
                                        {{$eachTransItem["job_title"]}}
                                    @endif

                                </td>
                                <td>{{$eachTransItem["count"]}}</td>
                                <td>{{$eachTransItem["average"]}}</td>
                            </tr>
                        @endforeach

                    </table>

                </div>

            </div>





        </div>


    </body>
</html>
