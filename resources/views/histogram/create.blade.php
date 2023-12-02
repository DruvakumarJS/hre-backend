@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
          <div id="div1"> 
            <label style="font-size: 20px;font-weight: bolder;">PCN Registration Form / Project Histogram</label>
          </div>
          
           
        </div>     
       
        <div class="page-container">
          <form method="POST" action="{{ route('save_histogram')}}">
            @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="card" style="background-color: #fff">
                <div class="card-body" style="padding: 0px" >
                  <h5 class="card-header " style="font-weight: bold;background-color: #edf2ef;">Client Billing Details</h5>
                    
                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">PCN </label>
                      <div class="col-9 ">
                        <input  class="form-control" type="text" name="pcn" required="required" value=""  placeholder="PCN " readonly>
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Client Billing Name </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" name="billing_name" required="required" value=""  placeholder="Billing Name ">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">GST Number </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" name="gst" required="required" value=""  placeholder="GST Number" minlength="15" maxlength="15">
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

                          <!-- <div class="form-group row " style="margin-top: 10px">
                              <label for="" class="col-3 col-form-label">Project Name</label>
                              <div class="col-9"  >
                                <input  class="form-control" type="text" name="project_name" required="required" value=""  placeholder="Project Name">
                              </div>
                          </div> -->
                          <div class="row" style="margin-top: 10px" >
                             <div class="col-6">
                                <input  class="form-control" type="text" name="project_name" required="required" value=""  placeholder="Project Name">
                             </div>
                             <div class="col-6">
                                <input  class="form-control" type="text" name="type" required="required" value=""  placeholder="Type Of Work">
                             </div>
                           </div>

                        <!--   <label for="" class="col-6 col-form-label">Site Full Address </label>   -->
                           <div class="row" style="margin-top: 10px" >
                             <div class="col-6">
                                <input  class="form-control" type="text" name="location" required="required" value=""  placeholder="Location">
                             </div>
                             <div class="col-6">
                                <input  class="form-control" type="text" name="area" required="required" value=""  placeholder="Area / Building">
                             </div>
                           </div>

                           <div class="row" style="margin-top: 10px" >
                             <div class="col-6">
                                <input  class="form-control" type="text" name="city" required="required" value=""  placeholder="City ">
                             </div>
                             <div class="col-3">
                                <input  class="form-control" type="text" name="state" required="required" value=""  placeholder="State">
                             </div>

                             <div class="col-3">
                                <input  class="form-control" type="text" name="pincode" required="required" value=""  placeholder="PINCODE">
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
                        <input  class="form-control" type="date"  name="target_start_date" required="required" value="" id="target_start_date" placeholder="Target Start Date " autocomplete="off">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Target End Date </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="date" name="target_end_date" required="required" value=""  id="target_end_date" placeholder="Target End Date " autocomplete="off">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Approved Holidays Count</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="Number" name="approved_holidays_no" required="required" value=""  placeholder="Approved Holidays Count">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Dates</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" name="holiday_dates" required="required" value=""  placeholder="Approved Holiday Dates" >
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
                        <input  class="form-control" type="date" name="actual_start_date" required="required" value="" id="actual_start_date" placeholder="Actual Start Date " autocomplete="off">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Actual End Date </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="date" name="actual_end_date" required="required" value=""  id="actual_end_date" placeholder="Actual End Date " autocomplete="off">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Holidays & Project Hold Days </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="Number" name="hold_days_no" required="required" value=""  placeholder="Holidays and Hold Count">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Dates</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" name="hold_dates" required="required" value=""  placeholder="Holiday & Project Hold Dates" >
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
                  <input  class="form-control" type="date" name="po_date" required="required" value=""  id="po_date" placeholder="PO Date " autocomplete="off">
                </div>
              </div>
            
            
          </div>

          <div class="col-md-4">
           
              <div class="form-group row" style="padding: 5px">
                <label for="" class="col-3 col-form-label label-bold">PO Number </label>
                <div class="col-9 " >
                  <input  class="form-control" type="text" name="po_number" required="required" value=""  placeholder="PO Number">
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
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
              </div>
            
            
          </div>

          <div class="col-md-4">
           
              <div class="form-group row" style="padding: 5px">
                <label for="" class="col-3 col-form-label label-bold">DLP Days </label>
                <div class="col-9 " >
                  <input  class="form-control" type="text" name="dlp_days" required="required" value=""  placeholder="DLP Days">
                </div>
              </div>
                        
          </div>

          <div class="col-md-4">
           
              <div class="form-group row" style="padding: 5px">
                <label for="" class="col-4 col-form-label label-bold">DLP End Date </label>
                <div class="col-8 " >
                  <input  class="form-control" type="date" name="dlp_end_date" required="required" value=""  placeholder="DLP End Date" id="dlp_end_date" autocomplete="off">
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
                      <input class="form-control" type="text" name="client[0][name]" required="required">
                    </div>

                     <div class="col-md-3">
                      <label class="label-bold">Designation</label>
                      <input class="form-control" type="text" name="client[0][designation]" required="required">
                    </div>

                     <div class="col-md-2">
                      <label class="label-bold">Organisation</label>
                      <input class="form-control" type="text" name="client[0][organisation]" required="required">
                    </div>

                    <div class="col-md-2">
                      <label class="label-bold">Contact No.</label>
                      <input class="form-control" type="text" name="client[0][contact]" required="required" minlength="10" maxlength="10">
                    </div>
                    <div class="col-md-2">
                      <label class="label-bold">Email ID</label>
                      <input class="form-control" type="text" name="client[0][email]" required="required" >
                    </div>

                   </div>

                   </td> 

                 </tr>  

          </table>
            </div>
             <div id="div2">
               <i class="fa fa-plus" id="dynamic-client"></i>
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
                      <input class="form-control" type="text" name="arch[0][name]" required="required">
                    </div>

                     <div class="col-md-3">
                      <label class="label-bold">Designation</label>
                      <input class="form-control" type="text" name="arch[0][designation]" required="required">
                    </div>

                    <div class="col-md-2">
                      <label class="label-bold">Organisation</label>
                      <input class="form-control" type="text" name="arch[0][organisation]" required="required">
                    </div>

                    <div class="col-md-2">
                      <label class="label-bold">Contact No.</label>
                      <input class="form-control" type="text" name="arch[0][contact]" required="required" minlength="10" maxlength="10">
                    </div>
                    <div class="col-md-2">
                      <label class="label-bold">Email ID</label>
                      <input class="form-control" type="text" name="arch[0][email]" required="required" >
                    </div>

                   </div>

                   </td> 

                 </tr>  

          </table>
            </div>
             <div id="div2">
               <i class="fa fa-plus" id="dynamic-arc"></i>
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
                      <input class="form-control" type="text" name="land[0][name]" required="required">
                    </div>

                     <div class="col-md-3">
                      <label class="label-bold">Designation</label>
                      <input class="form-control" type="text" name="land[0][designation]" required="required">
                    </div>

                     <div class="col-md-2">
                      <label class="label-bold">Organisation</label>
                      <input class="form-control" type="text" name="land[0][organisation]" required="required">
                    </div>

                    <div class="col-md-2">
                      <label class="label-bold">Contact No.</label>
                      <input class="form-control" type="text" name="land[0][contact]" required="required" minlength="10" maxlength="10">
                    </div>
                    <div class="col-md-2">
                      <label class="label-bold">Email ID</label>
                      <input class="form-control" type="text" name="land[0][email]" required="required">
                    </div>

                   </div>

                   </td> 

                 </tr>  

          </table>
            </div>
             <div id="div2">
               <i class="fa fa-plus" id="dynamic-land"></i>
             </div>

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
                      <input  id="client_name" type="text" class="typeahead form-control"  name="hre[0][name]" required="required" placeholder="Search by name / ID">
                     <!--  <input name="client_name" id="client_name" type="text" class="typeahead form-control" required="required"  placeholder="Search by name / ID"> -->
                    </div>

                     <div class="col-md-2">
                      <label class="label-bold">Designation</label>
                      <input class="form-control" id="designation" type="text" name="hre[0][designation]" required="required">
                    </div>

                    <div class="col-md-2">
                      <label class="label-bold">Contact No.</label>
                      <input class="form-control" type="text" id="contact" name="hre[0][contact]" required="required" minlength="10" maxlength="10">
                    </div>
                    <div class="col-md-2">
                      <label class="label-bold">Email ID</label>
                      <input class="form-control" type="text" id="email" name="hre[0][email]" required="required" >
                    </div>
                    <div class="col-md-2">
                      <label class="label-bold">Start Date</label>
                      <input class="form-control" type="date" name="hre[0][start]" required="required" >
                    </div>
                    <div class="col-md-2">
                      <label class="label-bold">End Date</label>
                      <input class="form-control" type="date" name="hre[0][end]" required="required" >
                    </div>

                   </div>

                   </td> 

                 </tr>  

          </table>
            </div>
             <div id="div2">
               <i class="fa fa-plus" id="dynamic-hre"></i>
             </div>
            
          </div>
        </div>

        

       <!-- Row 6 Vendor details -->

       <div class="card">
        <div class="card-body">
          <h5 class="card-header">All Vendors Details</h5>
          <div>
              
               <table class="table table-responsive " id="dynamicvendor">
              
              <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                     
                     <div class="col-md-3">
                      <label class="label-bold">Department Heading</label>
                      <select class="form-control form-select" name="vendor[0][department]">
                        <option value="">Select</option>
                        <option>Civil</option>
                        <option>Carpentry</option>
                      </select>
                    </div>

                     <div class="col-md-3">
                      <label class="label-bold">Vendor Company Name</label>
                      <input class="typeahead form-control" id="vendor" type="text" name="vendor[0][company]" required="required"
                      placeholder="company name">
                    </div>

                    <div class="col-md-3">
                      <label class="label-bold">Contractor's Name</label>
                      <input class="form-control" id="contractor_name" type="text" name="vendor[0][name]" required="required" placeholder="contractor's name" >
                    </div>
                    <div class="col-md-3">
                      <label class="label-bold">Mobile No.</label>
                      <input class="form-control" id="contractor_mobile" type="text" name="vendor[0][mobile]" required="required" minlength="10" maxlength="10" placeholder="Mobile No.">
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-3">
                      <label class="label-bold">Supervisor Name</label>
                      <input class="form-control" type="text" name="vendor[0][supervisor]" required="required" placeholder="supervisor name">
                    </div>
                    <div class="col-md-3">
                      <label class="label-bold">Mobile No.</label>
                      <input class="form-control" type="text" name="vendor[0][supr_mobile]" required="required" minlength="10" maxlength="10" placeholder="mobile no">
                    </div>
                    <div class="col-md-3">
                      <label class="label-bold">Start Date</label>
                      <input class="form-control" type="date" name="vendor[0][start]" required="required" >
                    </div>
                    <div class="col-md-3">
                      <label class="label-bold">End Date</label>
                      <input class="form-control" type="date" name="vendor[0][end]" required="required" >
                    </div>

                   </div>

                   </td> 

                 </tr>  

          </table>
            </div>
             <div id="div2">
               <i class="fa fa-plus" id="dynamic-vendor"></i>
             </div>
        </div>
         
       </div>
       <div id="div2">
         <button class="btn btn-success" type="submit">Submit</button>
       </div>
       
      </form>
    </div>
  
</div>


<script type="text/javascript">
    var i = 0;
    var j = 'n';
    $("#dynamic-client").click(function () {
        ++i;
         $("#dynamicclient").append('<tr><td><div class="row align-items-end"><div class="col-md-3"><input class="form-control" type="text" name="client['+ i +'][name]"required=" required"></div><div class="col-md-3"><input class="form-control" type="text" name="client['+ i +'][designation]" required="required"></div> <div class="col-md-2"><input class="form-control" type="text" name="client['+ i +'][organisation]"required=" required"></div> <div class="col-md-2"><input class="form-control" type="text" name="client['+ i +'][contact]" required="required" minlength="10" maxlength="10"></div><div class="col-md-2"><input class="form-control" type="text" name="client['+ i +'][email]" required="required"></div> </div></td></tr>');
        

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
    var i = 0;
    var j = 'n';
    $("#dynamic-arc").click(function () {
        ++i;
         $("#dynamicArc").append('<tr><td><div class="row align-items-end"><div class="col-md-3"><input class="form-control" type="text" name="arch['+ i +'][name]"required=" required"></div><div class="col-md-3"><input class="form-control" type="text" name="arch['+ i +'][designation]" required="required"></div> <div class="col-md-2"><input class="form-control" type="text" name="arch['+ i +'][organisation]"required=" required"></div> <div class="col-md-2"><input class="form-control" type="text" name="arch['+ i +'][contact]" required="required" minlength="10" maxlength="10"></div><div class="col-md-2"><input class="form-control" type="text" name="arch['+ i +'][email]" required="required"></div> </div></td></tr>');
        

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
    var i = 0;
    var j = 'n';
    $("#dynamic-land").click(function () {
        ++i;
         $("#dynamicland").append('<tr><td><div class="row align-items-end"><div class="col-md-3"><input class="form-control" type="text" name="land['+ i +'][name]"required=" required"></div><div class="col-md-3"><input class="form-control" type="text" name="land['+ i +'][designation]" required="required"></div> <div class="col-md-2"><input class="form-control" type="text" name="land['+ i +'][organisation]"required=" required"></div>  <div class="col-md-2"><input class="form-control" type="text" name="land['+ i +'][contact]" required="required" minlength="10" maxlength="10"></div><div class="col-md-2"><input class="form-control" type="text" name="land['+ i +'][email]" required="required"></div> </div></td></tr>');
        

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
    var i = 0;
    var j = 'n';
    $("#dynamic-hre").click(function () {
        ++i;
         $("#dynamichre").append('<tr><td><div class="row align-items-end"><div class="col-md-2"><input class="form-control" type="text" id="client_name_['+ i +']" name="hre['+ i +'][name]"required=" required"></div><div class="col-md-2"><input class="form-control" type="text" name="hre['+ i +'][designation]" required="required"></div><div class="col-md-2"><input class="form-control" type="text" name="hre['+ i +'][contact]" required="required" minlength="10" maxlength="10"></div><div class="col-md-2"><input class="form-control" type="text" name="hre['+ i +'][email]" required="required"></div> <div class="col-md-2"><input class="form-control" type="date" name="hre['+ i +'][start]" required="required"></div> <div class="col-md-2"><input class="form-control" type="date" name="hre['+ i +'][end]" required="required"></div> </div></div></td></tr>');
        

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

      $( document ).ready(function() {
  var path = "{{ route('autocomplete_employee') }}";
   let text = "";
    $( '#client_name_['+ i +']' ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
              
              console.log(data);
               response( data );
               //$('#user_name').val(ui.item.lable);
              
            }
          });
        },
        select: function (event, ui) {
          $('#client_name').val(ui.item.name);
          $('#designation').val(ui.item.alias);
          $('#contact').val(ui.item.mobile);
           
        }
      });

    
});
      
</script>

<script type="text/javascript">
    var i = 0;
    var j = 'n';
    $("#dynamic-vendor").click(function () {
        ++i;
         $("#dynamicvendor").append('<tr><td><div class="row align-items-end"><div class="col-md-3"><select class="form-control form-select" name="vendor['+ i +'][department]"><option value="">Select</option><option>Civil</option><option>Carpentry</option></select></div><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][company]" required="required" placeholder="company name"></div><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][name]" required="required" placeholder="contractors name"></div><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][mobile]" required="required" placeholder="mobile"></div>  </div><div class="row"><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][supervisor]" required="required" placeholder="supervisor name"></div> <div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][supr_mobile]" required="required" placeholder="mobile"></div> <div class="col-md-3"><input class="form-control" type="date" name="vendor['+ i +'][start]" required="required" ></div> <div class="col-md-3"><input class="form-control" type="date" name="vendor['+ i +'][end]" required="required"></div> </div></div></td></tr>');
        

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

$( document ).ready(function() {
  var path = "{{ route('autocomplete_employee') }}";
   let text = "";
    $( "#client_name" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
              
              console.log(data);
               response( data );
               //$('#user_name').val(ui.item.lable);
              
            }
          });
        },
        select: function (event, ui) {
          $('#client_name').val(ui.item.name);
          $('#designation').val(ui.item.alias);
          $('#contact').val(ui.item.mobile);
          $('#email').val(ui.item.email);
           
        }
      });

    
});

