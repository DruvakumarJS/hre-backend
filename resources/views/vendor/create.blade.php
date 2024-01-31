@extends('layouts.app')

@section('content')
<style type="text/css">
  thead th {
 
  height: 50px;
}
</style>

<div class="container">
    <div class="row justify-content-center">
      
      <div class="container-header">
         <div id="div1">
           <label>Add Vendor</label>
         </div>

         <div id="div2">
           <a class="btn btn-light btn-outline-secondary" href="{{route('vendor_master')}}">
             <label id="modal">View Vendors</label></a> 
         </div>
        @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
        @endif

    </div>
       

    </div>


    <div class="page-container">
    
    <label class="label-bold">Vendor Details</label>
    <form method="post" action="{{ route('save_vendor') }}">
      @csrf
      <div class="row">
        <div class="col-6">
          <div class="form-group row " style="margin-top: 10px">
            <label for="" class="col-3 col-form-label">VID *</label>

            <div class="col-6 ">
              <input  class="form-control" type="number" name="vid" required="required" placeholder="Enter VID " value="{{old('vid')}}">
            </div>
          </div>

          <div class="form-group row " style="margin-top: 10px">
            <label for="" class="col-3 col-form-label">Business Type *</label>
            <div class="col-6 ">
              <select class="form-control form-select" name="vendor_type" required>
                <option value="">Select</option>
                <option value="Sub_Contractor">Sub Contractor</option>
                <option value="Labour_Contractor">Labour Contractor</option>
                <option value="Service_Provider">Service Provider</option>
                <option value="material_supplier">Material Supplier</option>
               
              </select>
            </div>
          </div>

          <div class="form-group row " style="margin-top: 10px">
            <label for="" class="col-3 col-form-label">Billing Name * </label>
            <div class="col-6 ">
              <input  class="form-control" type="text" name="billing_name" required="required"   placeholder="Enter Billing Name " value="{{old('billing_name')}}">
            </div>
          </div>


        </div>

        <div class="col-6" >
          <div class="form-group row " style="margin-top: 10px">
            <label for="" class="col-2 col-form-label">GST NO *</label>
            <div class="col-6 ">
              <input  class="form-control" type="text" name="gst" required="required" minlength="15" maxlength="15"   placeholder="Enter GST " value="{{old('gst')}}">
            </div>
          </div>

          <div class="form-group row " style="margin-top: 10px">
            <label for="" class="col-2 col-form-label">PAN *</label>
            <div class="col-6 ">
              <input  class="form-control" type="text" name="pan" required="required" minlength="10" maxlength="10"  placeholder="Enter PAN  " value="{{old('pan')}}">
            </div>
          </div>

          <div class="form-group row " style="margin-top: 10px">
            <label for="" class="col-2 col-form-label">TIN *</label>
            <div class="col-6 ">
              <input  class="form-control" type="text" name="tin" required="required"   placeholder="Enter TIN " value="{{old('tin')}}">
            </div>
          </div>
          
        </div>
        
      </div>

      <div class="row div-margin">
        <div class="col-4">
          <div class="form-group row " style="margin-top: 10px">
            <label for="" class="col-4 col-form-label">Owner Name *</label>
            <div class="col-6 " style="margin-left: 20px" >
              <input class="form-control" type="text" name="owner_name" required="required"   placeholder="Enter Owner Name" value="{{old('owner_name')}}">
            </div>
          </div>
        </div>

        <div class="col-4">
          <div class="form-group row " style="margin-top: 10px">
            <label for="" class="col-3 col-form-label">Contact *</label>
            <div class="col-6 ">
              <input  class="form-control" type="text" name="owner_mobile" required="required" placeholder="Enter Contact No. " value="{{old('owner_mobile')}}" maxlength="10" minlength="10">
            </div>
          </div>
        </div>

        <div class="col-4">
          <div class="form-group row " style="margin-top: 10px">
            <label for="" class="col-3 col-form-label">Email *</label>
            <div class="col-6 ">
              <input  class="form-control" type="text" name="owner_email" required="required"  placeholder="Enter Email ID " value="{{old('owner_email')}}">
            </div>
          </div>
        </div>
        
      </div>

      <label class="label-bold" style="margin-top: 30px">Registered Billing Address</label>
    	
    	  <div class=" row div-margin">
           <div class="col-6">
            <div class="form-group row " style="margin-top: 10px">
              <label for="" class="col-3 col-form-label">Door No / Building *</label>
              <div class="col-6 ">
                <input  class="form-control" type="text" name="building" required="required"   placeholder="Enter Door No / Building " value="{{old('building')}}">
              </div>
            </div>

            <div class="form-group row " style="margin-top: 10px">
              <label for="" class="col-3 col-form-label">Street & Area *</label>
              <div class="col-6 ">
                <input  class="form-control" type="text" name="area" required="required" placeholder="Enter Street & Area " value="{{old('area')}}">
              </div>
            </div>

            <div class="form-group row " style="margin-top: 10px">
              <label for="" class="col-3 col-form-label">Nearby Location </label>
              <div class="col-6 ">
                <input  class="form-control" type="text" name="location" required="required"   placeholder="Enter Nearby Location " value="{{old('location')}}">
              </div>
            </div>

            <div class="form-group row " style="margin-top: 10px">
              <label for="" class="col-3 col-form-label">City *</label>
              <div class="col-6 ">
                <input  class="form-control" type="text" name="city" required="required"  placeholder="Enter City " value="{{old('city')}}">
              </div>
            </div>

            <div class="form-group row " style="margin-top: 10px">
              <label for="" class="col-3 col-form-label">State *</label>
              <div class="col-6 ">
                <input  class="form-control" type="text" name="state" required="required"   placeholder="Enter State " value="{{old('state')}}">
              </div>
            </div>

            <div class="form-group row " style="margin-top: 10px">
              <label for="" class="col-3 col-form-label">Postal Code * </label>
              <div class="col-6 ">
                <input  class="form-control" type="text" name="pincode" required="required" placeholder="Enter PINCODE " value="{{old('pincode')}}">
              </div>
            </div>

           </div>

        </div>

        <label class="label-bold" style="margin-top: 30px">Vendor's Staff Contact Details</label>

        <div>
              
               <table class="table table-responsive " id="dynamicclient">
              
              <tr>
                  <td>
                   
                   <div class="row align-items-end"> 
                     
                     <div class="col-md-3">
                      <label class="label-bold">Name</label>
                      <input class="form-control" type="text" name="client[0][name]" required="required" placeholder="Enter Name" >
                    </div>

                     <div class="col-md-3">
                      <label class="label-bold">Designation</label>
                      <input class="form-control" type="text" name="client[0][designation]" required="required"
                      placeholder="Enter Designation">
                    </div>

                    <div class="col-md-3">
                      <label class="label-bold">Contact No.</label>
                      <input class="form-control" type="text" name="client[0][contact]" required="required" minlength="10" maxlength="10" placeholder="Enter Contact No." >
                    </div>
                    <div class="col-md-3">
                      <label class="label-bold">Email ID</label>
                      <input class="form-control" type="text" name="client[0][email]" required="required" placeholder="Enter Email ID" >
                    </div>

                   </div>

                   </td> 

                 </tr>  

          </table>
            </div>
           <div id="div2">
             <i class="fa fa-plus" id="dynamic-client"></i>
           </div>

           <div class="div-margin">
              <button class="btn btn-success" type="submit">Submit</button>
           </div>
        </form>
    </div>
  </div>
</div>

<script type="text/javascript">
    var i = 0;
    var j = 'n';
    $("#dynamic-client").click(function () {
        ++i;
         $("#dynamicclient").append('<tr><td><div class="row align-items-end"><div class="col-md-3"><input class="form-control" type="text" name="client['+ i +'][name]"required=" required" placeholder="Enter Name"></div><div class="col-md-3"><input class="form-control" type="text" name="client['+ i +'][designation]" required="required" placeholder="Enter Designation"></div> <div class="col-md-3"><input class="form-control" type="text" name="client['+ i +'][contact]" required="required" minlength="10" maxlength="10" placeholder="Enter Contact No."></div><div class="col-md-3"><input class="form-control" type="text" name="client['+ i +'][email]" required="required" placeholder="Enter Email ID"></div> </div></td></tr>');
        

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

@endsection