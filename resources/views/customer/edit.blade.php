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

          <div class="col-md-4">
                <label>Brand</label>
                <input class="form-control" type="input" name="brand"  required=""value="{{$customer->brand}}">
                 @error('brand')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
             @enderror
                
          </div>

      </div>
    

       <div class="row div-margin">
           
           <div class="col-md-4">
                <label>Mobile Number</label>
                <input class="form-control" type="input" name="mobile" placeholder="Enter Mobile Number" required=""value="{{$customer->mobile}}">
                
                
          </div>

          <div class="col-md-4">
                <label>Email ID</label>
                <input class="form-control" type="input" name="email" placeholder="Enter Email ID" required="" value="{{$customer->email}}">
                
          </div>

       </div>

        <div class="row div-margin">
           
           <div class="col-md-4">
                <label>Telephone</label>
                <input class="form-control" type="input" name="tel" value="{{$customer->telephone}}">
                
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
                      <label>Area / Location</label>
                      <input class="form-control" type="text" name="address[{{$key}}][area]" value="{{$value->area}}" required="required">
                    </div>

                     <div class="col-md-2">
                      <label>City</label>
                      <input class="form-control" type="text" name="address[{{$key}}][city]" value="{{$value->city}}" required="required">
                    </div>

                     <div class="col-md-2">
                      <label>State</label>
                      <input class="form-control" type="text" name="address[{{$key}}][state]" value="{{$value->state}}" required="required">
                    </div>

                    <div class="col-md-2">
                      <label>GST No.</label>
                      <input class="form-control" type="text" name="address[{{$key}}][gst]" value="{{$value->gst}}" required="required">
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
           <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary div-margin">Add Location </button>
          
        </div>

        <div class="col-md-2">
          <button class="btn btn-primary div-margin" type="submit" value="submit">SUBMIT</button>
      
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
        $("#dynamicAddRemove").append('<tr><td><div class="row align-items-end"><div class="col-md-2"><label>Area / Location</label><input class="form-control" type="text" name="address[' + i + '][area]" required="required"></div><div class="col-md-2"><label>City</label><input class="form-control" type="text" name="address[' + i + '][city]" required="required"></div><div class="col-md-2"><label>State</label><input class="form-control" type="text" name="address[' + i + '][state]" required="required"></div><div class="col-md-2"><label>GST no.</label><input class="form-control" type="text" name="address[' + i + '][gst]" required="required"></div> <div class="col-md-1"><label></label>  <i id="btnn" data-id="00" class="fa fa-close remove-input-field" style="color: red"></i> </div></td></tr>');

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