</script>

<script type="text/javascript">

$( document ).ready(function() {
  var path = "{{ route('autocomplete_vendor') }}";
   let text = "";
    $( "#vendor" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
              
              console.log(data);
               response( data );
               //$('#user_name').val(ui.item.lable);
              
            }
          });
        },
         select: function (event, ui) {
           $('#vendor').val(ui.item.billing_name);
            //$('#brand').val(ui.item.brand);
            $('#contractor_name').val(ui.item.id);
            $('#contractor_name').val(ui.item.owner);
            $('#contractor_mobile').val(ui.item.mobile);

           var address = ui.item.address ;
           console.log(address); 

        }

      });

    
});

</script>
<!-- 
<script type="text/javascript">
  $( function() {
      $( "#target_start_date" ).datepicker({
        //minDate:0,
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText, $el) {
         
        }
      });
    });

  $( function() {
      $( "#target_end_date" ).datepicker({
        //minDate:0,
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText, $el) {
         
        }
      });
    });

  $( function() {
      $( "#actual_start_date" ).datepicker({
        //minDate:0,
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText, $el) {
         
        }
      });
    });

  $( function() {
      $( "#actual_end_date" ).datepicker({
        //minDate:0,
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText, $el) {
         
        }
      });
    });

   $( function() {
      $( "#po_date" ).datepicker({
        //minDate:0,
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText, $el) {
         
        }
      });
    });

    $( function() {
      $( "#dlp_end_date" ).datepicker({
        //minDate:0,
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText, $el) {
         
        }
      });
    });

</script>
 -->


@endsection