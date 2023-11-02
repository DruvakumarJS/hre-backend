@extends('layouts.app')

@section('content')


<div class="container">
    <div class="container-header">
            <label class="label-bold" id="div1">Edit Customer</label>
         <div id="div2">
           <a class="btn btn-light btn-outline-secondary" href="{{route('view_customers')}}">
             <label id="modal"> View All Customers</label></a>
              
         </div>

          @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
        @endif 

    </div>

    <div class="page-container">
      <form method="post" action="{{route('update_customer')}}">
        @csrf
        <input type="hidden" value="{{$customer->id}}" name="id">
       <div class="row">
           
           <div class="col-md-4">
                <label>Billing Name</label>
                <input class="form-control" type="input" name="name" required="" value="{{$customer->name}}">
                 
          </div>

      </div>



        <div class="row div-margin">

           <div class="col-md-3">
                <label>Full Name *</label>
                <input class="form-control" type="input" name="full_name1" required placeholder="Enter Full Name" value="{{$customer->full_name}}">
                 @error('full_name1')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
                <label>Designation *</label>
                <input class="form-control" type="input" name="designation1" required placeholder="Enter Designation" value="{{$customer->designation}}">
                 @error('designation1')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>
           
           <div class="col-md-3">
                <label>Mobile Number *</label>
                <input class="form-control" type="input" name="mobile1" placeholder="Enter Mobile Number" required=""value="{{$customer->mobile}}"  onkeypress='validate(event)'>
                 @error('mobile1')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
                <label>Email ID *</label>
                <input class="form-control" type="input" name="email1" placeholder="Enter Emai ID" value="{{$customer->email}}" required>
                 @error('email1')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          
       </div>

       <!-- row 2 -->
       <div class="row div-margin">

           <div class="col-md-3">
               
                <input class="form-control" type="input" name="full_name2"  placeholder="Enter Full Name" value="{{$customer->full_name1}}">
                 @error('full_name2')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
                
                <input class="form-control" type="input" name="designation2"  placeholder="Enter Designation" value="{{$customer->designation1}}" >
                 @error('designation2')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>
           
           <div class="col-md-3">
               
                <input class="form-control" type="input" name="mobile2" placeholder="Enter Mobile Number" value="{{$customer->mobile1}}"  onkeypress='validate(event)'>
                 @error('mobile2')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
                
                <input class="form-control" type="input" name="email2" placeholder="Enter Emai ID" value="{{$customer->email1}}" >
                 @error('email2')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          
       </div>

       <!-- row 3 -->

       <div class="row div-margin">

           <div class="col-md-3">
                
                <input class="form-control" type="input" name="full_name3"  placeholder="Enter Full Name" value="{{$customer->full_name2}}" >
                 @error('full_name3')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
                
                <input class="form-control" type="input" name="designation3"  placeholder="Enter Designation" value="{{$customer->designation2}}" >
                 @error('designation3')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>
           
           <div class="col-md-3">
                
                <input class="form-control" type="input" name="mobile3" placeholder="Enter Mobile Number" value="{{$customer->mobile2}}"  onkeypress='validate(event)'>
                 @error('mobile3')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
                
                <input class="form-control" type="input" name="email3" placeholder="Enter Emai ID" value="{{$customer->email2}}" >
                 @error('email3')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          
       </div>

       <!-- row 4 -->

       <div class="row div-margin">

           <div class="col-md-3">
               
                <input class="form-control" type="input" name="full_name4"  placeholder="Enter Full Name" value="{{$customer->full_name3}}">
                 @error('full_name4')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
               
                <input class="form-control" type="input" name="designation4"  placeholder="Enter Designation" value="{{$customer->designation3}}" >
                 @error('designation4')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>
           
           <div class="col-md-3">
                
                <input class="form-control" type="input" name="mobile4" placeholder="Enter Mobile Number" value="{{$customer->mobile3}}"  onkeypress='validate(event)'>
                 @error('mobile4')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          <div class="col-md-3">
                
                <input class="form-control" type="input" name="email4" placeholder="Enter Emai ID" value="{{$customer->email3}}" >
                 @error('email4')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

          
       </div>

         <div>
            <label class="label-bold div-margin">Address</label>
         </div>

        
        

          <table class="table table-responsive " id="dynamicAddRemove">
                  @php
                   $information = json_decode($customer->address , true);                    
                  @endphp 

               <input type="hidden" name="length" id="length" value="{{count($information)}}">
             @foreach($customer->address as $key =>$value)  
              <tr >
                 
                  <td>

                   <div class="row align-items-end"> 

                     <div class="col-md-2">
                      <label>Brand</label>
                      <input class="form-control" type="text" name="address[{{$key}}][brand]" value="{{$value->brand}}" required="required">
                    </div>


                     <div class="col-md-2">
                      <label>State</label>
                      <input class="form-control" type="text" name="address[{{$key}}][state]" value="{{$value->state}}" required="required">
                    </div>

                    <div class="col-md-2">
                      <label>GST No.</label>
                      <input class="form-control" type="text" name="address[{{$key}}][gst]" value="{{$value->gst}}" required="required" minlength="15" maxlength="15">
                    </div>
                    <input type="hidden" name="address[{{$key}}][id]" value="{{$value->id}}">
                   
                      <div class="col-md-1">
                      <label></label>
                      @php
                      if(isset($value->id)){
                       $addres_id = $value->id;
                      }
                      else {
                      $addres_id = "00";
                    }

                      @endphp
                      
                      <i id="btnn" data-id="{{$addres_id}}" class="fa fa-close remove-input-field" style="color: red"></i>

                    </div>
                   </div>  

                   </td> 

                 </tr>               
              @endforeach   
          </table>

        <div class="row">

        <div class="col-md-2">
           <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-danger div-margin">Add Location </button>
          
        </div>

        <div class="col-md-2">
          <button class="btn btn-danger div-margin" type="submit" value="submit">SUBMIT</button>
      
        </div>
         

      </div>  

      </form>
    </div>
