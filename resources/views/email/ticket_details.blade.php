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
            <label> Ticket details , </label>
            
            <div  style="margin-top: 10px;">
                <label class="label-bold">{{$body}}</label>
             </div>
             @php
              $domain = url('/');
             @endphp

             <div class="label-bold" style="margin-top: 10px;">
                 <label class="label-bold">View on Dashboard : </label> <label>{{$domain}}/ticket_details/{{$ticketarray['ticket_no']}}</label>
             </div>
                              
        </main>
    </body>
</html>