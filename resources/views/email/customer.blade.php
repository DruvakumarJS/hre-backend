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
            <label style="margin-top: 20px;">Hi ,Please find the Client details</label>
           
                   <div style="margin-top: 10px;">
                     <label>Client Name : </label> <label class="label-bold">{{$data['details']['name']}}</label>
                  </div>
                   
                   <label>Contact Details</label>

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
                    <label >Brand and details</label>
                     @foreach($data['address'] as $key=>$value)
                     <div>
                       <label style="font-weight: bold;">{{$value['brand']}}, {{$value['state']}} , {{$value['gst']}} </label>
                     </div>

                     @endforeach
                  </div>

                  @if(isset($data['old_data']))
                      <div style="margin-top: 20px;" style="border-width: 1px;border-color: black;">
                        <label style="font-weight: bold;">-----Previous Details-----</label>
                        <div style="margin-top: 10px;">
                           <label>Client Name : </label> <label class="label-bold">{{$data['old_data']['name']}}</label>
                        </div>
                       
                       <label>Contact Details</label>

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
                          <label >Brand and Details</label>
                           @foreach($data['old_data']['address'] as $key2=>$value2)
                           <div>
                             <label style="font-weight: bold;">{{$value2['brand']}}, {{$value2['state']}} , {{$value2['gst']}} </label>
                           </div>

                           @endforeach
                        </div>
                      </div>
                      

                  @endif


                  @php
                    $domain = url('/');
                  @endphp
                   <div style="margin-top: 20px;">
                      <label class="label-bold" >For more details visit : {{$domain}}/view_customers</label>
                   </div>                 
                 
                 
        </main>
    </body>
</html>