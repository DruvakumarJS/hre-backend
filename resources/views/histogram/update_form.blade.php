@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
          <div id="div1"> 
            <label style="font-size: 20px;font-weight: bolder;">Update - PCN Registration Form / Project Histogram</label>
          </div>

          <div id="div2">
            <a href="{{ route('histogram')}}"><button class="btn btn-light btn-outlined-secondary">View Histogram</button></a>
          </div>
          
           
        </div>     
       
        <div class="page-container">
          <form id="form" method="POST" action="{{ route('update_histogram_details')}}">
            @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="card" style="background-color: #fff">
                <div class="card-body" style="padding: 0px" >
                  <h5 class="card-header " style="font-weight: bold;background-color: #edf2ef;">Client Billing Details</h5>
                    
                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">PCN </label>
                      <div class="col-9 ">
                        <input  class="form-control" type="text" name="pcn"  required="required"  placeholder="PCN "
                        value="{{$data->pcn}}"  readonly>
                        
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Client Billing Name* </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" name="billing_name" required="required" value="{{$data->billing_name}}"  placeholder="Billing Name " readonly>
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">GST Number* </label>
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

                         <!--  <div class="form-group row " style="margin-top: 10px">
                            <label for="" class="col-3 col-form-label">Project Name</label>
                            <div class="col-9"  >
                              <input  class="form-control" type="text" name="project_name" required="required" value="{{$data->project_name}}"  placeholder="Project Name" >
                            </div>
                        </div> -->

                         <div class="row" style="margin-top: 10px" >
                             <div class="col-6">
                                <input  class="form-control" type="text" name="project_name" required="required"  placeholder="Project Name" value="{{$data->project_name}}" readonly>
                             </div>
                             <div class="col-6">
                                <input  class="form-control" type="text" name="type" required="required"  placeholder="Type Of Work" value="{{$data->type_of_work}}" readonly>
                             </div>
                           </div>
                           
                        <!--   <label for="" class="col-6 col-form-label">Site Full Address </label>   -->
                           <div class="row" style="margin-top: 10px" >
                             <div class="col-6">
                                <input  class="form-control" type="text" name="location" required="required" value="{{$data->location}}"  placeholder="location" readonly>
                             </div>
                             <div class="col-6">
                                <input  class="form-control" type="text" name="area" required="required" value="{{$data->area}}"  placeholder="Area / Building" readonly>
                             </div>
                           </div>

                           <div class="row" style="margin-top: 10px" >
                             <div class="col-6">
                                <input  class="form-control" type="text" name="city" required="required" value="{{$data->city}}"  placeholder="City " readonly>
                             </div>
                             <div class="col-3">
                                <input  class="form-control" type="text" name="state" required="required" value="{{$data->state}}"  placeholder="State" readonly>
                             </div>
                             <div class="col-3">
                                <input  class="form-control" type="text" name="pincode" required="required" value="{{$data->pincode}}"  placeholder="PINCODE" readonly>
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
                      <label for="" class="col-3 col-form-label">Target Start Date* </label>
                      <div class="col-9 ">
                        <input  class="form-control" type="date" name="target_start_date" required="required" value="{{$data->target_start_date}}"  placeholder="PCN " >
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Target End Date* </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="date" name="target_end_date" required="required" value="{{$data->target_end_date}}"  placeholder="Billing Name " >
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Approved Holidays Count*</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="Number" min="0" name="approved_holidays_no" required="required" value="{{$data->approved_holidays_no}}"  placeholder="Approved Holidays Count" >
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Note*</label>
                      <div class="col-9 " >
                       <!--  <input  class="form-control" type="text" name="holiday_dates"  value="{{$data->holiday_dates}}"  placeholder="Approved Holiday Dates" > -->
                        <textarea class="form-control" name="holiday_dates" >{{$data->holiday_dates}}</textarea>
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
                        <input  class="form-control" type="date" name="actual_start_date"  value="{{$data->actual_start_date}}"  placeholder="PCN " >
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Actual End Date </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="date" name="actual_end_date"  value="{{$data->actual_end_date}}"  placeholder="Billing Name " >
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Holidays & Project Hold Days </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="Number" name="hold_days_no"  value="{{$data->hold_days_no}}"  placeholder="Holidays and Hold Count" >
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Note</label>
                      <div class="col-9 " >
                        <!-- <input  class="form-control" type="text" name="hold_dates"  value="{{$data->hold_dates}}"  placeholder="Holiday & Project Hold Dates" > -->
                        <textarea class="form-control" name="hold_dates" >{{$data->hold_dates}}</textarea>
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
                <label for="" class="col-3 col-form-label label-bold">PO DATE* </label>
                <div class="col-9 " >
                  <input  class="form-control" type="date" name="po_date" required="required" value="{{$data->po_date}}"  placeholder="PO Date" readonly>
                </div>
              </div>
            
            
          </div>

          <div class="col-md-4">
           
              <div class="form-group row" style="padding: 5px">
                <label for="" class="col-4 col-form-label label-bold">PO Number* </label>
                <div class="col-8" >
                  <input  class="form-control" type="text" name="po_number" required="required" value="{{$data->po_number}}"  placeholder="PO Number" readonly>
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
                <label for="" class="col-4 col-form-label label-bold">DLP Applicable* </label>
                <div class="col-6 " >
                  <select class="form-control form-select" name="is_dlp_applicable" >
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
                  <input  class="form-control" type="number" name="dlp_days" min="0" value="{{$data->dlp_days}}"  placeholder="DLP Days" >
                </div>
              </div>
                        
          </div>

          <div class="col-md-4">
           
              <div class="form-group row" style="padding: 5px">
                <label for="" class="col-4 col-form-label label-bold">DLP End Date </label>
                <div class="col-8 " >
                  <input  class="form-control" type="date" name="dlp_end_date" value="{{$data->dlp_end_date}}"  placeholder="DLP End Date" >
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

                     <div class="col-md-2">
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
                 <input type="hidden"  id="client_length" value="{{count($client)}}">
               @foreach($client as $key0=>$value)
              <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                    
                     <div class="col-md-3">
                      <input class="form-control" type="text"  value="{{$value->client_name}}" name="client[{{$key0}}][name]" required="required" >
                    </div>

                     <div class="col-md-2">
                      <input class="form-control" type="text"  value="{{$value->client_designation}}" name="client[{{$key0}}][designation]" required="required" >
                    </div>

                     <div class="col-md-2">
                      <input class="form-control" type="text"  value="{{$value->client_organisation}}" name="client[{{$key0}}][organisation]" required="required" >
                    </div>

                    <div class="col-md-2">
                      <input class="form-control" type="text"  value="{{$value->client_contact}}" name="client[{{$key0}}][contact]" required="required" minlength="10" maxlength="10" >
                    </div>
                    <div class="col-md-2">
                      <input class="form-control" type="text"  value="{{$value->client_email}}" name="client[{{$key0}}][email]" required="required" >
                    </div>
                     <div class="col-md-1">
                      <i class="fa fa-trash remove-client-field" style="color: red"></i>
                    </div>

                   </div>
                   
                   </td> 

                 </tr>  
          @endforeach


          </table>
            </div>
             <div id="div2">
               <i class="fa fa-plus" id="dynamic-client" style="color: green"></i>
             </div>
             




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

                     <div class="col-md-2">
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
              <input type="hidden"  id="arch_length" value="{{count($arch)}}">
               @foreach($arch as $key2=>$value2)
                <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                     
                     <div class="col-md-3">
                      <input class="form-control" type="text"  value="{{$value2->arc_name}}" required="required" name="arch[{{$key2}}][name]">
                    </div>

                     <div class="col-md-2">
                      <input class="form-control" type="text"  value="{{$value2->arc_designation}}" required="required" name="arch[{{$key2}}][designation]">
                    </div>

                    <div class="col-md-2">
                      <input class="form-control" type="text"  value="{{$value2->arc_organisation}}" required="required" name="arch[{{$key2}}][organisation]">
                    </div>

                    <div class="col-md-2">
                      <input class="form-control" type="text" value="{{$value2->arc_contact}}" required="required" minlength="10" maxlength="10" name="arch[{{$key2}}][contact]">
                    </div>
                    <div class="col-md-2">
                      <input class="form-control" type="text"  value="{{$value2->arc_email}}" required="required" name="arch[{{$key2}}][email]">
                    </div>
                    <div class="col-md-1">
                      <i class="fa fa-trash remove-client-field" style="color: red"></i>
                    </div>

                   </div>

                   </td> 

                 </tr>  
              @endforeach
          </table>
            </div>
             <div id="div2">
               <i class="fa fa-plus" id="dynamic-arc" style="color: green"></i>
             </div>

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

                     <div class="col-md-2">
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

                <input type="hidden"  id="land_length" value="{{count($land)}}"> 
                @foreach($land as $key3=>$value3)
               <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                     
                     <div class="col-md-3">
                      <input class="form-control" type="text"  value="{{$value3->land_name}}" required="required" name="land[{{$key3}}][name]">
                    </div>

                     <div class="col-md-2">
                      <input class="form-control" type="text"  value="{{$value3->land_designation}}" required="required" name="land[{{$key3}}][designation]" >
                    </div>

                     <div class="col-md-2">
                      <input class="form-control" type="text"  value="{{$value3->land_organisation}}" required="required" name="land[{{$key3}}][organisation]" >
                    </div>

                    <div class="col-md-2">
                      <input class="form-control" type="text"  value="{{$value3->land_contact}}" required="required" minlength="10" maxlength="10" name="land[{{$key3}}][contact]">
                    </div>
                    <div class="col-md-2">
                      <input class="form-control" type="text"  value="{{$value3->land_email}}" required="required" name="land[{{$key3}}][email]" >
                    </div>
                     <div class="col-md-1">
                      <i class="fa fa-trash remove-client-field" style="color: red"></i>
                    </div>

                   </div>

                   </td> 

                 </tr>  
                @endforeach
          </table>
            </div>
             <div id="div2">
               <i class="fa fa-plus" id="dynamic-land" style="color: green"></i>
             </div>

          </div>
          
        </div>

        <!--row 4 HRE details -->

        <div class="card" style="background-color: #fff">
          <div class="card-body" >
            <h5 class="card-header" style="font-weight: bolder;background-color: #edf2ef">HRE Details</h5>

            <div id="div2">
                <input class="btn btn-outline-secondary form-control" type= "button" id="hre_add" value= "Add" onclick= "clearInput()">
            </div>

            <div id="div2">
               <input class="typeahead form-control" type="text" name="product" id="product" placeholder="Search name / ID" >
            </div>

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

              <input type="hidden"  id="hre_length" value="{{count($hre)}}">  
              @foreach($hre as $key4=>$value4)
              <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                     
                     <div class="col-md-2">
                      <input class="form-control" type="text"  value="{{$value4->name}}" required="required" name="hre[{{$key4}}][name]" >
                    </div>

                     <div class="col-md-2">
                      <input class="form-control" type="text"  value="{{$value4->designation}}" required="required" name="hre[{{$key4}}][designation]" >
                    </div>

                    <div class="col-md-2">
                      <input class="form-control" type="text"  value="{{$value4->contact}}" required="required" minlength="10" maxlength="10" name="hre[{{$key4}}][contact]">
                    </div>
                    <div class="col-md-2">
                      <input class="form-control" type="text"  value="{{$value4->email}}" required="required" name="hre[{{$key4}}][email]" >
                    </div>
                    <div class="col-md-2">
                      <input class="form-control" type="date"  value="{{$value4->start_date}}" required="required" name="hre[{{$key4}}][start]">
                    </div>
                    <div class="col-md-2">
                      <input class="form-control" type="date"  value="{{$value4->end_date}}" required="required" name="hre[{{$key4}}][end]">
                    </div>
                    

                   </div>
                    <div class="col-md-1" >
                      <i class=" fa fa-trash remove-client-field" style="color: red"></i>
                    </div>

                   </td> 

                 </tr>  
              @endforeach
          </table>
            </div>
             <!-- <div id="div2">
               <i class="fa fa-plus" id="dynamic-hre"></i>
             </div> -->
            
          </div>

          <div id = "dynamic_form" style="display: none;">
               <div id="container"></div>
            
           </div> 
        </div>

        

       <!-- Row 6 Vendor details -->

       <div class="card">
        <div class="card-body">
          <h5 class="card-header">All Vendors Details</h5>

          <div id="div2">
            <input class="btn btn-outline-secondary form-control" type= "button"  id="vendor_add"  value= "Add" onclick= "clearvendorInput()">
          </div>

          <div id="div2">
            <input class="typeahead form-control" type="text" name="vendor_search" id="vendor_search" placeholder="Search Vendor Name / ID" >
          </div>

          <div>
              
               <table class="table table-responsive " id="dynamicvendor">
                <input type="hidden"  id="vendor_length" value="{{count($vendor)}}">
              @foreach($vendor as $key5=>$value5)

              <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                     
                     <div class="col-md-3">
                      <label class="label-bold">Department Heading</label>
                      <input class="form-control" type="text"  value="{{$value5->department}}" required="required" name="vendor[{{$key5}}][department]" >
                    </div>

                     <div class="col-md-3">
                      <label class="label-bold">Vendor Company Name</label>
                      <input class="form-control" type="text"  value="{{$value5->company_name}}" required="required" name="vendor[{{$key5}}][company]">
                    </div>

                    <div class="col-md-3">
                      <label class="label-bold">Contractor's Name</label>
                      <input class="form-control" type="text"  value="{{$value5->contracter_name}}"value="{{$value5->department}}" required="required" name="vendor[{{$key5}}][name]">
                    </div>
                    <div class="col-md-3">
                      <label class="label-bold">Mobile No.</label>
                      <input class="form-control" type="text"  value="{{$value5->contracter_mobile}}" required="required" minlength="10" maxlength="10" name="vendor[{{$key5}}][mobile]">
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-3">
                      <label class="label-bold">Supervisor Name</label>
                      <input class="form-control" type="text"  value="{{$value5->supervisor_name}}" required="required" name="vendor[{{$key5}}][supervisor]">
                    </div>
                    <div class="col-md-3">
                      <label class="label-bold">Mobile No.</label>
                      <input class="form-control" type="text"  value="{{$value5->supervisor_mobile}}" required="required" minlength="10" maxlength="10" name="vendor[{{$key5}}][supr_mobile]">
                    </div>
                    <div class="col-md-3">
                      <label class="label-bold">Start Date</label>
                      <input class="form-control" type="date"  value="{{$value5->start_date}}" required="required" name="vendor[{{$key5}}][start]">
                    </div>
                    <div class="col-md-3">
                      <label class="label-bold">End Date</label>
                      <input class="form-control" type="date"  value="{{$value5->end_date}}" required="required" name="vendor[{{$key5}}][end]">
                    </div>

                   </div>
                   <div class="col-md-1">
                      <i class=" fa fa-trash remove-client-field" style="color: red"></i>
                    </div>


                   </td> 

                 </tr> 

              @endforeach
            
          </table>
            </div>
            <!--  <div id="div2">
               <i class="fa fa-plus" id="dynamic-vendor"></i>
             </div> -->
        </div>

         <div id="dynamic_form_vendor" style="display: none;">
               <div id="container_vendor"></div>
               
        </div>

        <!-- last form -->

        <div class="row">
         <div class="col-md-6">
              <div class="card" style="background-color: #fff">
                <div class="card-body" style="padding: 0px" >
                   
                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Form Filled By </label>
                      <div class="col-9 ">
                        <input  class="form-control" type="text" required="required" value="{{auth::user()->name}}"  placeholder="PCN " >
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Designation</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" required="required" value="{{auth::user()->roles->alias}}">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Date</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" required="required" value="{{date('d-m-Y H:i')}}" >
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
                        <input  class="form-control" type="text"  >
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">PCN Alloted By</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text"  >
                      </div>
                    </div>

                </div>
              </div>
              
            </div>
          
        </div>


         
       </div>
       <input type="hidden" name="histogram_id" value="{{$id}}">
       <div id="div2">
         <button class="btn btn-success" id="submit" type="submit">Update</button>
       </div>
       
      </form>
    </div>
  
