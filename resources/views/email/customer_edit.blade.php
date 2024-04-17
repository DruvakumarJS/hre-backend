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
        <main style="padding: 30px;margin-top: 20px;">
                <label style="margin-top: 20px;">Dear Team ,</label>
           
                   <div style="margin-top: 10px;">
                     <label>Please find the modified or added Customer details in our Database.</label> 
                  </div>

                  <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Client Billing Name : </label><label>{{$data['details']['name']}}</label> 
                  </div>
                   
                   <label>Client's Contact Details</label>

                   <div  class="card border-white" style="margin-top: 10px;">
                     <table class="table responsive" width="100%">
                                      <thead>
                                        <tr>
                                           <th scope="col">Name</th>
                                           <th scope="col">Designation</th>
                                           <th scope="col">Mobile Number</th> 
                                           <th scope="col">Email ID</th>
                                           
                                        </tr>
                                      </thead>
                                      <tbody>
                                        
                                         <tr>
                                            <td style="text-align: center; ">{{$data['details']['full_name']}}</td>
                                            <td style="text-align: center; ">{{$data['details']['designation']}}</td>
                                            <td style="text-align: center; ">{{$data['details']['mobile']}}</td>
                                            <td style="text-align: center; ">{{$data['details']['email']}}</td>
                                           
                                         </tr>

                                         <tr>
                                            <td style="text-align: center; ">{{$data['details']['full_name1']}}</td>
                                            <td style="text-align: center; ">{{$data['details']['designation1']}}</td>
                                            <td style="text-align: center; ">{{$data['details']['mobile1']}}</td>
                                            <td style="text-align: center; ">{{$data['details']['email1']}}</td>
                                           
                                         </tr>

                                         <tr>
                                            <td style="text-align: center; ">{{$data['details']['full_name2']}}</td>
                                            <td style="text-align: center; ">{{$data['details']['designation2']}}</td>
                                            <td style="text-align: center; ">{{$data['details']['mobile2']}}</td>
                                            <td style="text-align: center; ">{{$data['details']['email2']}}</td>
                                           
                                         </tr>

                                         <tr>
                                            <td style="text-align: center; ">{{$data['details']['full_name3']}}</td>
                                            <td style="text-align: center; ">{{$data['details']['designation3']}}</td>
                                            <td style="text-align: center; ">{{$data['details']['mobile3']}}</td>
                                            <td style="text-align: center; ">{{$data['details']['email3']}}</td>
                                           
                                         </tr>
                                       
                                        
                                        
                                      </tbody>
                                    </table>

                
                </div>

                   

                  <div style="margin-top: 10px;">
                    <label >Project / Brand Details</label>
                    
                     <div  class="card border-white" style="margin-top: 10px;">
                     <table class="table responsive" width="100%">
                                      <thead>
                                        <tr>
                                           <th scope="col">Project Name</th>
                                           <th scope="col">State</th>
                                           <th scope="col">GST number</th>
                                           
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($data['address'] as $key=>$value)
                                        
                                         <tr>
                                            <td style="text-align: center; ">{{$value['brand']}}</td>
                                            <td style="text-align: center; ">{{$value['state']}}</td>
                                            <td style="text-align: center; ">{{$value['gst']}}</td>
                                            
                                         </tr>

                                        @endforeach
                                        
                                        
                                      </tbody>
                                    </table>

                
                </div>

                  </div>

                  <label>---------- Previous Deatils ----------</label>

                  <div>
                    <label>Client's Contact Details</label>
                  </div>
                   <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Client Billing Name : </label><label>{{$data['old_data']['name']}}</label> 
                  </div>
                  

                   <div  class="card border-white" style="margin-top: 10px;">
                     <table class="table responsive" width="100%">
                                      <thead>
                                        <tr>
                                           <th scope="col">Name</th>
                                           <th scope="col">Designation</th>
                                           <th scope="col">Mobile Number</th> 
                                           <th scope="col">Email ID</th>
                                           
                                        </tr>
                                      </thead>
                                      <tbody>
                                        
                                         <tr>
                                            <td style="text-align: center; ">{{$data['old_data']['full_name']}}</td>
                                            <td style="text-align: center; ">{{$data['old_data']['designation']}}</td>
                                            <td style="text-align: center; ">{{$data['old_data']['mobile']}}</td>
                                            <td style="text-align: center; ">{{$data['old_data']['email']}}</td>
                                           
                                         </tr>

                                         <tr>
                                            <td style="text-align: center; ">{{$data['old_data']['full_name1']}}</td>
                                            <td style="text-align: center; ">{{$data['old_data']['designation1']}}</td>
                                            <td style="text-align: center; ">{{$data['old_data']['mobile1']}}</td>
                                            <td style="text-align: center; ">{{$data['old_data']['email1']}}</td>
                                           
                                         </tr>

                                         <tr>
                                            <td style="text-align: center; ">{{$data['old_data']['full_name2']}}</td>
                                            <td style="text-align: center; ">{{$data['old_data']['designation2']}}</td>
                                            <td style="text-align: center; ">{{$data['old_data']['mobile2']}}</td>
                                            <td style="text-align: center; ">{{$data['old_data']['email2']}}</td>
                                           
                                         </tr>

                                         <tr>
                                            <td style="text-align: center; ">{{$data['old_data']['full_name3']}}</td>
                                            <td style="text-align: center; ">{{$data['old_data']['designation3']}}</td>
                                            <td style="text-align: center; ">{{$data['old_data']['mobile3']}}</td>
                                            <td style="text-align: center; ">{{$data['old_data']['email3']}}</td>
                                           
                                         </tr>
                                       
                                        
                                        
                                      </tbody>
                                    </table>

                
                </div>

                   

                  <div style="margin-top: 10px;">
                    <label >Project / Brand Details</label>
                    
                     <div  class="card border-white" style="margin-top: 10px;">
                     <table class="table responsive" width="100%">
                                      <thead>
                                        <tr>
                                           <th scope="col">Project Name</th>
                                           <th scope="col">State</th>
                                           <th scope="col">GST number</th>
                                           
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($data['old_data']['address'] as $key=>$value)
                                        
                                         <tr>
                                            <td style="text-align: center; ">{{$value['brand']}}</td>
                                            <td style="text-align: center; ">{{$value['state']}}</td>
                                            <td style="text-align: center; ">{{$value['gst']}}</td>
                                            
                                         </tr>

                                        @endforeach
                                        
                                        
                                      </tbody>
                                    </table>

                
                </div>

                  </div>



                  <div  style="margin-top: 20px;">
                    <label> Modified By : {{$data['details']['employee_name']}} , {{$data['details']['employee_id']}} , {{ date('d-m-Y H:i')}}</label>
                  </div>



                  
                  @php
                    $domain = url('/');
                  @endphp
                   <div style="margin-top: 20px;">
                      <label class="label-bold" >For more details visit : {{$domain}}/view_customers</label>
                   </div>                 
                 
                 
        </main>
    </body>
</html>