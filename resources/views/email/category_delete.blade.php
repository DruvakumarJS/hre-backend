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
                     <label>Please note that user have deleted the below mentioned Material Category in HRE Teams</label>
                   </div>

                   <div style="margin-top: 20px;">
                     <label>Category Name : </label> <label class="label-bold">{{$category_data['new_data']['category']}}</label>
                   </div>

                   <div style="margin-top: 10px;">
                     <label>Category Code : </label> <label class="label-bold">{{$category_data['new_data']['material_category']}}</label>
                  </div>

                   @php
                    $domain = url('/');
                  @endphp

                    <div style="margin-top: 20px;">
                     <label class="label-bold">For more details visit : {{$domain}}/settings/Material-master</label>
                 
                  </div>

                  <div style="margin-top: 20px">
                    <label>Request you to double check with the user and if required update the same in HRE Tally as well.
</label>
                  </div>
                  

               
                  <div>
                    <label>Deleted By : {{$category_data['employee']['name']}} , {{$category_data['employee']['employee_id']}} ,
                    {{ date('d-m-Y H:i')}}</label>
                  </div>
                 
                 

                  
                 
        </main>
    </body>
</html>