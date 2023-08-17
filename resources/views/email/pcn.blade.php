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
            <label style="margin-top: 20px;">Hi ,Please find the new PCN details</label>
                   <div style="margin-top: 20px;">
                     <label>PCN : </label> <label class="label-bold">{{$pcn_data['pcn']}}</label>
                  </div>
                   <div style="margin-top: 20px;">
                     <label>Brand : </label> <label class="label-bold">{{$pcn_data['brand']}}</label>
                  </div>
                   <div style="margin-top: 20px;">
                     <label>Location : </label> <label class="label-bold">{{$pcn_data['location']}}</label>
                  </div>
                   <div style="margin-top: 20px;">
                     <label>Area : </label> <label class="label-bold">{{$pcn_data['area']}}</label>
                  </div>
                   <div style="margin-top: 20px;">
                     <label>City : </label> <label class="label-bold">{{$pcn_data['city']}}</label>
                  </div>
                   <div style="margin-top: 20px;">
                     <label>State : </label> <label class="label-bold">{{$pcn_data['state']}}</label>
                  </div>
                   <div style="margin-top: 20px;">
                     <label>GST : </label> <label class="label-bold">{{$pcn_data['gst']}}</label>
                  </div>
                  
                  <label class="label-bold" style="margin-top: 20px;">visit : https://hre.netiapps.com/PCN</label>
                 
        </main>
    </body>
</html>