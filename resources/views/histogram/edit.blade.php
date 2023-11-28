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
              <div class="card" >
                <div class="card-body" style="padding: 0px">
                  <h5 class="card-header " style="font-weight: bolder;">CLIENT / PROJECT DETAILS</h5>
                    
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

                    <div class="form-group row" style="margin-top: 10px">
                      <label for="" class="col-3 col-form-label">Project Name & <?php echo "<br>"; ?> Site Full Address </label>
                      <div class="col-9 " >
                        <div class="form-group row">
                            <div >
                              <input  class="form-control" type="text" name="location" required="required" value=""  placeholder="Project Name">
                            </div>

                            <div  >
                              <input  class="form-control" type="text" name="location" required="required" value=""  placeholder="Location">
                            </div>

                            <div >
                              <input  class="form-control" type="text" name="area" required="required" value=""  placeholder="Area / Building">
                            </div>
                            <div  >
                              <input  class="form-control" type="text" name="city" required="required" value=""  placeholder="City and State name">
                            </div>
                            <div id="div2">
                              <input  class="form-control" type="text" name="pincode" required="required" value=""  placeholder="PINCODE">
                            </div>
                        </div>
                        
                      </div>
                    </div>
                  
                </div>
              </div>
              
            </div>

            <div class="col-md-3">
              <div class="card" >
                <div class="card-body" style="padding: 0px">
                  <h5 class="card-header " style="font-weight: bolder;">PROJECT TARGET DAYS</h5>
                  <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-4 col-form-label">Targeted Start Date </label>
                      <div class="col-8"  >
                        <input  class="form-control" type="date" name="pcn" required="required" value=""  placeholder="Start date" readonly>
                      </div>
                  </div>

                  <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-4 col-form-label">Targeted End Date </label>
                      <div class="col-8"  >
                        <input  class="form-control" type="date" name="t_e_date" required="required" value=""  placeholder="End date" readonly>
                      </div>
                  </div>

                  <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-4 col-form-label">Approved Holidays </label>
                      <div class="col-8"  >
                        <input  class="form-control" type="number" name="approved_holidays" required="required" value=""  placeholder="Approved holidays" readonly>
                      </div>
                  </div>

                  <div class="form-group row " style="margin-top: 10px">
                      <div class="col-12"  >
                        <input  class="form-control" type="text" name="approved_holiday_dates" required="required" value=""  placeholder="Approved holiday dates" readonly>
                      </div>
                  </div>
                  
                </div>
              </div>
              
            </div>

            <div class="col-md-3">
              <div class="card" >
                <div class="card-body" style="padding: 0px">
                  <h5 class="card-header " style="font-weight: bolder;">ACTUAL PROJECT DAYS</h5>
                  <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-4 col-form-label">Actual Start Date </label>
                      <div class="col-8"  >
                        <input  class="form-control" type="date" name="a_s_date" required="required" value=""  placeholder="start date" readonly>
                      </div>
                  </div>

                  <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-4 col-form-label">Actual End Date </label>
                      <div class="col-8"  >
                        <input  class="form-control" type="date" name="a_e_date" required="required" value=""  placeholder="End date" readonly>
                      </div>
                  </div>

                  <div class="form-group row " style="margin-top: 10px">
                      <label for="" class="col-4 col-form-label">Holidays & Hold Days</label>
                      <div class="col-8"  >
                        <input  class="form-control" type="text" name="h_h_days" required="required" value=""  placeholder="Holiday & hold days" readonly>
                      </div>
                  </div>

                  <div class="form-group row " style="margin-top: 10px">
                      <div class="col-12"  >
                        <input  class="form-control" type="text" name="hold_holiday_dates" required="required" value=""  placeholder="Project Hold &  holiday dates" readonly>
                      </div>
                  </div>
                  
                </div>
              </div>
              
            </div>
            
          </div>
        </div> 

    </div>
  
</div>


@endsection