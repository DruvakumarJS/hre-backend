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
            <label style="margin-top: 20px;">Dear {{$p_data['name']}} ,</label>
            <div style="margin-top: 20px;">
                <label style="margin-top: 20px;">{{$p_data['message']}}</label>
            </div>
            
                              
        </main>
    </body>
</html>