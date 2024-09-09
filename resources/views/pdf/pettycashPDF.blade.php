<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
           body {
            font-family: 'Helvetica', sans-serif;
            font-size: 14px;
            margin-bottom: 60px;
           /* font-family: 'Calibri';
            src: url('/fonts/Calibri.woff2') format('woff2'),
                url('/fonts/Calibri.woff') format('woff');
            font-weight: normal;
            font-style: normal;
            font-display: swap;*/

          }
            @page {
                margin: 25px 25px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px;
                font-size: 20px !important;
                /*background-color: #f10909;*/
                color: white;
                text-align: center;
                line-height: 35px;
                font-weight: bolder;

            }

            footer {
                position: fixed; 
                bottom: 20px; 
                left: 0px; 
                right: 0px;
                height: 50px; 
                font-size: 20px !important;
                background-color: #f10909;
                color: white;
                text-align: center;
                line-height: 35px;

            }

            table, th, td {
              border: 1px solid black;
              border-collapse: collapse;
          }
          div{
            margin: 10px;
          }
          .lable{
            margin: 10px;
          }
          
        </style>

         <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Calibri:wght@400;700&display=swap">

    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
       
        <footer>
           <label style="font-size: 17px;">#241/E, 1st floor, 4th Block, HBR Layout, Outer Ring road, Hennur, Bengaluru 560043</label> 
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main style="padding-left: : 30px;padding-right: 30px;padding-top: 10px;padding-bottom: 10px;">
            
            <div style="display: grid;place-items: center;">
              <img src="data:image/svg;base64,{{base64_encode(file_get_contents(public_path('images/hre_logo.png')))}}" alt="" style="height: 100px; width: 100px;">
              <label style="font-weight: bolder;font-size: 20px;text-align: center;display: grid;place-items: center;"> Petty Cash Transaction Details</label>

            </div>
             
            <div style="float: right">
                <label >Date : </label> <label>{{date('d-m-Y')}}</label>
            </div>

             
              
            <div class="card border-white" style="margin-top: 20px;">
               <div>
                   <label class="lable">PC ID  : </label> <label class="lable">PC00{{$data->id}}</label>
               </div>

               <div>
                   <label class="lable">Bill Date  : </label> <label class="lable">{{$data->bill_date}}</label>
               </div>

               <div>
                   <label class="lable">Bill Number  : </label> <label class="lable">{{$data->bill_number}}</label>
               </div>

               <div>
                   <label class="lable ">Amount Utilised  : </label> <label class="lable number">INR. {{$data->spent_amount}}</label>
               </div>

               <div>
                   <label class="lable">Purpose  : </label> <label class="lable">{{$data->purpose}}</label>
               </div>
               <div>
                   <label class="lable">PCN  : </label> <label class="lable">{{$data->pcn}}</label>
               </div>

               <div>
                   <label class="lable">Narration  : </label> <label class="lable">{{$data->comments}}</label>
               </div>
               @php
               if($data->isapproved == '0'){
                  $status = 'Awaiting approval';
                }
                elseif($data->isapproved == '1'){
                  $status = 'Approved';
                }
                else {
                   $status = 'Rejected';
                }
                       
              
               @endphp                     

               <div>
                   <label class="lable">Status  : </label> <label class="lable">{{$status}}</label>
               </div>

               <div>
                   <label class="lable">Entry Date  : </label> <label class="lable">{{$data->created_at}}</label>
               </div>

               <div>
                   <label class="lable">Remarks  : </label> <label class="lable">{{$data->remarks}}</label>
               </div>

            </div>
                        
        </main>
    </body>
</html>

