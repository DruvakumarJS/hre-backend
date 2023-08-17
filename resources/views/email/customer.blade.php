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
            <label style="margin-top: 20px;">Hi ,Please find the Client details</label>
                   <div style="margin-top: 20px;">
                     <label>Clinet name : </label> <label class="label-bold">{{$data['name']}}</label>
                  </div>
                   <div style="margin-top: 20px;">
                     <label>Mobile No : </label> <label class="label-bold">{{$data['mobile']}}</label>
                  </div>
                   <div style="margin-top: 20px;">
                     <label>Email ID : </label> <label class="label-bold">{{$data['email']}}</label>
                  </div>
                                    
                  <label class="label-bold" style="margin-top: 20px;">For more details visit : https://hre.netiapps.com/view_customers</label>
                 
        </main>
    </body>
</html>