</div>

<script type="text/javascript">
   
    var j = 'n';
    $("#dynamic-client").click(function () {
       var i = $("#client_length").val();
        ++i;
       
         $("#dynamicclient").append('<tr><td><div class="row align-items-end"><div class="col-md-3"><input class="form-control" type="text" name="client['+ i +'][name]"required=" required"></div><div class="col-md-2"><input class="form-control" type="text" name="client['+ i +'][designation]" required="required"></div> <div class="col-md-2"><input class="form-control" type="text" name="client['+ i +'][organisation]"required=" required"></div> <div class="col-md-2"><input class="form-control" type="text" name="client['+ i +'][contact]" required="required" minlength="10" maxlength="10"></div><div class="col-md-2"><input class="form-control" type="text" name="client['+ i +'][email]" required="required"></div> <div class="col-md-1"><i class="fa fa-trash remove-client-field" style="color: red"></i></div></div> </td></tr>');
        
        $("#client_length").val(i);
        document.getElementById("btnn").style.display="block";
    });
    $(document).on('click', '.remove-client-field', function () {
     // alert("ll");
    
      if (j==0 && i==1){
       
        alert('There must be atleast one client details');
      }
      else
       {
        var del=confirm("Are you sure to delete ?");
      // alert(del);
          if (del==true){
              $(this).parents('tr').remove();
              --i;
          }
        
      }

    });

      
