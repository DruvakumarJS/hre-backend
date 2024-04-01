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
            <label style="margin-top: 20px;">Dear All,</label>
            <div style="margin-top: 20px;">
                <label style="margin-top: 20px;">Please note that I have updated my Petty cash for your references and approval. Requesting you to verify my petty cash bills and approve.
</label>
            </div>

            @php
              $domain = url('/');
            @endphp
            <div style="margin-top: 20px;margin-bottom: 10px;">
                <label style="margin-top: 20px;">For more details visit : {{$domain}}/pettycash_details/{{$id}} </label>
            </div>
            <label>Request sent by : {{$empl->name}} - {{$empl->employee_id}}</label>
                           
        </main>
    </body>
</html>