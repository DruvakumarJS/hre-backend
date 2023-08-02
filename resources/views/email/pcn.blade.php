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
        <main style="padding: 30px;margin-top: 20px;">
            <label style="margin-top: 20px;">Hi ,Please find the new PCN details</label>
                   <div style="margin-top: 20px;">
                     <label>PCN : </label> <label >{{$pcn_data['pcn']}}</label>
                  </div>
                   <div style="margin-top: 20px;">
                     <label>Brand : </label> <label >{{$pcn_data['brand']}}</label>
                  </div>
                   <div style="margin-top: 20px;">
                     <label>Location : </label> <label >{{$pcn_data['location']}}</label>
                  </div>
                   <div style="margin-top: 20px;">
                     <label>Area : </label> <label>{{$pcn_data['area']}}</label>
                  </div>
                   <div style="margin-top: 20px;">
                     <label>City : </label> <label >{{$pcn_data['city']}}</label>
                  </div>
                   <div style="margin-top: 20px;">
                     <label>State : </label> <label >{{$pcn_data['state']}}</label>
                  </div>
                  
                  <label>visit : https://hre.netiapps.com/PCN</label>
                 
        </main>
    </body>
</html>