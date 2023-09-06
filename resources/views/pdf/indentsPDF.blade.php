<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px;
                font-size: 20px !important;
                background-color: #f10909;
                color: white;
                text-align: center;
                line-height: 35px;
                font-weight: bolder;
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 
                font-size: 20px !important;
                background-color: #f2f2f2;
                color: black;
                text-align: center;
                line-height: 35px;
            }

            table, th, td {
              border: 1px solid black;
              border-collapse: collapse;
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            HRE TEAMS
            
        </header>

        <footer>
           <label style="font-size: 17px;">#241/E, 1st floor, 4th Block, HBR Layout, Outer Ring road, Hennur, Bengaluru 560043</label> 
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
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
                <label>{{$indent_details['pcn_details']}}</label>
            </div>
              
                <div  class="card border-white" style="margin-top: 20px;">
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
                                        
                                        @foreach($indent_details['details'] as $key =>$value)
                                         <tr>
                                            <td style="text-align: center; ">{{$key+1}}</td>
                                            <td style="text-align: center; ">{{$value['material_id']}}</td>
                                            <td style="text-align: center; ">{{$value['name']}}</td>
                                            <td style="text-align: center; ">{{$value['brand']}}</td>
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