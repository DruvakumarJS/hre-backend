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
                     <label>Client Name : </label> <label class="label-bold">{{$data['name']}}</label>
                  </div>
                   <div style="margin-top: 10px;">
                     <label>Mobile No : </label> <label class="label-bold">{{$data['mobile']}}</label>
                  </div>
                   <div style="margin-top: 10px;">
                     <label>Email ID : </label> <label class="label-bold">{{$data['email']}}</label>
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
                        <div style="margin-top: 10px;">
                           <label>Mobile No : </label> <label class="label-bold">{{$data['old_data']['mobile']}}</label>
                        </div>
                         <div style="margin-top: 10px;">
                           <label>Email ID : </label> <label class="label-bold">{{$data['old_data']['email']}}</label>
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