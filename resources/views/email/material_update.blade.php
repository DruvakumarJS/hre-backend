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
            <label style="margin-top: 20px;">Dear All ,</label>
                
                   <div style="margin-top: 20px">
                     <label>Please note that we have updated below mentioned Material in HRE Teams</label>
                   </div>

                    <div style="margin-top: 20px;">
                     <label>Updated Details: </label> 
                   </div>

                   <div style="margin-top: 10px;">
                     <label>Material Name : </label> <label class="label-bold">{{$material_data['new_data']['name']}}</label>
                   </div>
 
                   <div style="margin-top: 10px;">
                     <label>Material Code : </label> <label class="label-bold">{{$material_data['new_data']['item_code']}}</label>
                  </div>

                  <div style="margin-top: 10px;">
                     <label>Material  Brand : </label> <label class="label-bold">{{$material_data['new_data']['brand']}}</label>
                  </div>

                   @php
                   $info = json_decode($material_data['new_data']['information']);
                  @endphp
                   <label>Additional Specification</label>
                  @foreach($info as $key => $val)
                         <div>
                           <label class="label-bold">{{$key}} = {{$val}}</label>
                         </div>       
                     
                  @endforeach

                   @php
                    $domain = url('/');
                  @endphp

                    <div style="margin-top: 20px;">
                     <label class="label-bold">For more details visit : {{$domain}}/view_products/{{$material_data['new_data']['category_id']}}</label>
                 
                  </div>


                   <div style="margin-top: 20px;">
                     <label>Old Details:  </label> 
                   </div>

                   <div style="margin-top: 10px;">
                     <label>Material Name : </label> <label class="label-bold">{{$material_data['old_data']['name']}}</label>
                   </div>
 
                   <div style="margin-top: 10px;">
                     <label>Material Code : </label> <label class="label-bold">{{$material_data['old_data']['item_code']}}</label>
                  </div>

                  <div style="margin-top: 10px;">
                     <label>Material  Brand : </label> <label class="label-bold">{{$material_data['old_data']['brand']}}</label>
                  </div>

                  @php
                   $info2 = json_decode($material_data['old_data']['information']);
                  @endphp
                   <label>Additional Specification</label>
                  @foreach($info2 as $key => $val)
                         <div>
                           <label class="label-bold">{{$key}} = {{$val}}</label>
                         </div>       
                     
                  @endforeach


                  <div style="margin-top: 20px">
                    <label>Request you to update the same in HRE Tally as well.</label>
                  </div>
                  

               
                  <div>
                    <label>Edited By : {{$material_data['employee']['name']}} , {{$material_data['employee']['employee_id']}} ,
                    {{ date('d-m-Y H:i')}}</label>
                  </div>
                 
                 

                  
                 
        </main>
    </body>
</html>