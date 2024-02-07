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
                  <label style="margin-top: 20px;">Dear All,</label>

                  <div style="margin-top: 20px;">
                    <label>Please note the attendance logout time is modified or out of office is marked.</label>
                  </div>

                  <div style="margin-top: 20px;">
                     <label>Employee name : </label> <label class="label-bold">{{$attendancearray['name']}}</label>
                  </div>
                   <div style="margin-top: 10px;">
                     <label>Employee ID : </label> <label class="label-bold">{{$attendancearray['employee_id']}}</label>
                  </div>
                   <div style="margin-top: 10px;">
                     <label >{{$attendancearray['body']}}</label> 
                  </div>

                  <div style="margin-top: 20px;">
                     <label>The above details are Edited by</label> <label class="label-bold">{{$attendancearray['editor_name']}} - {{$attendancearray['editor_id']}}</label> 
                  </div>
                  @php
                    $domain = url('/');
                  @endphp
            
                                    
                  <label class="label-bold" style="margin-top: 20px;">For more details visit : {{$domain}}/employee-history/{{$attendancearray['user_id']}}</label>
                  
                  <div style="margin-top: 20px;">
                     <label  >Important Note: Do notify / escalate immediately if any discrepancy</label>
                  </div>
                 
                 
        </main>
    </body>
</html>