</script>


<script type="text/javascript">
   
    var j = 'n';
    $("#dynamic-arc").click(function () {
       var i = $("#arch_length").val();
        ++i;
         $("#dynamicArc").append('<tr><td><div class="row align-items-end"><div class="col-md-3"><input class="form-control" type="text" name="arch['+ i +'][name]"required=" required"></div><div class="col-md-2"><input class="form-control" type="text" name="arch['+ i +'][designation]" required="required"></div> <div class="col-md-2"><input class="form-control" type="text" name="arch['+ i +'][organisation]"required=" required"></div> <div class="col-md-2"><input class="form-control" type="text" name="arch['+ i +'][contact]" required="required" minlength="10" maxlength="10"></div><div class="col-md-2"><input class="form-control" type="text" name="arch['+ i +'][email]" required="required"></div><div class="col-md-1"><i class="fa fa-trash remove-client-field" style="color: red"></i></div></div></td></tr>');
        

        document.getElementById("btnn").style.display="block";
    });
    $(document).on('click', '.remove-client-field', function () {
    
      if (j==0 && i==1){
       
        alert('There must be atleast one address');
      }
      else
       {
        if (del==true){
              $(this).parents('tr').remove();
              --i;
          }
      }

    });

   
</script>


<script type="text/javascript">
   
    var j = 'n';
    $("#dynamic-land").click(function () {
       var i = $("#land_length").val();
        ++i;
         $("#dynamicland").append('<tr><td><div class="row align-items-end"><div class="col-md-3"><input class="form-control" type="text" name="land['+ i +'][name]"required=" required"></div><div class="col-md-2"><input class="form-control" type="text" name="land['+ i +'][designation]" required="required"></div> <div class="col-md-2"><input class="form-control" type="text" name="land['+ i +'][organisation]"required=" required"></div>  <div class="col-md-2"><input class="form-control" type="text" name="land['+ i +'][contact]" required="required" minlength="10" maxlength="10"></div><div class="col-md-2"><input class="form-control" type="text" name="land['+ i +'][email]" required="required"></div><div class="col-md-1"><i class="fa fa-trash remove-client-field" style="color: red"></i></div> </div></td></tr>');
        

        document.getElementById("btnn").style.display="block";
    });
    $(document).on('click', '.remove-input-field', function () {
    
      if (j==0 && i==1){
       
        alert('There must be atleast one address');
      }
      else
       {
         if (del==true){
              $(this).parents('tr').remove();
              --i;
          }
      }

    });

     $(document).on('click', '.remove-input-mandate', function () {
     
      if(!i == 0){
      j=0;
        $(this).parents('tr').remove();
       
      }
      else {
        alert('There must be atleast one address');
      }
        
    });
      
