<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
           body {
            font-family: 'Helvetica', sans-serif;
            font-size: 14px;
           /* font-family: 'Calibri';
            src: url('/fonts/Calibri.woff2') format('woff2'),
                url('/fonts/Calibri.woff') format('woff');
            font-weight: normal;
            font-style: normal;
            font-display: swap;*/

          }
            @page {
                margin: 25px 25px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px;
                font-size: 20px !important;
                /*background-color: #f10909;*/
                color: white;
                text-align: center;
                line-height: 35px;
                font-weight: bolder;

            }

            footer {
                position: fixed; 
                bottom: 20px; 
                left: 0px; 
                right: 0px;
                height: 50px; 
                font-size: 20px !important;
                background-color: #f10909;
                color: white;
                text-align: center;
                line-height: 35px;

            }

            table, th, td {
              border: 1px solid black;
              border-collapse: collapse;
          }
          div{

          }
        </style>

         <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Calibri:wght@400;700&display=swap">

    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
       
        <footer>
           <label style="font-size: 17px;">#241/E, 1st floor, 4th Block, HBR Layout, Outer Ring road, Hennur, Bengaluru 560043</label> 
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main style="padding-left: : 30px;padding-right: 30px;padding-top: 10px;padding-bottom: 10px;">
            
            <div style="display: grid;place-items: center;">
              <img src="data:image/svg;base64,{{base64_encode(file_get_contents(public_path('images/hre_logo.png')))}}" alt="" style="height: 100px; width: 100px;">
              <label style="font-weight: bolder;font-size: 20px;text-align: center;display: grid;place-items: center;"> Material Indent</label>

            </div>
             
            <div>
                <label>Date : </label> <label>{{date('d-m-Y')}}</label>
            </div>

             <div style="margin-top: 10px;">
                <label>Created By : </label> <label>{{$indent_details['creator']}}</label>
            </div>
            <div style="margin-top: 10px;">
                <label>Indent No : </label> <label>{{$indent_details['indent_no']}}</label>
            </div>

             <div style="margin-top: 10px;">
                <label>PCN : </label> <label>{{$indent_details['pcn']}}</label>
            </div>
            <div style="margin-top: 10px;">
                <label>PCN Details : </label><label>{{$indent_details['pcn_details']}}</label>
            </div>
              
                <div  class="card border-white" style="margin-top: 20px;">
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
                                                            <td style="border:none;">{{$key}} = {{$val}}</td>
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