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
                <label>Customer name / Billing Name</label>
                <input class="form-control" type="input" name="name" required="" value="{{old('name')}}">
                 @error('name')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-4">
                <label>Brand</label>
                <input class="form-control" type="input" name="brand"  required=""value="{{old('brand')}}">
                 @error('brand')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

      </div>
    

       <div class="row div-margin">
           
           <div class="col-md-4">
                <label>Mobile Number</label>
                <input class="form-control" type="input" name="mobile" placeholder="Enter Mobile Number" required=""value="{{old('mobile')}}">
                 @error('mobile')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-4">
                <label>Email ID</label>
                <input class="form-control" type="input" name="email" placeholder="Enter Email ID" required="">
                
          </div>

       </div>

        <div class="row div-margin">
           
           <div class="col-md-4">
                <label>Telephone</label>
                <input class="form-control" type="input" name="tel">
                
          </div>

       </div>
         <div>
            <label class="label-bold div-margin">Address</label>
         </div>

        <table class="table table-responsive " id="dynamicAddRemove">
              
              <tr>
                  <td>
                    <!-- <input type="text" name="specifications[0][spec]" placeholder="Enter param Name" class="form-control" /> -->
                   <div class="row"> 
                     <div class="col-md-3">
                      <label>Area / Location</label>
                      <input class="form-control" type="text" name="address[0][area]">
                    </div>

                     <div class="col-md-3">
                      <label>City</label>
                      <input class="form-control" type="text" name="address[0][city]">
                    </div>

                     <div class="col-md-3">
                      <label>State</label>
                      <input class="form-control" type="text" name="address[0][state]">
                    </div>


                   </td> 

                 </tr>  

                    <div class="col-md-3">

                      <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add another </button>
                    </div>
                 
                
          </table>

       <button class="btn btn-primary div-margin" type="submit" value="submit">SUBMIT</button>

      </form>
    </div>
</div>

<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><div class="row"><div class="col-md-3"><label>Area / Location</label><input class="form-control" type="text" name="address[' + i + '][area]"></div><div class="col-md-3"><label>City</label><input class="form-control" type="text" name="address[' + i + '][city]"></div><div class="col-md-3"><label>State</label><input class="form-control" type="text" name="address[' + i + '][state]"></div></td></tr>');
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection