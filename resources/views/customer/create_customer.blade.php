@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-header">
            <label class="label-bold" id="div1">Add New Customer</label>
         <div id="div2">
           <a class="btn btn-light" href="{{route('view_customers')}}">
             <label id="modal"> View All Customers</label></a>
              
         </div>

    </div>

    <div class="page-container">
      <form method="post" action="{{route('save_customer')}}">
        @csrf
       <div class="row">
           
           <div class="col-md-4">
                <label>Billing Name *</label>
                <input class="form-control" type="input" name="name" required="" placeholder="Enter Billing Name" value="{{old('name')}}">
                 @error('name')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

        

      </div>
    

       <div class="row div-margin">
           
           <div class="col-md-3">
                <label>Mobile Number *</label>
                <input class="form-control" type="input" name="mobile" placeholder="Enter Mobile Number" required=""value="{{old('mobile')}}"  onkeypress='validate(event)'>
                 @error('mobile')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
                <label>Mobile Number 1 </label>
                <input class="form-control" type="input" name="mobile1" placeholder="Enter Mobile Number (optional)" value="{{old('mobile1')}}" onkeypress='validate(event)'>
                 @error('mobile')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

           <div class="col-md-3">
                <label>Mobile Number 2 </label>
                <input class="form-control" type="input" name="mobile2" placeholder="Enter Mobile Number (optional)" value="{{old('mobile3')}}"  onkeypress='validate(event)'>
                 @error('mobile')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

           <div class="col-md-3">
                <label>Mobile Number 3 </label>
                <input class="form-control" type="input" name="mobile3" placeholder="Enter Mobile Number (optional)" value="{{old('mobile3')}}"  onkeypress='validate(event)'>
                 @error('mobile')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

                
          

       </div>

        <div class="row div-margin">

           <div class="col-md-3">
                <label>Email ID *</label>
                <input class="form-control" type="input" name="email" placeholder="Enter Email ID" required=""value="{{old('email')}}">
                 @error('email')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
               
          </div>

          <div class="col-md-3">
                <label>Email ID 1</label>
                <input class="form-control" type="input" name="email1" placeholder="Enter Email ID (optional)" value="{{old('email1')}}">
                 @error('email')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
               
          </div>

          <div class="col-md-3">
                <label>Email ID 2 </label>
                <input class="form-control" type="input" name="email2" placeholder="Enter Email ID (optional)" value="{{old('email2')}}">
                 @error('email')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
               
          </div>

          <div class="col-md-3">
                <label>Email ID 3 </label>
                <input class="form-control" type="input" name="email3" placeholder="Enter Email ID (optional)" value="{{old('email3')}}">
                 @error('email')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
               
          </div>
           
          

       </div>

         <div>
            <label class="label-bold div-margin">Address</label>
         </div>

        <table class="table table-responsive " id="dynamicAddRemove">
              
              <tr>
                  <td>
                    <!-- <input type="text" name="specifications[0][spec]" placeholder="Enter param Name" class="form-control" /> -->
                   <div class="row align-items-end"> 
                     
                     <div class="col-md-3">
                      <label>Brand Name *</label>
                      <input class="form-control" type="text" name="address[0][brand]" required="required">
                    </div>

                     <div class="col-md-2">
                      <label>State *</label>
                      <input class="form-control" type="text" name="address[0][state]" required="required">
                    </div>

                    <div class="col-md-2">
                      <label>GST No. *</label>
                      <input class="form-control" type="text" name="address[0][gst]" required="required">
                    </div>

                    <div class="col-md-1">
                      <label></label>
                      <!-- <button type="button" id="btnn" data-id="00"  class="form-control btn btn-outline-danger remove-input-mandate" style="display: none;">Delete</button>  --> 
                      <i id="btnn" data-id="00" class="fa fa-close remove-input-mandate" style="color:red;display: none;"></i>
                    </div>

                   
                   </div>

                   </td> 

                 </tr>  

                    <div class="col-md-3">

                     
                    </div>
                 
                
          </table>
     

       <div class="row">
          <div class="col-7">
             <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-success div-margin">Add Location </button>
              <button class="btn btn-danger div-margin" type="submit" value="submit">SUBMIT</button>
             
          </div>
      </div> 

       

      </form>
    </div>
</div>

<script type="text/javascript">
    var i = 0;
    var j = 'n';
    $("#dynamic-ar").click(function () {
        ++i;
         $("#dynamicAddRemove").append('<tr><td><div class="row align-items-end"><div class="col-md-3"><label>Brand name</label><input class="form-control" type="text" name="address[' + i + '][brand]"required=" required"></div><div class="col-md-2"><label>State</label><input class="form-control" type="text" name="address[' + i + '][state]" required="required"></div><div class="col-md-2"><label>GST No.</label><input class="form-control" type="text" name="address[' + i + '][gst]" required="required"></div> <div class="col-md-1"><label></label><i id="btnn" data-id="00" class="fa fa-close remove-input-field" style="color:red;"></i></div></div></td></tr>');
        

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
      
  function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
    </script>
@endsection