</script>

<!-- <script type="text/javascript">
    var i = $("#hre_length").val();;
    var j = 'n';
    $("#dynamic-hre").click(function () {
        ++i;
         $("#dynamichre").append('<tr><td><div class="row align-items-end"><div class="col-md-2"><input class="form-control" type="text" name="hre['+ i +'][name]"required=" required"></div><div class="col-md-2"><input class="form-control" type="text" name="hre['+ i +'][designation]" required="required"></div><div class="col-md-2"><input class="form-control" type="text" name="hre['+ i +'][contact]" required="required" minlength="10" maxlength="10"></div><div class="col-md-2"><input class="form-control" type="text" name="hre['+ i +'][email]" required="required"></div> <div class="col-md-2"><input class="form-control" type="date" name="hre['+ i +'][start]" required="required"></div> <div class="col-md-2"><input class="form-control" type="date" name="hre['+ i +'][end]" required="required"></div> </div></div></td></tr>');
        

        document.getElementById("btnn").style.display="block";
    });
    $(document).on('click', '.remove-input-field', function () {
    
      if (j==0 && i==1){
       
        alert('There must be atleast one address');
      }
      else
       {
        $(this).parents('tr').remove();
         --i;
      }

    });

     $(document).on('click', '.remove-input-mandate', function () {
     
      if(!i == 0){
      j=0;
        $(this).parents('tr').remove();
       
      }
      else {
        alert('There must be atleast one address');
      }
        
    });
      