</div>

<script type="text/javascript">
    var i = $("#length").val();
    var j = 'n';
    
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><div class="row align-items-end"><div class="col-md-2"><label>Brand</label><input class="form-control" type="text" name="address[' + i + '][brand]" required="required"></div><div class="col-md-2"><label>State</label><input class="form-control" type="text" name="address[' + i + '][state]" required="required"></div><div class="col-md-2"><label>GST No.</label><input class="form-control" type="text" name="address[' + i + '][gst]" required="required" minlength="15" maxlength="15"></div> <div class="col-md-1"><label></label>  <i id="btnn" data-id="00" class="fa fa-close remove-input-field" style="color: red"></i> </div></td></tr>');

    });

   /* $(document).on('click', '.remove-input-field', function () {  
    
      if (i==1){
       
        alert('There must be atleast one address');
      }
      else
       {
        $(this).parents('tr').remove();
         --i;
      }

    });*/

     
    $(document).on('click', '.remove-input-field', function () {
       // var id = $(this).closest("tr").find(".nr").text();
       var idd = $(this).data('id');  
          

       var del=confirm("Are you sure to delete ? ");

       if(idd == "00"){
       
        if (del==true && i>1){
           $(this).parents('tr').remove();
           --i;
        }
        else {
           alert('There must be atleast one address');
        }

       }
       else{

         if (del==true){
          
              if (i==1){
       
                alert('There must be atleast one address');
              }
              else
               {

             $(this).parents('tr').addClass('delRow');
             $.ajax({
            url: "{{ route('delete_address') }}",
            type: 'POST',
            dataType: "json",
            data: {id:idd},
             headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function( data ) {
              console.log(data);
              if(data.status == 1){

                $('.delRow').remove();
                 --i;
              }
            },
            error: function (xhr, textStatus, errorThrown) {
                        alert('fail=='+errorThrown);
                     }
          });
         
              
          }  

        }

       }  
     
    });

   


</script>
@endsection