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
            <label> Dear {{$grndata['owner']}} , </label>
            <div>
                 <label> Indent materials has been dispatched . Please find the details below: </label>
            </div>
            
            <div style="margin-top: 10px;">
                <label>Date : </label> <label class="label-bold">{{date('d-m-Y')}}</label>
            </div>
            
            <div  style="margin-top: 10px;">
                <label>GRN : </label> <label class="label-bold">{{$grndata['grn']}}</label>
            </div>

            <div  style="margin-top: 10px;">
                <label>Indent No : </label> <label class="label-bold">{{$grndata['indent_no']}}</label>
            </div>

             <div  style="margin-top: 10px;">
                <label>Dispatched Quantity : </label> <label class="label-bold">{{$grndata['dispatched']}}</label>
             </div>
                  @php
                    $domain = url('/');
                  @endphp

             <div style="margin-top: 10px;">
                 <label>View on Dashboard : </label> <label class="label-bold">{{$domain}}/grn</label>
             </div>
                              
        </main>
    </body>
</html>