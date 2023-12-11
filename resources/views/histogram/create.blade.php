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
                      <label for="" class="col-3 col-form-label">Client Billing Name*</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="text" name="billing_name" required="required" value=""  placeholder="Billing Name ">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">GST Number*</label>
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
                                <input  class="form-control" type="text" name="project_name" required="required" value=""  placeholder="Project Name*">
                             </div>
                             <div class="col-6">
                                <input  class="form-control" type="text" name="type" required="required" value=""  placeholder="Type Of Work*">
                             </div>
                           </div>

                        <!--   <label for="" class="col-6 col-form-label">Site Full Address </label>   -->
                           <div class="row" style="margin-top: 10px" >
                             <div class="col-6">
                                <input  class="form-control" type="text" name="location" required="required" value=""  placeholder="Location*">
                             </div>
                             <div class="col-6">
                                <input  class="form-control" type="text" name="area" required="required" value=""  placeholder="Area / Building*">
                             </div>
                           </div>

                           <div class="row" style="margin-top: 10px" >
                             <div class="col-6">
                                <input  class="form-control" type="text" name="city" required="required" value=""  placeholder="City* ">
                             </div>
                             <div class="col-3">
                                <input  class="form-control" type="text" name="state" required="required" value=""  placeholder="State*">
                             </div>

                             <div class="col-3">
                                <input  class="form-control" type="text" name="pincode" required="required" value=""  placeholder="PINCODE*">
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
                        <input  class="form-control" type="date"  name="target_start_date" required="required" value="" id="target_start_date" placeholder="Target Start Date " autocomplete="off">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Target End Date* </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="date" name="target_end_date" required="required" value=""  id="target_end_date" placeholder="Target End Date " autocomplete="off">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Approved Holidays Count*</label>
                      <div class="col-9 " >
                        <input  class="form-control" type="Number" name="approved_holidays_no" required="required" value=""  placeholder="Approved Holidays Count">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Note*</label>
                      <div class="col-9 " >
                       <!--  <input  class="form-control date" id="holiday_dates"  type="text" name="holiday_dates" required="required" value=""  placeholder="Approved Holiday Dates" autocomplete="off" multiple> -->
                       <!-- <input  class="form-control" id="multiple-date-select" name="holiday_dates" autocomplete="off" placeholder="select dates" /> -->
                       <textarea class="form-control" name="holiday_dates"></textarea>
                       
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
                        <input  class="form-control" type="date" name="actual_start_date" value="" id="actual_start_date" placeholder="Actual Start Date " autocomplete="off">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Actual End Date </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="date" name="actual_end_date"  value=""  id="actual_end_date" placeholder="Actual End Date " autocomplete="off">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Holidays & Project Hold Days </label>
                      <div class="col-9 " >
                        <input  class="form-control" type="Number" name="hold_days_no" value=""  placeholder="Holidays and Hold Count">
                      </div>
                    </div>

                    <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Note</label>
                      <div class="col-9 " >
                        <!-- <input  class="form-control" type="text" name="hold_dates" required="required" value=""  placeholder="Holiday & Project Hold Dates" > -->
                         <!-- <input  class="form-control" id="multiple-date-select2" name="hold_dates" name="hold_dates" autocomplete="off" placeholder="select dates" /> -->
                         <textarea class="form-control" name="hold_dates"></textarea>
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
                  <input  class="form-control" type="date" name="po_date" required="required" value=""  id="po_date" placeholder="PO Date " autocomplete="off">
                </div>
              </div>
            
            
          </div>

          <div class="col-md-4">
           
              <div class="form-group row" style="padding: 5px">
                <label for="" class="col-4 col-form-label label-bold">PO Number* </label>
                <div class="col-8 " >
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
                <label for="" class="col-4 col-form-label label-bold">DLP Applicable* </label>
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
                  <input  class="form-control" type="number" name="dlp_days"  value="" min="0" max="366"  placeholder="DLP Days">
                </div>
              </div>
                        
          </div>

          <div class="col-md-4">
           
              <div class="form-group row" style="padding: 5px">
                <label for="" class="col-4 col-form-label label-bold">DLP End Date </label>
                <div class="col-8 " >
                  <input  class="form-control" type="date" name="dlp_end_date"  value=""  placeholder="DLP End Date" id="dlp_end_date" autocomplete="off">
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

            <div id="div2">
                <input class="btn btn-outline-secondary form-control" type= "button" value= "Add" onclick= "clearInput()">
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

          </table>
            </div>
            <!--  <div id="div2">
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
            <input class="btn btn-outline-secondary form-control" type= "button" value= "Add" onclick= "clearvendorInput()">
          </div>

          <div id="div2">
            <input class="typeahead form-control" type="text" name="vendor_search" id="vendor_search" placeholder="Search Vendor Name / ID" >
          </div>
          
        </div>

         <div id="dynamic_form_vendor" style="display: none;">
               <div id="container_vendor"></div>
            
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

      
</script>

