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

      <label class="label-bold div-margin">Contact Details</label>

       <div class="row div-margin">

           <div class="col-md-3">
                <label>Full Name *</label>
                <input class="form-control" type="input" name="full_name1" required placeholder="Enter Full Name" value="{{old('full_name1')}}">
                 @error('full_name1')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
                <label>Designation *</label>
                <input class="form-control" type="input" name="designation1" required placeholder="Enter Designation" value="{{old('designation1')}}">
                 @error('designation1')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>
           
           <div class="col-md-3">
                <label>Mobile Number *</label>
                <input class="form-control" type="input" name="mobile1" placeholder="Enter Mobile Number" required=""value="{{old('mobile1')}}"  onkeypress='validate(event)'>
                 @error('mobile1')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
                <label>Email ID *</label>
                <input class="form-control" type="input" name="email1" placeholder="Enter Emai ID" value="{{old('email1')}}" required>
                 @error('email1')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          
       </div>

       <!-- row 2 -->
       <div class="row div-margin">

           <div class="col-md-3">
               
                <input class="form-control" type="input" name="full_name2"  placeholder="Enter Full Name" value="{{old('full_name2')}}">
                 @error('full_name2')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
                
                <input class="form-control" type="input" name="designation2"  placeholder="Enter Designation" value="{{old('designation2')}}">
                 @error('designation2')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>
           
           <div class="col-md-3">
               
                <input class="form-control" type="input" name="mobile2" placeholder="Enter Mobile Number" value="{{old('mobile2')}}"  onkeypress='validate(event)'>
                 @error('mobile2')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
                
                <input class="form-control" type="input" name="email2" placeholder="Enter Emai ID" value="{{old('email2')}}" >
                 @error('email2')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          
       </div>

       <!-- row 3 -->

       <div class="row div-margin">

           <div class="col-md-3">
                
                <input class="form-control" type="input" name="full_name3"  placeholder="Enter Full Name" value="{{old('full_name3')}}">
                 @error('full_name3')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
                
                <input class="form-control" type="input" name="designation3"  placeholder="Enter Designation" value="{{old('designation3')}}">
                 @error('designation3')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>
           
           <div class="col-md-3">
                
                <input class="form-control" type="input" name="mobile3" placeholder="Enter Mobile Number" value="{{old('mobile3')}}"  onkeypress='validate(event)'>
                 @error('mobile3')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
                
                <input class="form-control" type="input" name="email3" placeholder="Enter Emai ID" value="{{old('email3')}}" >
                 @error('email3')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          
       </div>

       <!-- row 4 -->

       <div class="row div-margin">

           <div class="col-md-3">
               
                <input class="form-control" type="input" name="full_name4"  placeholder="Enter Full Name" value="{{old('full_name4')}}">
                 @error('full_name4')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
               
                <input class="form-control" type="input" name="designation4"  placeholder="Enter Designation" value="{{old('designation4')}}">
                 @error('designation4')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>
           
           <div class="col-md-3">
                
                <input class="form-control" type="input" name="mobile4" placeholder="Enter Mobile Number" value="{{old('mobile4')}}"  onkeypress='validate(event)'>
                 @error('mobile4')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
                
                <input class="form-control" type="input" name="email4" placeholder="Enter Emai ID" value="{{old('email4')}}" >
                 @error('email4')
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
                      <input class="form-control" type="text" name="address[0][gst]" required="required" minlength="15" maxlength="15">
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
         $("#dynamicAddRemove").append('<tr><td><div class="row align-items-end"><div class="col-md-3"><label>Brand name</label><input class="form-control" type="text" name="address[' + i + '][brand]"required=" required"></div><div class="col-md-2"><label>State</label><input class="form-control" type="text" name="address[' + i + '][state]" required="required"></div><div class="col-md-2"><label>GST No.</label><input class="form-control" type="text" name="address[' + i + '][gst]" required="required" minlength="15" maxlength="15"></div> <div class="col-md-1"><label></label><i id="btnn" data-id="00" class="fa fa-close remove-input-field" style="color:red;"></i></div></div></td></tr>');
        

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