</script>

<script type="text/javascript">
    var i = $("#vendor_length").val();;
    var j = 'n';
    $("#dynamic-vendor").click(function () {
        ++i;
         $("#dynamicvendor").append('<tr><td><div class="row align-items-end"><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][department]"required=" required" placeholder="department"></div><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][company]" required="required" placeholder="company name"></div><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][name]" required="required" placeholder="contractor name"></div><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][mobile]" required="required" placeholder="mobile"></div>  </div><div class="row"><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][supervisor]" required="required" placeholder="supervisor name"></div> <div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][supr_mobile]" required="required" placeholder="mobile"></div> <div class="col-md-3"><input class="form-control" type="date" name="vendor['+ i +'][start]" required="required" ></div> <div class="col-md-3"><input class="form-control" type="date" name="vendor['+ i +'][end]" required="required"></div> </div></div></td></tr>');
        

        document.getElementById("btnn").style.display="block";
    });
    $(document).on('click', '.remove-input-field', function () {
    
      if (j==0 && i==1){
       
        alert('There must be atleast one address');
      }
      else
       {
        $(this).parents('tr').remove();
         --i;
      }

    });

     $(document).on('click', '.remove-input-mandate', function () {
     
      if(!i == 0){
      j=0;
        $(this).parents('tr').remove();
       
      }
      else {
        alert('There must be atleast one address');
      }
        
    });
      
