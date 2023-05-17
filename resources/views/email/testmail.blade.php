<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        /* setting the text-align property to center*/
        td {
            padding: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Indent Details  </h1>
    <h2>Indent No : {{$indent_details['indent_no']}}</h2>
    <h3>PCN : {{$indent_details['pcn']}}</h3>

    <div  class="card border-white">
      <table class="table responsive" width="100%">
                          <thead>
                            <tr>
                               <th scope="col">Sl.no</th>
                               <th scope="col">Material Id</th>
                               <th scope="col">Material Name</th> 
                               <th scope="col">Brand</th>
                                <th scope="col">Description</th>                          
                                <th scope="col">Total Quantity</th>
                           
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($indent_details['details'] as $key => $value)
                            
                             <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value['material_id']}}</td>
                               
                             </tr>
                            @endforeach
                            
                            
                          </tbody>
                        </table>

    
    </div>

    
</body>
</html>