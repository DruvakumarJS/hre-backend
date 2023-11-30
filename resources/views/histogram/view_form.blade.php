@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
          <div id="div1"> 
            <label style="font-size: 20px;font-weight: bolder;">PCN Registration Form / Project Histogram</label>
          </div>

          <div id="div2">
            <a href="{{ route('histogram')}}"><button class="btn btn-light btn-outlined-secondary">View Histogram</button></a>
          </div>
          
           
        </div>     
       
        <div class="page-container">
          <form method="POST" action="{{ route('update_histogram')}}">
            @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="card" style="background-color: #fff">
                <div class="card-body" style="padding: 0px" >
                  <h5 class="card-header " style="font-weight: bold;background-color: #edf2ef;">Client Billing Details</h5>
                    
                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">PCN </label>
                      <div class="col-9 ">
                        <!-- <input  class="form-control" type="text" name="pcn" required="required" value=""  placeholder="PCN "> -->
                        <select class="form-select form-control" name="pcn" required>
                          <option value="">Select PCN</option>
                          @foreach($pcn as $keys=>$val)
                           <option value="{{$val->pcn}}">{{$val->pcn}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Client Billing Name </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" name="billing_name" required="required" value="{{$data->billing_name}}"  placeholder="Billing Name " readonly>
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">GST Number </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" name="gst" required="required" value="{{$data->gst}}"  placeholder="GST Number" minlength="15" maxlength="15" readonly>
                      </div>
                    </div>

                </div>
              </div>
              
            </div>

            <div class="col-md-6">
              <div class="card"style="background-color: #fff" >
                <div class="card-body" style="padding: 0px">
                  <h5 class="card-header " style="font-weight: bold; background-color: #edf2ef;">Project Details</h5>
                 

                  <div class="form-group row" >
                     
                      <div class="col-9 " >
                        <div class="form-group row">

                          <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Project Name</label>
                      <div class="col-9"  >
                        <input  class="form-control" type="text" name="project_name" required="required" value="{{$data->project_name}}"  placeholder="Project Name">
                      </div>
                  </div>
                        <!--   <label for="" class="col-6 col-form-label">Site Full Address </label>   -->
                           <div class="row" style="margin-top: 10px" >
                             <div class="col-6">
                                <input  class="form-control" type="text" name="location" required="required" value="{{$data->location}}"  placeholder="location">
                             </div>
                             <div class="col-6">
                                <input  class="form-control" type="text" name="area" required="required" value="{{$data->area}}"  placeholder="Area / Building">
                             </div>
                           </div>

                           <div class="row" style="margin-top: 10px" >
                             <div class="col-4">
                                <input  class="form-control" type="text" name="city" required="required" value="{{$data->city}}"  placeholder="City ">
                             </div>
                             <div class="col-4">
                                <input  class="form-control" type="text" name="state" required="required" value="{{$data->state}}"  placeholder="State">
                             </div>
                             <div class="col-4">
                                <input  class="form-control" type="text" name="pincode" required="required" value="{{$data->pincode}}"  placeholder="PINCODE">
                             </div>
                           </div>

                            
                        </div>
                        
                      </div>
                    </div>
                  
                </div>
              </div>
              
            </div>

            
        </div> 

        <!-- row 2 -->

        <div class="row">
            <div class="col-md-6">
              <div class="card" style="background-color: #fff">
                <div class="card-body" style="padding: 0px" >
                  <h5 class="card-header " style="font-weight: bold;background-color: #edf2ef;">Project Target Days</h5>
                    
                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Target Start Date </label>
                      <div class="col-9 ">
                        <input  class="form-control" type="date" name="target_start_date" required="required" value="{{$data->target_start_date}}"  placeholder="PCN ">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Target End Date </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="date" name="target_end_date" required="required" value="{{$data->target_end_date}}"  placeholder="Billing Name ">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Approved Holidays Count</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="Number" name="approved_holidays_no" required="required" value="{{$data->approved_holidays_no}}"  placeholder="Approved Holidays Count">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Dates</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" name="holiday_dates" required="required" value="{{$data->holiday_dates}}"  placeholder="Approved Holiday Dates" >
                      </div>
                    </div>

                </div>
              </div>
              
            </div>

            <div class="col-md-6">
              <div class="card" style="background-color: #fff">
                <div class="card-body" style="padding: 0px" >
                  <h5 class="card-header " style="font-weight: bold;background-color: #edf2ef;">Actual Project Days</h5>
                    
                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Actual Start Date </label>
                      <div class="col-9 ">
                        <input  class="form-control" type="date" name="actual_start_date" required="required" value="{{$data->actual_start_date}}"  placeholder="PCN ">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Actual End Date </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="date" name="actual_end_date" required="required" value="{{$data->actual_end_date}}"  placeholder="Billing Name ">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Holidays & Project Hold Days </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="Number" name="hold_days_no" required="required" value="{{$data->hold_days_no}}"  placeholder="Holidays and Hold Count">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Dates</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" name="hold_dates" required="required" value="{{$data->hold_dates}}"  placeholder="Holiday & Project Hold Dates" >
                      </div>
                    </div>

                </div>
              </div>
              
            </div>

            
        </div> 

        <!-- row2 -->
        <div class="card" style="background-color: #fff;padding: 0px 0px 0px 10px">
        <div class="row" >
          <div class="col-md-4">
            
              <div class="form-group row" style="padding: 5px">
                <label for="" class="col-3 col-form-label label-bold">PO DATE </label>
                <div class="col-9 " >
                  <input  class="form-control" type="date" name="po_date" required="required" value="{{$data->po_date}}"  placeholder="PO Date">
                </div>
              </div>
            
            
          </div>

          <div class="col-md-4">
           
              <div class="form-group row" style="padding: 5px">
                <label for="" class="col-3 col-form-label label-bold">PO Number </label>
                <div class="col-9 " >
                  <input  class="form-control" type="text" name="po_number" required="required" value="{{$data->po_number}}"  placeholder="PO Number">
                </div>
              </div>
            
            
          </div>
          
        </div>
        </div>

        <!-- row 5 DLP  -->
        <div class="card" style="background-color: #fff;padding: 0px 0px 0px 10px">
        <div class="row" >
          <div class="col-md-4">
            
              <div class="form-group row" style="padding: 5px">
                <label for="" class="col-4 col-form-label label-bold">DLP Applicable </label>
                <div class="col-6 " >
                  <select class="form-control form-select" name="is_dlp_applicable">
                    <option value="">Select</option>
                    <option value="Yes" <?php echo ($data->is_dlp_applicable == 'Yes')?'selected':'' ?> >Yes</option>
                    <option value="No" <?php echo ($data->is_dlp_applicable == 'No')?'selected':'' ?>>No</option>
                  </select>
                </div>
              </div>
            
            
          </div>

          <div class="col-md-4">
           
              <div class="form-group row" style="padding: 5px">
                <label for="" class="col-3 col-form-label label-bold">DLP Days </label>
                <div class="col-9 " >
                  <input  class="form-control" type="text" name="dlp_days" required="required" value="{{$data->dlp_days}}"  placeholder="DLP Days">
                </div>
              </div>
                        
          </div>

          <div class="col-md-4">
           
              <div class="form-group row" style="padding: 5px">
                <label for="" class="col-4 col-form-label label-bold">DLP End Date </label>
                <div class="col-8 " >
                  <input  class="form-control" type="date" name="dlp_end_date" required="required" value="{{$data->dlp_end_date}}"  placeholder="DLP End Date">
                </div>
              </div>
            
            
          </div>
          
        </div>
       </div>
       
        <!-- row 3 -->
        
        <div class="card" style="padding: 0px;margin-top: 20px;background-color: #fff">
          <div class="card-body" >
            <h5 class="card-header" style="font-weight: bolder;background-color: #edf2ef">Project Contact Details</h5>
            <h6 class="card-title div-margin label-bold">Client Details</h6>
           
            <div>
              
               <table class="table table-responsive " id="dynamicclient">
                <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                    
                     <div class="col-md-3">
                      <label class="label-bold">Name</label>
                     
                    </div>

                     <div class="col-md-3">
                      <label class="label-bold">Designation</label>
                      
                    </div>

                     <div class="col-md-2">
                      <label class="label-bold">Organisation</label>
                      
                    </div>

                    <div class="col-md-2">
                      <label class="label-bold">Contact No.</label>
                     
                    </div>
                    <div class="col-md-2">
                      <label class="label-bold">Email ID</label>
                      
                    </div>

                   </div>
                   
                   </td> 

                 </tr>
               @foreach($client as $key=>$value)
              <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                    
                     <div class="col-md-3">
                      <input class="form-control" type="text" name="client[{{$key}}][name]" value="{{$value->client_name}}" required="required" readonly>
                    </div>

                     <div class="col-md-3">
                      <input class="form-control" type="text" name="client[{{$key}}][designation]" value="{{$value->client_designation}}" required="required" readonly>
                    </div>

                     <div class="col-md-2">
                      <input class="form-control" type="text" name="client[{{$key}}][organisation]" value="{{$value->client_organisation}}" required="required" readonly>
                    </div>

                    <div class="col-md-2">
                      <input class="form-control" type="text" name="client[{{$key}}][contact]" value="{{$value->client_contact}}" required="required" minlength="10" maxlength="10" readonly>
                    </div>
                    <div class="col-md-2">
                      <input class="form-control" type="text" name="client[{{$key}}][email]" value="{{$value->client_email}}" required="required" readonly>
                    </div>

                   </div>
                   
                   </td> 

                 </tr>  
          @endforeach


          </table>
            </div>
            <!--  <div id="div2">
               <i class="fa fa-plus" id="dynamic-client"></i>
             </div> -->
             




            <!-- architecture -->
            <h6 class="card-title div-margin label-bold">Architect/PMC Details</h6>
            <div>
              
               <table class="table table-responsive " id="dynamicArc">
              <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                    
                     <div class="col-md-3">
                      <label class="label-bold">Name</label>
                     
                    </div>

                     <div class="col-md-3">
                      <label class="label-bold">Designation</label>
                      
                    </div>

                     <div class="col-md-2">
                      <label class="label-bold">Organisation</label>
                      
                    </div>

                    <div class="col-md-2">
                      <label class="label-bold">Contact No.</label>
                     
                    </div>
                    <div class="col-md-2">
                      <label class="label-bold">Email ID</label>
                      
                    </div>

                   </div>
                   
                   </td> 

                 </tr>

               @foreach($arch as $key2=>$value2)
                <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                     
                     <div class="col-md-3">
                      <input class="form-control" type="text" name="arch[{{$key}}][name]" value="{{$value2->arc_name}}" required="required" readonly>
                    </div>

                     <div class="col-md-3">
                      <input class="form-control" type="text" name="arch[{{$key}}][designation]" value="{{$value2->arc_designation}}" required="required" readonly>
                    </div>

                    <div class="col-md-2">
                      <input class="form-control" type="text" name="arch[{{$key}}][organisation]" value="{{$value2->arc_organisation}}" required="required" readonly>
                    </div>

                    <div class="col-md-2">
                      <input class="form-control" type="text" name="arch[{{$key}}][contact]" value="{{$value2->arc_contact}}" required="required" minlength="10" maxlength="10" readonly>
                    </div>
                    <div class="col-md-2">
                      <input class="form-control" type="text" name="arch[{{$key}}][email]" value="{{$value2->arc_email}}" required="required" readonly>
                    </div>

                   </div>

                   </td> 

                 </tr>  
              @endforeach
          </table>
            </div>
             <!-- <div id="div2">
               <i class="fa fa-plus" id="dynamic-arc"></i>
             </div> -->

            <!-- landlord -->

            <h6 class="card-title div-margin label-bold">Landlord / Property Coordinators</h6>
            <div>
              
               <table class="table table-responsive " id="dynamicland">
              <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                    
                     <div class="col-md-3">
                      <label class="label-bold">Name</label>
                     
                    </div>

                     <div class="col-md-3">
                      <label class="label-bold">Designation</label>
                      
                    </div>

                     <div class="col-md-2">
                      <label class="label-bold">Organisation</label>
                      
                    </div>

                    <div class="col-md-2">
                      <label class="label-bold">Contact No.</label>
                     
                    </div>
                    <div class="col-md-2">
                      <label class="label-bold">Email ID</label>
                      
                    </div>

                   </div>
                   
                   </td> 

                 </tr>
                @foreach($land as $key3=>$value3)
               <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                     
                     <div class="col-md-3">
                      <input class="form-control" type="text" name="land[0][name]" value="{{$value3->land_name}}" required="required" readonly>
                    </div>

                     <div class="col-md-3">
                      <input class="form-control" type="text" name="land[0][designation]" value="{{$value3->land_designation}}" required="required" readonly>
                    </div>

                     <div class="col-md-2">
                      <input class="form-control" type="text" name="land[0][organisation]" value="{{$value3->land_organisation}}" required="required" readonly>
                    </div>

                    <div class="col-md-2">
                      <input class="form-control" type="text" name="land[0][contact]" value="{{$value3->land_contact}}" required="required" minlength="10" maxlength="10" readonly>
                    </div>
                    <div class="col-md-2">
                      <input class="form-control" type="text" name="land[0][email]" value="{{$value3->land_email}}" required="required" readonly>
                    </div>

                   </div>

                   </td> 

                 </tr>  
                @endforeach
          </table>
            </div>
            <!--  <div id="div2">
               <i class="fa fa-plus" id="dynamic-land"></i>
             </div> -->

          </div>
          
        </div>

        <!--row 4 HRE details -->

        <div class="card" style="background-color: #fff">
          <div class="card-body" >
            <h5 class="card-header" style="font-weight: bolder;background-color: #edf2ef">HRE Details</h5>

            <div>
              
               <table class="table table-responsive " id="dynamichre">
                <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                     
                     <div class="col-md-2">
                      <label class="label-bold">Name</label>
                    </div>

                     <div class="col-md-2">
                      <label class="label-bold">Designation</label>
                    </div>

                    <div class="col-md-2">
                      <label class="label-bold">Contact No.</label>
                    </div>
                    <div class="col-md-2">
                      <label class="label-bold">Email ID</label>
                    </div>
                    <div class="col-md-2">
                      <label class="label-bold">Start Date</label>
                    </div>
                    <div class="col-md-2">
                      <label class="label-bold">End Date</label>
                      
                    </div>

                   </div>

                   </td> 

                 </tr>

              @foreach($hre as $key4=>$value4)
              <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                     
                     <div class="col-md-2">
                      <input class="form-control" type="text" name="hre[0][name]" value="{{$value4->name}}" required="required" readonly>
                    </div>

                     <div class="col-md-2">
                      <input class="form-control" type="text" name="hre[0][designation]" value="{{$value4->designation}}" required="required" readonly>
                    </div>

                    <div class="col-md-2">
                      <input class="form-control" type="text" name="hre[0][contact]" value="{{$value4->contact}}" required="required" minlength="10" maxlength="10" readonly>
                    </div>
                    <div class="col-md-2">
                      <input class="form-control" type="text" name="hre[0][email]" value="{{$value4->email}}" required="required" readonly>
                    </div>
                    <div class="col-md-2">
                      <input class="form-control" type="text" name="hre[0][start]" value="{{$value4->start}}" required="required" readonly>
                    </div>
                    <div class="col-md-2">
                      <input class="form-control" type="text" name="hre[0][end]" value="{{$value4->end}}" required="required" readonly>
                    </div>

                   </div>

                   </td> 

                 </tr>  
              @endforeach
          </table>
            </div>
            <!--  <div id="div2">
               <i class="fa fa-plus" id="dynamic-hre"></i>
             </div> -->
            
          </div>
        </div>

        

       <!-- Row 6 Vendor details -->

       <div class="card">
        <div class="card-body">
          <h5 class="card-header">All Vendors Details</h5>
          <div>
              
               <table class="table table-responsive " id="dynamicvendor">
              @foreach($vendor as $key=>$value5)
              <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                     
                     <div class="col-md-3">
                      <label class="label-bold">Department Heading</label>
                      <input class="form-control" type="text" name="vendor[0][company]" value="{{$value5->department}}" required="required" readonly>
                    </div>

                     <div class="col-md-3">
                      <label class="label-bold">Vendor Company Name</label>
                      <input class="form-control" type="text" name="vendor[0][company]" value="{{$value5->company_name}}" required="required" readonly>
                    </div>

                    <div class="col-md-3">
                      <label class="label-bold">Contractor's Name</label>
                      <input class="form-control" type="text" name="vendor[0][name]" value="{{$value5->contracter_name}}"value="{{$value5->department}}" required="required" readonly>
                    </div>
                    <div class="col-md-3">
                      <label class="label-bold">Mobile No.</label>
                      <input class="form-control" type="text" name="vendor[0][mobile]" value="{{$value5->contracter_mobile}}" required="required" minlength="10" maxlength="10" readonly>
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-3">
                      <label class="label-bold">Supervisor Name</label>
                      <input class="form-control" type="text" name="vendor[0][supervisor]" value="{{$value5->supervisor_name}}" required="required" readonly>
                    </div>
                    <div class="col-md-3">
                      <label class="label-bold">Mobile No.</label>
                      <input class="form-control" type="text" name="vendor[0][supr_mobile]" value="{{$value5->supervisor_mobile}}" required="required" minlength="10" maxlength="10" readonly>
                    </div>
                    <div class="col-md-3">
                      <label class="label-bold">Start Date</label>
                      <input class="form-control" type="date" name="vendor[0][start]" value="{{$value5->start_date}}" required="required" readonly>
                    </div>
                    <div class="col-md-3">
                      <label class="label-bold">End Date</label>
                      <input class="form-control" type="date" name="vendor[0][end]" value="{{$value5->end_date}}" required="required" readonly>
                    </div>

                   </div>

                   </td> 

                 </tr>  
              @endforeach
          </table>
            </div>
             <!-- <div id="div2">
               <i class="fa fa-plus" id="dynamic-vendor"></i>
             </div> -->
        </div>

        <!-- last form -->

        <div class="row">
         <div class="col-md-6">
              <div class="card" style="background-color: #fff">
                <div class="card-body" style="padding: 0px" >
                   
                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Form Filled By </label>
                      <div class="col-9 ">
                        <input  class="form-control" type="text" required="required" value="{{$data->user->name}}"  placeholder="PCN " readonly>
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Designation</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" name="billing_name" required="required" value="{{$data->user->roles->alias}}">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Date</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" name="gst" required="required" value="{{date('d-m-Y',strtotime($data->created_at))}}" >
                      </div>
                    </div>

                </div>
              </div>
              
            </div>

            <div class="col-md-6">
              <div class="card" style="background-color: #fff">
                <div class="card-body" style="padding: 0px" >
                   

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Verified By</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" name="billing_name" required="required" value="{{auth::user()->name}} - {{auth::user()->roles->alias}}">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">PCN Alloted By</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" name="gst" required="required" value="{{auth::user()->name}} - {{auth::user()->roles->alias}}" >
                      </div>
                    </div>

                </div>
              </div>
              
            </div>
          
        </div>


         
       </div>
       <input type="hidden" name="histogram_id" value="{{$id}}">
       <div id="div2">
         <button class="btn btn-success" type="submit">Update</button>
       </div>
       
      </form>
    </div>
  
</div>




@endsection