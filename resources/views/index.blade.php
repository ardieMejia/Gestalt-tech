<!doctype html>
<html>
  <head>
    <title>Import CSV Data to MySQL database with Laravel</title>
  </head>
  <body>
     <!-- Message -->
     @if(Session::has('message'))
        <p >{{ Session::get('message') }}</p>
     @endif

         @if(Session::has('ignored_rows'))
             <h4>{{ Session::get('ignored_rows') }} ignored rows</h4>
         @endif
         @if(Session::has('ignored'))
             @php $ignored = Session::get('ignored'); @endphp
             <h4>First 5 ignored :</h4>
             <ul>
                 @for($i=0;$i<5;$i++)
                     <li>{{ $ignored[$i]["id"] }}, {{ $ignored[$i]["first_name"] }}, {{ $ignored[$i]["last_name"] }}</li>
                 @endfor
             </ul>
         @endif

     <!-- Form -->
     <form method='post' action='/uploadFile' enctype='multipart/form-data' >
       {{ csrf_field() }}
       <input type='file' name='file' >
       <input type='submit' name='submit' value='Import'>
     </form>
  </body>
</html>
