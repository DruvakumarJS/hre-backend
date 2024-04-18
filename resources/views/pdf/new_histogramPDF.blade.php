<!DOCTYPE html>
<html>
<style type="text/css">
   body {
      /*font-family: 'Calibri', sans-serif;*/
       font-family: 'Helvetica', sans-serif;
       font-size: 14px;
    }

  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
<head>
  <title></title>
</head>
<body>
 
  <div class="row">
    <div class="col-6">
      
      <div style="display: grid;place-items: center;">
              <img src="data:image/svg;base64,{{base64_encode(file_get_contents(public_path('images/hre_logo.png')))}}" alt="" style="height: 70px; width: 70px;">
              <label style="font-weight: bold;">PCN REGISTRATION FORM / PROJECT HISTOGRAM</label>

            </div>
      <table style="margin-top: 30px">
        <tr>
          <th>
            <div class="form-group row " style="margin-top: 10px;">
               
                
                <table style="padding:10px;background-color: #c1f2b0">
                  <tr>
                    <th>
                      <div class="form-group row " style="margin-top: 10px;width: 200px">
                           <label for="" class="col-4 col-form-label">Client Project details </label>
                          <div >
                            <div class="card border-white" style="margin-top: 20px;">
                              <table class="table responsive" width="100%">
                              <thead>
                                <tr>
                                   <th width="100px" height="20px"><label style="font-size: 10px" >Project Code Number</label></th>
                                   <th height="20px"><label style="font-size: 10px"></label></th>
                                </tr>
                              </thead>
                            </table>
                            </div>
                            

                            <table class="table responsive " width="100%">
                              <thead>
                                <tr>
                                   <th width="100px" height="20px"><label style="font-size: 10px">Client Billing Name</label></th>
                                   <th height="20px"><label style="font-size: 10px">{{$data->billing_name}}</label></th>
                                </tr>
                              </thead>
                            </table>

                            <table class="table responsive" width="100%">
                              <thead>
                                <tr>
                                   <th width="100px" height="20px"><label style="font-size: 10px">GST Number</label></th>
                                   <th height="20px"><label style="font-size: 10px">{{$data->gst}}</label></th>
                                </tr>
                              </thead>
                            </table>

                            <table class="table responsive" width="100%">
                              <thead>
                                <tr>
                                   <th width="100px" height="20px"><label style="font-size: 10px">Project Name $ address</label></th>
                                   <th height="20px"><label style="font-size: 10px">{{$data->project_name}} - {{$data->location}} {{$data->area}} {{$data->city}} {{$data->state}} {{$data->pincode}}</label></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
              
                        </div>
                    </th>
                  </tr>
                </table>
              </div>
          </th>

          <th>
            <div class="form-group row " style="margin-top: 10px;">
              
                <table style="padding:10px;background-color: #FFEBD8">
                  <tr>
                    <th>
                      <div class="form-group row " style="margin-top: 10px;width: 200px">
                           <label for="" class="col-4 col-form-label">Project Targrt Days</label>
                
                          <div >
                            <div class="card border-white" style="margin-top: 20px;">
                              <table class="table responsive" width="100%">
                              <thead>
                                <tr>
                                   <th width="100px" height="20px"><label style="font-size: 10px" >Targeted Start Date</label></th>
                                   <th height="20px"><label style="font-size: 10px">{{date('d-m-Y' , strtotime($data->target_start_date))}}</label></th>
                                </tr>
                              </thead>
                            </table>
                            </div>
                            

                            <table class="table responsive " width="100%">
                              <thead>
                                <tr>
                                   <th width="100px" height="20px"><label style="font-size: 10px">Targeted End Date</label></th>
                                   <th height="20px"><label style="font-size: 10px">{{date('d-m-Y' , strtotime($data->target_end_date))}}</label></th>
                                </tr>
                              </thead>
                            </table>

                            <table class="table responsive" width="100%">
                              <thead>
                                <tr>
                                   <th width="100px" height="20px"><label style="font-size: 10px">Approved Holidays</label></th>
                                   <th height="20px"><label style="font-size: 10px">{{$data->approved_holidays_no}}</label></th>
                                </tr>
                              </thead>
                            </table>

                            <table class="table responsive" width="100%">
                              <thead>
                                <tr> 
                                   <th height="20px"><label style="font-size: 10px">{{$data->holiday_dates}}</label></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
              
                        </div>
                    </th>
                  </tr>
                </table>
              </div>
          </th>
          

          <th>
            <div class="form-group row " style="margin-top: 10px;">
               
                <table style="padding:10px;background-color: #D2E0FB">
                  <tr>
                    <th>
                      <div class="form-group row " style="margin-top: 10px;width: 200px">
                          <label for="" class="col-4 col-form-label">Actual Project Days</label>
                          
                          <div >
                            <div class="card border-white" style="margin-top: 20px;">
                              <table class="table responsive" width="100%">
                              <thead>
                                <tr>
                                   <th width="100px" height="20px"><label style="font-size: 10px" >Actual Start Date</label></th>
                                   <th height="20px"><label style="font-size: 10px">{{ ($data->actual_start_date != '')?date('d-m-Y' , strtotime($data->actual_start_date)) : ''}}</label></th>
                                </tr>
                              </thead>
                            </table>
                            </div>
                            

                            <table class="table responsive " width="100%">
                              <thead>
                                <tr>
                                   <th width="100px" height="20px"><label style="font-size: 10px">Actual Completed Date</label></th>
                                   <th height="20px"><label style="font-size: 10px">{{ ($data->actual_end_date != '')?date('d-m-Y' , strtotime($data->actual_end_date)) :''}}</label></th>
                                </tr>
                              </thead>
                            </table>

                            <table class="table responsive" width="100%">
                              <thead>
                                <tr>
                                   <th width="100px" height="20px"><label style="font-size: 10px">Holidays & Project Hold Days</label></th>
                                   <th height="20px"><label style="font-size: 10px">{{$data->hold_days_no}}</label></th>
                                </tr>
                              </thead>
                            </table>

                            <table class="table responsive" width="100%">
                              <thead>
                                <tr>
                                   <th height="20px"><label style="font-size: 10px">{{$data->hold_dates}}</label></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
              
                        </div>
                    </th>
                  </tr>
                </table>
              </div>
          </th>

        </tr>

        
      </table>
    </div>
  </div>

  <!-- row 2 -->
  
  <table style="margin-top: 30px;background-color: #FAE392">
        <tr>
          <th>
            <div class="form-group row " >
               
                <table style="border:none">
                  <tr>
                    <th width="150px">PO Date</th>
                    <th width="150px">{{date('d-m-Y' , strtotime($data->po_date))}}</th>
                  </tr>
                </table>

              </div>
          </th>
          
          <th>
            <div class="form-group " >
               
                <table style="border:none">
                  <tr>
                    <th width="150px">PO Number</th>
                    <th width="150px">{{$data->po_number}}</th>
                  </tr>
                </table>

              </div>
          </th>
          

        </tr> 
      </table>

    <!-- row 3 -->
  
  <table style="margin-top: 30px;background-color: #FAE392">
        <tr>
          <th>
            <div class="form-group" >
               
                <table style="border:0px">
                  <tr>
                    <th width="150px">DLP Applicable </th>
                    <th width="100px">{{$data->is_dlp_applicable}}</th>
                  </tr>
                </table>

              </div>
          </th>
          
          <th>
            <div class="form-group row " >
               
                <table style="border:0px">
                  <tr>
                    <th width="100px">DLP Days</th>
                    <th width="50px">{{$data->dlp_days}}</th>
                  </tr>
                </table>

              </div>
          </th>
          
          <th>
            <div class="form-group row " >
               
                <table style="border:0px">
                  <tr>
                    <th width="150px">DLP End Date</th>
                    <th width="100px">{{ ($data->dlp_end_date != '')?date('d-m-Y' , strtotime($data->dlp_end_date)) :'' }}</th>
                  </tr>
                </table>

              </div>
          </th>
          

        </tr> 
    </table> 
    <!-- row 4 -->
    
    <div  class="card border-white" style="margin-top: 30px;">
      <label style="font-weight: bold;">Project Contact Details</label>
      <div style="margin-top: 20px">
         <label style="font-weight: bold;">Client Details</label> 
      </div>
     
      <table class="table responsive" width="100%" style="background-color: #FDFFAE">
          <thead>
            <tr>
               <th scope="col">Name</th>
               <th scope="col">Designation</th>
               <th scope="col">Organisation</th>
               <th scope="col">Contact No.</th> 
               <th scope="col">Email ID</th> 
            </tr>
          </thead>
          <tbody>
            @foreach($client as $key=>$value)
             <tr>
                <td style="text-align: center; ">{{$value->client_name}}</td>
                <td style="text-align: center; ">{{$value->client_designation}}</td>
                <td style="text-align: center; ">{{$value->client_organisation}}</td>
                <td style="text-align: center; ">{{$value->client_contact}}</td>
                <td style="text-align: center; ">{{$value->client_email}}</td>
             </tr>
            @endforeach  
          </tbody>
        </table>
    </div> 

   
    <div  class="card border-white" style="margin-top: 20px;">
       <label style="font-weight: bold;">Architect/PMC Details</label> 

      <table class="table responsive" width="100%" style="background-color: #FDFFAE">
          <thead> 
            <tr>
               <th scope="col">Name</th>
               <th scope="col">Designation</th>
               <th scope="col">Organisation</th>
               <th scope="col">Contact No.</th> 
               <th scope="col">Email ID</th> 
            </tr> 
          </thead>
          <tbody>
             @foreach($arch as $key2=>$value2)
             <tr>
                <td style="text-align: center; ">{{$value2->arc_name}}</td>
                <td style="text-align: center; ">{{$value2->arc_designation}}</td>
                <td style="text-align: center; ">{{$value2->arc_organisation}}</td>
                <td style="text-align: center; ">{{$value2->arc_contact}}</td>
                <td style="text-align: center; ">{{$value2->arc_email}}</td>
             </tr>
             @endforeach
          </tbody>
        </table>
    </div>

   

    <div  class="card border-white" style="margin-top: 20px;">
       <label style="font-weight: bold;">Landlord /Property Coordinators</label> 
      <table class="table responsive" width="100%" style="background-color: #FDFFAE">
          <thead>
            <tr>
               <th scope="col">Name</th>
               <th scope="col">Designation</th>
               <th scope="col">Organisation</th>
               <th scope="col">Contact No.</th> 
               <th scope="col">Email ID</th> 
            </tr>
          </thead>
          <tbody>
            @foreach($land as $key3=>$value3)
             <tr>
                <td style="text-align: center; ">{{$value3->land_name}}</td>
                <td style="text-align: center; ">{{$value3->land_designation}}</td>
                <td style="text-align: center; ">{{$value3->land_organisation}}</td>
                <td style="text-align: center; ">{{$value3->land_contact}}</td>
                <td style="text-align: center; ">{{$value3->land_email}}</td>
             </tr>
             @endforeach
          </tbody>
        </table>
    </div>

   

    <div  class="card border-white" style="margin-top: 20px;">
        <label style="font-weight: bold;margin-top: 30px">HRE Details</label>
      <table class="table responsive" width="100%" style="background-color: #F7C8E0">
          <thead>
            <tr>
               <th scope="col">Name</th>
               <th scope="col">Designation</th>
               <th scope="col">Contact No.</th> 
               <th scope="col">Email ID</th> 
               <th scope="col">Start Date</th>
               <th scope="col">End Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach($hre as $key4=>$value4)
             <tr>
                <td style="text-align: center; ">{{$value4->name}}</td>
                <td style="text-align: center; ">{{$value4->designation}}</td>
                <td style="text-align: center; ">{{$value4->contact}}</td>
                <td style="text-align: center; ">{{$value4->email}}</td>
                <td style="text-align: center; "> {{ ($value4->start_date != '')?date('d-m-Y' , strtotime($value4->start_date)) :''}} </td>
                <td style="text-align: center; "> {{ ($value4->end_date != '')?date('d-m-Y' , strtotime($value4->end_date)) :''}} </td>
             </tr>
             @endforeach
          </tbody>
        </table>
    </div>

 
    <div  class="card border-white" style="margin-top: 20px;">
      <label style="font-weight: bold;margin-top: 30px">All Vendor Details</label>
 
      <table class="table responsive" width="100%" style="background-color: #E8F9FD">
          <thead>
            <tr>
               <th scope="col">Department Heading</th>
               <th scope="col">Vendor Company Name</th>
               <th scope="col">Contractor's Name</th> 
               <th scope="col">Mobile</th> 
               <th scope="col">Supervisor's Name</th>
               <th scope="col">Mobile</th>
               <th scope="col">Start Date</th>
               <th scope="col">End Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach($vendor as $key5=>$value5)
             <tr>
                <td style="text-align: center; ">{{$value5->department}}</td>
                <td style="text-align: center; ">{{$value5->company_name}}</td>
                <td style="text-align: center; ">{{$value5->contracter_name}}</td>
                <td style="text-align: center; ">{{$value5->contracter_mobile}}</td>
                <td style="text-align: center; ">{{$value5->supervisor_name}}</td>
                <td style="text-align: center; ">{{$value5->supervisor_mobile}}</td>
                <td style="text-align: center; ">{{ ($value5->start_date != '')?date('d-m-Y' , strtotime($value5->start_date)) :''}} </td>
                <td style="text-align: center; "> {{ ($value5->end_date != '')?date('d-m-Y' , strtotime($value5->end_date)) :''}} </td>
             </tr>
             @endforeach
          </tbody>
        </table>
    </div> 
    
    <div class="div-margin" style="margin-top: 10px;">
         <label  class="label-bold" style="font-weight: bold;">General Note</label>
         <div class="div-margin">
           <textarea class="form-control" placeholder="Enter your comments here...." name="generalnote" style="min-height: 100px;max-height: 200px">{{$data->generalnotes}}</textarea>
         </div>
         
    </div> 
   

    <table style="margin-top: 30px">
      <tr height="100px">
        <th width="130px">Form Filled By</th>
        <th width="250px">{{$name}}</th>
        <th align="left" width="250px" style="align-content: start">HRE Office Only</th>
      </tr>
      <tr style="height: 50px">
        <th width="130px">Designation</th>
        <th width="250px">{{$alias}}</th>
        <th align="left" width="250px" style="text-align: start">Verified By : </th>
      </tr>
      <tr style="height: 70px">
        <th width="130px">Date</th>
        <th width="250px">{{date('d-m-Y H:i')}}</th>
        <th align="left" width="250px"style="text-align: start">PCN Alloted By :  </th>
      </tr>
      <tr style="height: 30px">
        <th width="130px">Signature</th>
        <th width="250px"></th>
        <th align="left" width="300px"style="text-align: start">Signature :</th>
      </tr>
      
    </table> 

</body>
</html>