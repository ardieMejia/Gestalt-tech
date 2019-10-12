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
            <h1>Member Maintenance</h1>
            <div class="row">
                <div class="col-md-3 border p-4">
                    <div class="text-right">
                        <label>Search</label>
                        <input id="memberSearchInput" type="text" />
                    </div>

                    <br/><br/><br/><br/>
                    <h3>New Member Details</h3>
                    <form class="form" action="/member" method="post">
                        {{ csrf_field() }}
                        <label>Member Number</label><br/>
                        <input type="text" name="member_number" />
                        <br/>
                        <label>First Name</label><br/>
                        <input type="text" name="first_name" />
                        <br/>
                        <label>Last Name</label><br/>
                        <input type="text" name="last_name" />
                        <br/>
                        <label>Date of Birth</label><br/>
                        <input id="datepicker" name="dob" placeholder="MM/DD/YYY" type="text"/>
                        <br/>
                        <label>Email</label><br/>
                        <input type="email" name="email" />
                        <br/>
                        <label>Gender</label><br/>
                        <select name="gender">
                            <option>-</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <br/>
                        <label>Job Title</label><br/>
                        <select name="job_title">
                            <option>-</option>
                            <option value="Software Consultant">Software Consultant</option>
                            <option value="Media Manager I">Media Manager I</option>
                            <option value="Media Manager II">Media Manager II</option>
                            <option value="Media Manager III">Media Manager III</option>
                            <option value="Marketing Manager">Marketing Manager</option>
                        </select>
                        <br/>
                        <br/><br/>
                        <input type="submit" value="Create new member" />
                    </form>

                </div>
                <div class="col-md-9 border p-4">

                    <table id="example2" class="display">

                    </table>
                </div>

            </div>





        </div>

        <script>


            dataSet2 = [
            @foreach ($allMemberData as $memberData)
                {
                "id" : "{{$memberData->id}}",
                "member_number" : "{{$memberData->member_number}}",
                "first_name" : "{{$memberData->first_name}}",
                "last_name" : "{{$memberData->last_name}}",
                "dob" : "{{$memberData->dob->format('d-m-Y')}}",
                "email" : "{{$memberData->email}}",
                "gender" : "{{$memberData->gender}}",
                "job_title" : "{{$memberData->job_title}}",
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
            data: dataSet2,
            columns: [
            { data: "id" },
            { data: "member_number" },
            { data: "first_name" },
            { data: "last_name" },
            { data: "dob" },
            { data: "email" },
            { data: "gender" },
            { data: "job_title" },
            { data: null },
            { data: null },
            ],
            "columnDefs": [
            {
            "targets": -1,
            "render": function (data, type, row){
            // failed to use route() here, instead use this
            editHTMLstring = '<a href="/user/'+'23'+'/edit">Edit</a>';
            return editHTMLstring;
            }
            },
            {
            "targets": -2,
            "render": function (data, type, row){
            // failed to use route() here, instead use this

            // Javascript template literals

            var deleteHTMLstring = `
            <form method="post" action="/user/2">
                {{csrf_field()}}
                <input type="hidden" />
                <input type="hidden" name="_method" value="DELETE">
                <input type="submit" value="delete"/>
            </form>
            `;
            return deleteHTMLstring;
            }
            }
            ]

            } );
             // ---------- wait ----------

             $('#memberSearchInput').on('keyup', function(){
                 mytable.search(this.value).draw();
             });
         } );
        </script>
    </body>
</html>
