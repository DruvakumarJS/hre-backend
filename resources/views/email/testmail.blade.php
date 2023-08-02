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
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            HRE- One Stop Solution
            
        </header>

        <footer>
            Copyright © <?php echo date("Y");?> - techsolutionstuff.com
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <div>
                <label>Date : </label> <label>{{date('d-m-Y')}}</label>
            </div>

             <div>
                <label>Created By : </label> <label>{{$indent_details['creator']}}</label>
            </div>

                <h4>Indent No : {{$indent_details['indent_no']}}</h4>
                <h5>PCN : {{$indent_details['pcn']}}</h5>

                <div  class="card border-white">
                  <table class="table responsive" width="100%">
                                      <thead>
                                        <tr>
                                           <th scope="col">Sl.no</th>
                                           <th scope="col">Material Id</th>
                                           <th scope="col">Material Name</th> 
                                           <th scope="col">Brand</th>                        
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
                                            <td style="text-align: center; ">{{$value['quantity']}}</td>
                                          
                                         </tr>
                                        @endforeach
                                        
                                        
                                      </tbody>
                                    </table>

                
                </div>
                        
        </main>
    </body>
</html>