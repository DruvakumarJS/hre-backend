<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px;
                font-size: 20px !important;
                background-color: #f10909;
                color: white;
                text-align: center;
                line-height: 35px;
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
        <header>
            HRE- One Stop Solution
            
        </header>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main style="padding: 30px;">
            <label> Dear {{$grndata['owner']}} , </label>
            <div>
                 <label> Indent items has been dispatched . Please find the details below</label>
            </div>
            
            <div style="margin-top: 10px;">
                <label>Date : </label> <label>{{date('d-m-Y')}}</label>
            </div>
            
            <div  style="margin-top: 10px;">
                <label>GRN : </label> <label>{{$grndata['grn']}}</label>
            </div>

            <div  style="margin-top: 10px;">
                <label>Indent No : </label> <label>{{$grndata['indent_no']}}</label>
            </div>

             <div  style="margin-top: 10px;">
                <label>dispatched Quantity : </label> <label>{{$grndata['dispatched']}}</label>
             </div>

             <div style="margin-top: 10px;">
                 <label>View on Dashaboard : </label> <label>https://hre.netiapps.com/grn</label>
             </div>
                              
        </main>
    </body>
</html>