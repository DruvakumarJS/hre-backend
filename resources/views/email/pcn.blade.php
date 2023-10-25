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
            <label style="margin-top: 20px;">Hi ,Please find the PCN details</label>
                   <div style="margin-top: 20px;">
                     <label>PCN : </label> <label class="label-bold">{{$pcn_data['new_data']['pcn']}}</label>
                  </div>
                   <div style="margin-top: 10px;">
                     <label>Brand : </label> <label class="label-bold">{{$pcn_data['new_data']['brand']}}</label>
                  </div>
                   <div style="margin-top: 10px;">
                     <label>Location : </label> <label class="label-bold">{{$pcn_data['new_data']['location']}}</label>
                  </div>
                   <div style="margin-top: 10px;">
                     <label>Area : </label> <label class="label-bold">{{$pcn_data['new_data']['area']}}</label>
                  </div>
                   <div style="margin-top: 10px;">
                     <label>City : </label> <label class="label-bold">{{$pcn_data['new_data']['city']}}</label>
                  </div>
                   <div style="margin-top: 10px;">
                     <label>State : </label> <label class="label-bold">{{$pcn_data['new_data']['state']}}</label>
                  </div>
                  <div style="margin-top: 10px;">
                     <label>PINCODE : </label> <label class="label-bold">{{$pcn_data['new_data']['pincode']}}</label>
                  </div>
                   <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>GST : </label> <label class="label-bold">{{$pcn_data['new_data']['gst']}}</label>
                  </div>

                   @if(isset($pcn_data['old_data']))

                  <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Project Start Date : </label> <label class="label-bold">{{$pcn_data['new_data']['proposed_start_date']}}</label>
                  </div>
                   <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Project End Date : </label> <label class="label-bold">{{$pcn_data['new_data']['proposed_end_date']}}</label>
                  </div> 
                  <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Provide Holiday : </label> <label class="label-bold">{{$pcn_data['new_data']['approve_holidays']}}</label>
                  </div>
                  <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Approved Holidays : </label> <label class="label-bold">{{$pcn_data['new_data']['approved_days']}}</label>
                  </div>

                   <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Actual Start Date : </label> <label class="label-bold">{{$pcn_data['new_data']['actual_start_date']}}</label>
                  </div>
                   <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Actual Completed Date : </label> <label class="label-bold">{{$pcn_data['new_data']['actual_completed_date']}}</label>
                  </div>
                   <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Actual Hold Days/Holidays : </label> <label class="label-bold">{{$pcn_data['new_data']['hold_days']}}</label>
                  </div>
                   <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>DLP Date : </label> <label class="label-bold">{{$pcn_data['new_data']['dlp_date']}}</label>
                  </div>
                   <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>status : </label> <label class="label-bold">{{$pcn_data['new_data']['status']}}</label>
                  </div>
                  
                  
                   <label style="margin-top: 30px; border-width: 1px;border-color: black;">-----Previous Details-----</label>
                   <div style="margin-top: 20px;">
                     <label>PCN : </label> <label class="label-bold">{{$pcn_data['old_data']['pcn']}}</label>
                  </div>
                   <div style="margin-top: 10px;">
                     <label>Brand : </label> <label class="label-bold">{{$pcn_data['old_data']['brand']}}</label>
                  </div>
                   <div style="margin-top: 10px;">
                     <label>Location : </label> <label class="label-bold">{{$pcn_data['old_data']['location']}}</label>
                  </div>
                   <div style="margin-top: 10px;">
                     <label>Area : </label> <label class="label-bold">{{$pcn_data['old_data']['area']}}</label>
                  </div>
                   <div style="margin-top: 10px;">
                     <label>City : </label> <label class="label-bold">{{$pcn_data['old_data']['city']}}</label>
                  </div>
                   <div style="margin-top: 10px;">
                     <label>State : </label> <label class="label-bold">{{$pcn_data['old_data']['state']}}</label>
                  </div>
                  <div style="margin-top: 10px;">
                     <label>PINCODE : </label> <label class="label-bold">{{$pcn_data['old_data']['pincode']}}</label>
                  </div>
                   <div style="margin-top: 10px;">
                     <label>GST : </label> <label class="label-bold">{{$pcn_data['old_data']['gst']}}</label>
                  </div>

                  <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Project Start Date : </label> <label class="label-bold">{{$pcn_data['old_data']['proposed_start_date']}}</label>
                  </div>
                   <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Project End Date : </label> <label class="label-bold">{{$pcn_data['old_data']['proposed_end_date']}}</label>
                  </div> 
                  <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Provide Holiday : </label> <label class="label-bold">{{$pcn_data['old_data']['approve_holidays']}}</label>
                  </div>
                   <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Approved Holidays : </label> <label class="label-bold">{{$pcn_data['old_data']['approved_days']}}</label>
                  </div>
                   <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Actual Start Date : </label> <label class="label-bold">{{$pcn_data['old_data']['actual_start_date']}}</label>
                  </div>
                   <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Actual Completed Date : </label> <label class="label-bold">{{$pcn_data['old_data']['actual_completed_date']}}</label>
                  </div>
                   <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>Actual Hold Days/Holidays : </label> <label class="label-bold">{{$pcn_data['old_data']['hold_days']}}</label>
                  </div>
                   <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>DLP Date : </label> <label class="label-bold">{{$pcn_data['old_data']['dlp_date']}}</label>
                  </div>
                   <div style="margin-top: 10px;margin-bottom: 10px">
                     <label>status : </label> <label class="label-bold">{{$pcn_data['old_data']['status']}}</label>
                  </div>

                   @endif
                  
                  @php
                    $domain = url('/');
                  @endphp

                  <div style="margin-top: 20px;">
                     <label class="label-bold">For more details visit : {{$domain}}/PCN</label>
                 
                  </div>
                 
        </main>
    </body>
</html>