@extends('layouts.app')

@section('content')
<style type="text/css">
    img[src=""] {
    display: none;
}
</style>

<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">Create Petty Cash</label>
           <div id="div2">
            <a class="btn btn-light btn-outline-secondary" href="{{route('pettycash')}}">
             <label id="modal">View PettyCash List</label> </a>
          
          </div>

     </div>

     <div class="form-build">
     	<div class="row">
     			<div class="col-6">
     				<form method="post" action="{{route('save_petty_cash')}}" enctype="multipart/form-data">
     					@csrf
     					<div class="form-group row">
                            <label for="" class="col-5 col-form-label">Employee Name*</label>
                            <div class="col-7">
                                <input name="user_name" id="user_name" type="text" class="typeahead form-control" required="required" placeholder="Search by name" >
                            </div>
                        </div>

                        <input type="hidden" name="user_id" id="user_id" >

                        <div class="form-group row" style="display: none" >
                            <label for="" class="col-5 col-form-label">Role* </label>
                            <div class="col-7">
                                <input name="role" id="role" type="text" class="typeahead form-control" required="required" readonly placeholder="Role">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Amount (in rupees)*</label>
                            <div class="col-7">
                                <input name="amount" id="amount" type="text" class="form-control" required="required" placeholder="Enter Amount">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Comments </label>
                            <div class="col-7">
                                <input name="comment" id="comment" type="text" class="form-control" required="required" placeholder="Enter comments">
                            </div>
                        </div>


                        <input type="hidden" name="finance_id" value="{{Auth::user()->id}}">

                         <div class="form-group row">
                            <div class="offset-5 col-7">
                                <button  type="submit" class="btn btn-danger">Submit</button>
                                
                            </div>
                        </div>

                    	
     				</form>
     				
     			</div>

                <div class="col-6">
                     <img class="imagen" id="blah" src="" alt="ticketimage" style="width: 200px;height: 200px" />

                </div>
     		
     		
     	</div>
     	
     </div>

    </div>
</div>

<script type="text/javascript">

$( document ).ready(function() {
  var path = "{{ route('autocomplete_employee') }}";
   let text = "";
    $( "#user_name" ).autocomplete({
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
           
            $('#user_id').val(ui.item.id);
           
         if(ui.item.role_id == '1')
         {
             $('#role').val('Super Admin');
         }
          
         else if(ui.item.role_id == '2') 
            {
                $('#role').val('Manager');
            }
         else if(ui.item.role_id == '3') 
            {
                $('#role').val('Procurement');
            }
         else if(ui.item.role_id == '4') 
            {
                $('#role').val('Supervisor');
            }
        else if(ui.item.role_id == '5') 
            {
                $('#role').val('Finance');
            }      
          
        }
      });

    
});

</script>



@endsection