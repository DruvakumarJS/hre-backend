@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
          <div id="div1"> 
            <label style="font-size: 25px;font-weight: bolder;">PCN Registration Form / Project Histogram</label>
          </div>
          
           
        </div>     
       
        <div class="page-container">
          
          <div class="row">
            <div class="col-md-6">
              <div class="card" style="background-color: #a4fba6">
                <div class="card-body" style="padding: 0px" >
                  <h5 class="card-header " style="font-weight: bold;background-color: #4ae54a;">CLIENT / PROJECT  DETAILS</h5>
                    
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
                        <input  class="form-control" type="text" name="gst" required="required" value=""  placeholder="GST Number">
                      </div>
                    </div>

                     <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Project Name</label>
                      <div class="col-9"  >
                        <input  class="form-control" type="text" name="pcn" required="required" value=""  placeholder="Project Name" readonly>
                      </div>
                  </div>

                   
                  
                </div>
              </div>
              
            </div>

            <div class="col-md-6">
              <div class="card"style="background-color: #a4fba6" >
                <div class="card-body" style="padding: 0px">
                  <h5 class="card-header " style="font-weight: bold; background-color: #4ae54a;">PROJECT ADDRESS</h5>
                 

                  <div class="form-group row" >
                      <label for="" class="col-3 col-form-label">Site Full Address </label>
                      <div class="col-9 " >
                        <div class="form-group row">
                           

                            <div style="margin-top: 10px">
                              <input  class="form-control" type="text" name="location" required="required" value=""  placeholder="Location">
                            </div>

                            <div style="margin-top: 10px">
                              <input  class="form-control" type="text" name="area" required="required" value=""  placeholder="Area / Building">
                            </div>
                            <div style="margin-top: 10px" >
                              <input  class="form-control" type="text" name="city" required="required" value=""  placeholder="City and State name">
                            </div>
                            <div id="div2" style="margin-top: 10px">
                              <input  class="form-control" type="text" name="pincode" required="required" value=""  placeholder="PINCODE">
                            </div>
                        </div>
                        
                      </div>
                    </div>
                  
                </div>
              </div>
              
            </div>

            
        </div> 

        <!-- row2 -->

        <div class="row" style="background-color: #f1c232">
          <div class="col-md-4">
            
              <div class="form-group row" style="padding: 5px">
                <label for="" class="col-3 col-form-label label-bold">PO DATE </label>
                <div class="col-9 " >
                  <input  class="form-control" type="text" name="po_date" required="required" value=""  placeholder="PO Date">
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

        <!-- row 3 -->

        <div class="card"  style="padding: 0px">
          <div class="card-body" >
            <h5 class="card-header" style="font-weight: bolder;">Project Contact Details</h5>
            
          </div>
          
        </div>

    </div>
  
</div>


@endsection