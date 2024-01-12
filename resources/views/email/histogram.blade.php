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
         <label>Dear Team ,</label>
         <div style="margin-top: 20px;">
          <label >New Histogram form filled and submitted for review/approval.</label><br/>
          <label>Kindly issue the PCN number for further proceedings</label><br/>
         </div>

         <div style="margin-top: 20px">
          <label >Client Name : {{$data->billing_name}}</label><br/>
          <label >Project Name : {{$data->project_name}}</label><br/>
          <label >Project Address : {{$data->location}},{{$data->area}},{{$data->city}},{{$data->state}},{{$data->pincode}}</label><br/>
         </div>

         <div style="margin-top: 20px">
             <label >Form Submitted by : {{$name}} , {{$empl_id}} , {{date("d-m-Y H:i", strtotime($data->created_at))}}</label>
         </div>
         
          
          
           
                        
        </main>
    </body>
</html>