</script> -->

<script type="text/javascript">
  var i = 0;

$( document ).ready(function() {
  var path = "{{ route('autocomplete_employee') }}";
   let text = "";
    $( "#product" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            
            success: function (data) {
              
                response(data)
            }
        });
    },
        select: function (event, ui) {

          $('#product').val(ui.item.value);
           var name = ui.item.name;
          var emplid = ui.item.employee_id;
          var designation = ui.item.alias;
          var mobile = ui.item.mobile;
          var email = ui.item.email;

          // populateHREinputs(name , emplid , designation , mobile , email);
           populateinputs(name , emplid , designation , mobile , email);
           
           document.querySelector('#hre_add').value = 'Clear';
         
        }
      })
});

 $(document).on('click', '.remove-hre-field', function () {
 // alert("lll");
  //document.getElementById("row").remove();
  Swal.fire({
  title: 'Are you sure to remove this ?',
 // text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, remove it!'
}).then((result) => {
  if (result.isConfirmed) {
    document.getElementById("row").remove();
  // $(this).parents('tr').remove();
   // clearInput();
   /* Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )*/
  }
})
  
    });

function populateinputs(item_code , name ,  brand , info , uom){
   var x = document.getElementById("dynamic_form");
   if (x.style.display === "none") {
    x.style.display = "block";
  } 

   var i=$("#hre_length").val();
  
  // console.log('INOF==',inform);

  $('#container').append('<div class="row " id="row" style="padding:20px"> <div class="col-md-2"><input class="form-control" type="text" name="hre['+ i +'][name]"  value="'+ item_code +'" ></div><div class="col-md-2"><input class="form-control" type="text" name="hre['+ i +'][designation]" value="'+ brand +'" required ></div><div class="col-md-2"><input class="form-control" type="text" name="hre['+ i +'][contact]"  value="'+ info +'" ></div>  <div class="col-md-2"><input class="form-control" type="text" name="hre['+ i +'][email]" value="'+ uom +'" ></div><div class="col-md-2"><input class="form-control" type="date" name="hre['+ i +'][start]"  required></div> <div class="col-md-2"><input class="form-control" type="date" name="hre['+ i +'][end]"  required></div> <div class="col-md-1"><i class="fa fa-trash remove-hre-field" style="color: red"></i></div> </div>') ;


  setTimeout(function(){
  adjustHeight(this);       
},1000)
 
    ++i;

  }

  function remove_hre(){
    alert("ll");
  }


 function adjustHeight(el){
    el.style.height = (el.scrollHeight > el.clientHeight) ? (el.scrollHeight)+"px" : "60px";
}

