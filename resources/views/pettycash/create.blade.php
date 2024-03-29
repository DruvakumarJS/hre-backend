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
            <label class="label-bold" id="div1">Issue PettyCash</label>
           <div id="div2">
            <a class="btn btn-light btn-outline-secondary" href="{{route('pettycash')}}">
             <label id="modal">View PettyCash List</label> </a>
          
          </div>

          @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
          @endif       
       

     </div>

     <div class="form-build">
     	<div class="row">
     			<div class="col-6">
     				<form method="post" action="{{route('save_petty_cash')}}" enctype="multipart/form-data">
     					@csrf
     					<div class="form-group row">
                            <label for="" class="col-5 col-form-label">Employee Name*</label>
                            <div class="col-7">
                                <input name="user_name" id="user_name" type="text" class="typeahead form-control" required="required" placeholder="Search by Name / ID" >
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
                            <label for="" class="col-5 col-form-label">Issued Amount (in rupees)*</label>
                            <div class="col-7">
                                <input name="amount" id="amount" type="Number" class="form-control" required="required" placeholder="Enter Amount" min="1">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Issued date*</label>
                            <div class="col-7">
                                <input name="issued_date" type="date" class="form-control" required="required" max="{{date('Y-m-d')}}">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Description* </label>
                            <div class="col-7">
                                <input name="comment" id="comment" type="text" class="form-control" required="required" placeholder="Enter Description">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Mode of Payment* </label>
                            <div class="col-7">
                               <select class="form-control form-select"name='mode' id='mode' required="required">
                                   <option value="">Select Mode</option>
                                   <option value="Cash">Cash</option>
                                   <option value="Online">Online</option>
                               </select>
                            </div>
                        </div>

                        <div class="form-group row" >
                            <label id="ref_lable" class="col-5 col-form-label" style="display: none">Reference Number* </label>
                            <div class="col-7">
                                <input name="refernce" id="refernce" type="text" class="form-control" required="required" placeholder="Enter Reference Number" id="refernce" style="display: none">
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


     var mode = document.getElementById("mode").value;

     $('select').on('change', function() {

         if(this.value == "Online"){
            document.getElementById("refernce").style.display= "block" ;
            document.getElementById("ref_lable").style.display= "block" ;
            document.getElementById("refernce").required = true;

         }
         else {
            document.getElementById("refernce").style.display= "none" ;
            document.getElementById("ref_lable").style.display= "none" ;
            document.getElementById("refernce").required = false;
         }
   
     });

     
    
});

</script>



@endsection