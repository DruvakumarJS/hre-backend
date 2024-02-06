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
            <label> Dear Team , </label>

            <div  style="margin-top: 10px;">
                <label>New service / compliant ticket is created</label> 
             </div>
            
            <div  style="margin-top: 20px;">
                <label>Ticket Description : </label> <label class="label-bold">{{$ticketarray['issue']}}</label>
             </div>

            <div style="margin-top: 10px;">
                <label>Ticket No : </label> <label class="label-bold">{{$ticketarray['ticket_no']}}</label>
            </div>
            
            <div  style="margin-top: 10px;">
                <label>Created By : </label> <label class="label-bold">{{$ticketarray['creator']}}</label>
            </div>

            <div  style="margin-top: 10px;">
                <label>Department : </label> <label class="label-bold">{{$ticketarray['category']}}</label>
            </div>

             <div  style="margin-top: 10px;">
                <label>Priority : </label> <label class="label-bold">{{$ticketarray['priority']}}</label>
             </div>

             @php
              $domain = url('/');
             @endphp

             <div style="margin-top: 10px;">
                 <label>View on Dashboard : </label> <label class="label-bold">{{$domain}}/tickets</label>
             </div>
                              
        </main>
    </body>
</html>