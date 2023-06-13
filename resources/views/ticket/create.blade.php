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
            <label class="label-bold" id="div1">Generate Tickets</label>
           <div id="div2">
            <a class="btn btn-light btn-outline-secondary" href="{{route('tickets')}}">
             <label id="modal">View Tickets </label> </a>
          
          </div>

     </div>

     <div class="form-build">
     	<div class="row">
     			<div class="col-6">
     				<form method="post" action="{{route('save-ticket')}}" enctype="multipart/form-data">
     					@csrf
     					<div class="form-group row">
                            <label for="" class="col-5 col-form-label">Project Code Number*</label>
                            <div class="col-7">
                                <input name="pcn" id="pcn" type="text" class="typeahead form-control" required="required" placeholder="Enter PCN">
                                 <span class="label-bold" id="pcn_detail"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Department*</label>
                            <div class="col-7">
                                <select class="form-control" name="category"required="required">
                                    <option value="">Select Department</option>
                                    @foreach($category as $key=>$value)
                                    <option value="{{$value->category}}">{{$value->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Subject *</label>
                            <div class="col-7">
                                <input name="subject" id="subject" type="text" class="typeahead form-control" placeholder="Enter Subject for Conversation" value="{{old('subject')}}" required="required">
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Ticket Description *</label>
                            <div class="col-7">
                                <textarea  name="issue" id="issue" type="text" class="form-control" required="required" placeholder="Enter Ticket details here" >{{old('issue')}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Priority*</label>
                            <div class="col-7">
                               
                                <select class="form-control" name="priority" id='priority' required="required" >
                                   <option value="">Select Priority</option>
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                    
                                </select>
                               
                            </div>
   
                        </div>

                       
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Attach image </label>
                            <div class="col-7">
                                <input type="file" class="form-control form-control-sm" name="image" id="imgInp" accept="image/*">
                
                            </div>
                        </div>


                        <input type="hidden" name="owner" value="{{Auth::user()->id}}">

                         <div class="form-group row">
                            <div class="offset-5 col-7">
                                <button name="submit" type="submit" class="btn btn-danger">Generate Ticket</button>
                                
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
  var path = "{{ route('autocomplete_pcn') }}";
   let text = "";
    $( "#pcn" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
               response( data );
              
            }
          });
        },
        select: function (event, ui) {
           $('#pcn').val(ui.item.label);
           var address = ui.item.client_name +' , '+  ui.item.area  +' , '+  ui.item.city +' , '+ ui.item.state;
         
           document.getElementById("pcn_detail").innerHTML=address;
        
        }
      });
 
});

</script>

<script type="text/javascript">
    imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
    $(".imagen").show();
  }
}
</script>


@endsection