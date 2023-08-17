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
            <label style="margin-top: 20px;">Hi ,Please find the Material details</label>
                   <div style="margin-top: 20px;">
                     <label>Category : </label> <label class="label-bold">{{$material['category_id']}}</label>
                  </div>
                   <div style="margin-top: 20px;">
                     <label>Item Code : </label> <label class="label-bold">{{$material['item_code']}}</label>
                  </div>
                   <div style="margin-top: 20px;">
                     <label>Material Name : </label> <label class="label-bold">{{$material['name']}}</label>
                  </div>

                   <div style="margin-top: 20px;">
                     <label>brand Name : </label> <label class="label-bold">{{$material['brand']}}</label>
                  </div>

                  <div style="margin-top: 20px;">
                     <label>UoM : </label> <label class="label-bold">{{$material['uom']}}</label>
                  </div>

                   <div style="margin-top: 20px;">
                     <label>Features : </label> 
                  </div>


                      @php
                       $info = json_decode($material['information']);
                      @endphp

                      @foreach($info as $key => $val)
                             <div>
                               <label class="label-bold">{{$key}} = {{$val}}</label>
                             </div>
                              
                         
                      @endforeach

                    
                 
        </main>
    </body>
</html>