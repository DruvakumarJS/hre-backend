<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
           .label-bold{
              font-weight: bold;
              font-size: 15px;
          }
            @page {
                margin: 100px 25px;
            }

        
            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 
                font-size: 20px !important;
                background-color: #f2f2f2;
                color: white;
                text-align: center;
                line-height: 35px;
            }
        </style>
    </head>
    <body >
        <!-- Define header and footer blocks before your content -->
        
        <!-- Wrap the content of your PDF inside a main tag -->
        <main style="padding: 30px;">
            <div style="margin-top: 10px;">
                <label>Date : </label> <label class="label-bold">{{date('d-m-Y')}}</label>
            </div>

             <div>
                <label>Created By : </label> <label class="label-bold">{{$indent_details['creator']}}</label>
            </div>

            <div>
                <label>Indent No : </label> <label class="label-bold">{{$indent_details['indent_no']}}</label>
            </div>

             <div>
                <label>PCN : </label> <label class="label-bold">{{$indent_details['pcn']}}</label>
            </div>
               <label>{{$indent_details['pcn_details']}}</label>
            <div>
                  @php
                    $domain = url('/');
                  @endphp
                <label>View on Dashboard : </label> <label class="label-bold">{{$domain}}/indent_details/{{$indent_details['indent_no']}}</label>
            </div>

               
                <div  class="card border-white" style="margin-top: 10px;">
                  <table class="table responsive" width="100%">
                                      <thead>
                                        <tr>
                                           <th scope="col">Sl.no</th>
                                           <th scope="col">Material Id</th>
                                           <th scope="col">Material Category</th>
                                           <th scope="col">Material Name</th> 
                                           <th scope="col">Brand</th>
                                           <th scope="col">Specifications</th>
                                           <th scope="col">Description</th>                        
                                           <th scope="col">Total Quantity</th>
                                       
                                        </tr>
                                      </thead>
                                      <tbody>
                                        
                                        @foreach($indent_details['details'] as $key =>$value)
                                         <tr>
                                            <td style="text-align: center; ">{{$key+1}}</td>
                                            <td style="text-align: center; ">{{$value['material_id']}}</td>
                                            <td style="text-align: center; ">{{$value['category']}}</td>
                                            <td style="text-align: center; ">{{$value['name']}}</td>
                                            <td style="text-align: center; ">{{$value['brand']}}</td>
                                            <td>
                                            <table style=" border: 1px ;border-collapse: collapse;" width="100%">
                                              <tbody >
                                                @php
                                                 $info = json_decode($value['features']);
                                                @endphp

                                                @foreach($info as $key => $val)
                                                  
                                                        <tr>
                                                            <td style="border:none;text-align: center;">{{$key}} = {{$val}}</td>
                                                        </tr>
                                                   
                                                @endforeach
                                              </tbody>
                                            </table>
                                            </td>
                                            <td style="text-align: center; ">{{$value['comments']}}</td>
                                            <td style="text-align: center; ">{{$value['quantity']}} {{$value['uom']}}</td>
                                          
                                         </tr>
                                        @endforeach
                                        
                                        
                                      </tbody>
                                    </table>

                
                </div>
                        
        </main>
    </body>
</html>