<script type="text/javascript">
    var i = 0;
    var j = 'n';
    $("#dynamic-vendor").click(function () {
        ++i;
         $("#dynamicvendor").append('<tr><td><div class="row align-items-end"><div class="col-md-3"><select class="form-control form-select" name="vendor['+ i +'][department]" required><option value="">Select</option><option>Civil</option><option>Carpentry</option></select></div><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][company]" required="required" placeholder="company name"></div><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][name]" required="required" placeholder="contractors name"></div><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][mobile]" required="required" placeholder="mobile"></div>  </div><div class="row"><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][supervisor]" required="required" placeholder="supervisor name"></div> <div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][supr_mobile]" required="required" placeholder="mobile"></div> <div class="col-md-3"><input class="form-control" type="date" name="vendor['+ i +'][start]" required="required" ></div> <div class="col-md-3"><input class="form-control" type="date" name="vendor['+ i +'][end]" required="required"></div> </div></div></td></tr>');
        

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

<!-- <script type="text/javascript">

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

</script> -->

<!-- <script type="text/javascript">

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
           
           
         
        }
      })
});

 $(document).on('click', '.remove-input-field', function () {
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
   // document.getElementById("row").remove();
   $(this).parents('tr').remove();
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
 const JSONobject = JSON.parse(info); 
 
  const res_array = []; 
   for(let i in JSONobject) { 
      res_array.push([i,JSONobject[i]]); 
   };

  // console.log('INOF==',inform);

  $('#container').append('<tr><td><div class="row" id="row"> <div class="col-md-2"><input class="form-control" type="text" name="hre['+ i +'][name]"  value="'+ item_code +'" readonly></div><div class="col-md-2"><input class="form-control" type="text" name="hre['+ i +'][designation]" value="'+ brand +'" required></div><div class="col-md-2"><input class="form-control" type="text" name="hre['+ i +'][contact]"  value="'+ info +'" readonly></div>  <div class="col-md-2"><input class="form-control" type="text" name="hre['+ i +'][email]" value="'+ uom +'" readonly></div><div class="col-md-2"><input class="form-control" type="date" name="hre['+ i +'][start]"  required></div> <div class="col-md-2"><input class="form-control" type="date" name="hre['+ i +'][end]"  required></div>  </div></td></tr>') ;

  setTimeout(function(){
  adjustHeight(this);       
},1000)
 
    ++i;

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
           
            
         
        }
      })
});

 $(document).on('click', '.remove-input-field', function () {
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
   // document.getElementById("row").remove();
   $(this).parents('tr').remove();
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

  $('#container_vendor').append('<div class="row align-items-end div-margin"><div class="col-md-3"><select class="form-control form-select" name="vendor['+ i +'][department]" required><option value="">Select</option>@foreach($headings as $key=>$value)<option value="{{$value->headings}}">{{$value->headings}}</option>@endforeach</select></div><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][company]" value="'+ item_code +'" readonly required="required" placeholder="company name"></div><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][name]" value="'+ name +'" readonly required="required" placeholder="contractors name"></div><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][mobile]" value="'+ brand +'" readonly required="required" placeholder="mobile"></div>  </div><div class="row align-items-end"><div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][supervisor]" required="required" placeholder="supervisor name"></div> <div class="col-md-3"><input class="form-control" type="text" name="vendor['+ i +'][supr_mobile]" minlength="10" maxlength="10" required="required" placeholder="mobile"></div> <div class="col-md-3"><input class="form-control" type="date" name="vendor['+ i +'][start]" required="required" ></div> <div class="col-md-3"><input class="form-control" type="date" name="vendor['+ i +'][end]" required="required"></div> </div>') ;

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
 }

</script>
<script type="text/javascript">
 var arr = [];

function removeRow(r) {
  var index = arr.indexOf(r);
  if (index > -1) {
    arr.splice(index, 1);
  }
}
$('#multiple-date-select').multiDatesPicker({
  onSelect: function(datetext) {
    let table = $('#table-data');
    let rowLast = table.data('lastrow');
    let rowNext = rowLast + 1;
    let r = table.find('tr').filter(function() {
      return ($(this).data('date') == datetext);
    }).eq(0);
    // a little redundant checking both here 
    if (!!r.length && arr.includes(datetext)) {
      removeRow(datetext);
      r.remove();
    } else {
      // not found so add it
      let col = $('<td></td>').html(datetext);
      let row = $('<tr></tr>');
      row.data('date', datetext);
      row.attr('id', 'newrow' + rowNext);
      row.append(col).appendTo(table);
      table.data('lastrow', rowNext);
      arr.push(datetext);
    }
  }
});

$('#multiple-date-select2').multiDatesPicker({
  onSelect: function(datetext) {
    let table = $('#table-data');
    let rowLast = table.data('lastrow');
    let rowNext = rowLast + 1;
    let r = table.find('tr').filter(function() {
      return ($(this).data('date') == datetext);
    }).eq(0);
    // a little redundant checking both here 
    if (!!r.length && arr.includes(datetext)) {
      removeRow(datetext);
      r.remove();
    } else {
      // not found so add it
      let col = $('<td></td>').html(datetext);
      let row = $('<tr></tr>');
      row.data('date', datetext);
      row.attr('id', 'newrow' + rowNext);
      row.append(col).appendTo(table);
      table.data('lastrow', rowNext);
      arr.push(datetext);
    }
  }
});
// set start, first row will be 0 could be in markup
//$('#table-data').data('lastrow', -1);
</script>



@endsection