function clearInput(){
    //alert("ll");
      var getValue= document.getElementById("product");
        if (getValue.value !="") {
            getValue.value = "";
        }
        document.querySelector('#hre_add').value = 'Add';
 }

</script>


<script type="text/javascript">
  var i = 0;

$( document ).ready(function() {
  var path = "{{ route('autocomplete_vendor') }}";
   let text = "";
    $( "#vendor_search" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            
            success: function (data) {
              
                response(data)
            }
        });
    },
        select: function (event, ui) {

          $('#vendor_search').val(ui.item.value);
           var name = ui.item.billing_name;
          var contr_name = ui.item.owner;
          var mobile = ui.item.mobile;
          //alert(owner);
          

           populatevendorinputs(name , contr_name , mobile );
           document.querySelector('#vendor_add').value = 'Clear';
            
         
        }
      })
});

 $(document).on('click', '.remove-vendor-field', function () {
//  alert(i);
  //document.getElementById("row").remove();
  Swal.fire({
  title: 'Are you sure to remove this material?',
 // text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, remove it!'
}).then((result) => {
  if (result.isConfirmed) {
    document.getElementById("row").remove();
   //$(this).parents('tr').remove();
   // clearInput();
   /* Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )*/
  }
})
  
    });

function populatevendorinputs(item_code , name ,  brand ){
 // alert(name);
   var x = document.getElementById("dynamic_form_vendor");
   if (x.style.display === "none") {
    x.style.display = "block";
  } 
  var i=$("#vendor_length").val();

  $('#container_vendor').append('<div class="row align-items-end div-margin"  style="padding-left:20px;padding-right:20px"><div class="col-md-3"><select class="form-control form-select" name="vendor['+ i +'][department]" required><option value="">Select</option>@foreach($headings as $key=>$value)<option value="{{$value->headings}}">{{$value->headings}}</option>@endforeach</select></div><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][company]" value="'+ item_code +'"  required="required" placeholder="company name"></div><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][name]" value="'+ name +'"  required="required" placeholder="contractors name"></div><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][mobile]" value="'+ brand +'"  required="required" placeholder="mobile"></div>  </div><div class="row align-items-end"  style="padding-left:20px;padding-right:20px"><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][supervisor]" required="required" placeholder="supervisor name"></div> <div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][supr_mobile]"minlength="10" maxlength="10" required="required" placeholder="mobile"></div> <div class="col-md-3"><input class="form-control" type="date" name="vendor['+ i +'][start]" required="required" ></div> <div class="col-md-3"><input class="form-control" type="date" name="vendor['+ i +'][end]" required="required"></div><div class="col-md-1"><i class="fa fa-trash remove-vendor-field" style="color: red"></i></div> </div>') ;

  setTimeout(function(){
  adjustHeight(this);       
},1000)
 
    ++i;

  }


 function adjustHeight(el){
    el.style.height = (el.scrollHeight > el.clientHeight) ? (el.scrollHeight)+"px" : "60px";
}

function clearvendorInput(){
    //alert("ll");
      var getValue= document.getElementById("vendor_search");
        if (getValue.value !="") {
            getValue.value = "";
        }
         document.querySelector('#vendor_add').value = 'Add';
 }

</script>

<script>
$(document).ready(function() {
    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');
    });
});
</script>

@endsection