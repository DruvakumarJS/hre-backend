@extends('layouts.app')

@section('content')

@php
  $can_reply="false";
@endphp
<div class="container">
    <div class="row justify-content-center">
	 <div class="container-header">
            
          <div id="div2">
            <a class="btn btn-light btn-outline-secondary" href="{{route('tickets')}}">
             <label id="modal">View Tickets</label> </a>
          </div>

          @if($pcn_data->status == 'Completed')
            <label style="color: red">{{$pcn_data->pcn}} is completed and you cannot communicate to this ticket</label>
          @endif
          
           @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
           @endif 
         
          <div id="div2" style="margin-right: 30px">
           
          </div>       
     </div>

     <div>
     	
        <div class="row justify-content-center">

          <div class="col-sm-6 col-md-6 ">
            <div class="card">
              <div>
              <label>Ticket No : </label> <label class="label-bold">{{$id}}</label>
            </div>

             <div>
              <label>Ticket Creator : </label> <label class="label-bold">{{$ticket->user->name}} - {{$ticket->user->roles->alias}}</label>
            </div>

             <div>
              <label>Ticket Assigned to : </label> <label class="label-bold">{{$ticket->employee->name}} - {{$ticket->employee->roles->alias}}</label>
            </div>
              
            </div>
            
            
            
          </div>

          <div class="col-sm-6 col-md-6 ">
            <div class="card">
            <div>
              <label>PCN : </label> <label class="label-bold">{{$pcn_data->pcn}}</label>
            </div>

             <div>
            
              <label class="label-bold">{{$pcn_data->client_name}},{{$pcn_data->brand}}<?php echo '<br>' ;?> {{$pcn_data->location}} , {{$pcn_data->area}},{{$pcn_data->city}},{{$pcn_data->state}}</label>
            </div>
            </div>
            
            
          </div>
          
        </div>

     		<!-- <div class="row">
     			<div class="col-md-2">
     				<div class="row">
     					<label>Ticket No</label>
     				   <h4>{{$id}}</h4>
     				</div>
     				
     			</div>

     			<div class="col-md-2">
     				<div class="row">
     					<label>PCN</label>
     				   <h4>{{$ticket->pcn}}</h4>
     				</div>
     				
     			</div>


     			<div class="col-md-4">
     				<div class="row">
     					<label>Ticket Creator</label>
             
                <h4>{{$ticket->user->name}} - {{$ticket->user->roles->alias}}</h4>
                
                            
     				    
     				</div>
     				
     			</div>

     			<div class="col-md-3">
     				<div class="row">
     					<label>Created Date</label>
     				    <h4>{{$ticket->created_at}}</h4>
     				</div>
     				
     			</div>

     			
     		</div> -->

     

     </div>
     
     <div>
      <div>
        <label >CATEGORY : </label> <label class="label-bold">{{$ticket->category}}</label>
      </div>

       <div>
        <label style="max-width: 700px;">DESCRIPTION : </label> <label class="label-bold">{{$ticket->issue}}</label>
      </div>
    

       @foreach($conversation as $key => $value)

                   @php
                    if(($value->sender == Auth::user()->id) or ($value->recipient == Auth::user()->id)) 
                    {
                      $can_reply = 'True';
                    }

                   @endphp

        @endforeach

        @if($pcn_data->status == 'Active')

        @if($ticket->status != 'Resolved')
        @if($can_reply == "True" or Auth::user()->role_id == 1 or Auth::user()->role_id == 2 or Auth::user()->role_id == 3 or Auth::user()->role_id == 4 or  Auth::user()->role_id == 5 or Auth::user()->id == $ticket->creator)
     	 <div id="div2" style="display: block">
           <a data-bs-toggle="modal" data-bs-target="#replyModal"  class="btn btn-light btn-outline-secondary" href=""><i class="fa fa-plus"></i> 
             <label id="modal">Reply</label>
           </a>
      </div>
      @endif

      @if(Auth::user()->team_id == 1 or Auth::user()->roles->team_id == 2 or Auth::user()->roles->team_id == 3 or Auth::user()->roles->team_id == 4 or Auth::user()->roles->team_id == 5)
       <div id="div2" style="display: block ; margin-right: 30px">
          
      <a data-bs-toggle="modal" data-bs-target="#completeModal"  class="btn btn-light btn-outline-secondary" href="">
             <label id="modal">Completed</label>
           </a>
      </div>

      
      @endif

      @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2 OR Auth::user()->role_id == 3 OR Auth::user()->role_id == 4 OR Auth::user()->role_id == 6 OR Auth::user()->role_id == 7 OR Auth::user()->role_id == 9 OR Auth::user()->role_id == 10)
      <div id="div2" style="display: block; margin-right: 30px">
           <form method="POST" action="{{route('modify_ticket')}}">
            @csrf
                 <input type="hidden" name="sender" value="{{Auth::user()->id}}">
                  <input type="hidden" name="ticket_no" value="{{$id}}">
                  <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                  <input type="hidden" name="action" value="Resolved">
                  <a onclick="return confirm('If Ticket is Resolved , no further communication can be done  ')"><button class="btn btn-light btn-outline-secondary">Resolved</button></a>
           </form>
      </div>
     
      @endif
      @endif
      @endif

     		<table class="table ">
     			<tr>
     				<th>Date</th>
     				<th>Sender</th>
     				<th>Recipient</th>
     				<th>Message</th>
            <th>Attachment</th>
     			</tr>

                @foreach($conversation as $key => $value)

             			<tr>
             				
             				<td>{{date('d-m-Y H:i' ,strtotime($value->created_at))}}</td>
             				<td>{{$value->mailsender->name}}</td>
             				<td>{{$value->mailrecipient->name}}</td>
             				<td>{{$value->message}}</td>
                    @if(!empty($value->filename))
                     <td>
                      <a id="MybtnModal_{{$key}}" data-id="{{$value->filename}}"> <i class="fa fa-eye"></i></a>
                       
                    </td>
                    @else 
                    <td>
                      
                    </td>
                    @endif
             				
             			</tr>
                

          <!-- Modal -->

                              <div class="modal" id="modal_{{$key}}" >
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Attachment</h5>
                                      <a href="{{route('download_conversation_ticket',$value->id)}}"><i style="margin-left: 30px" class="fa fa-download"></i></a>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                   <div class="modal-body">
                @php
                $revertNames = explode(',', $value->filename);
                @endphpx

              @foreach($revertNames as $key2=>$value2)
               <img class="imagen" id="blah" src="{{ URL::to('/') }}/ticketimages/{{$value2}}" alt="ticketimage" style="width: 400px;height: 250px; margin-top: 20px" />

               <a target="_blank" href="{{ URL::to('/') }}/ticketimages/{{$value2}}"><i class="fa fa-expand" style="color: black;font-size:30px"></i></a> 

             
               @endforeach
              
            </div>
                    </div>
                  </div>
                </div>

<!--  end Modal -->

            <script>
              $(document).ready(function(){
                $('#MybtnModal_{{$key}}').click(function(){
                  $('#modal_{{$key}}').modal('show');
                });
              });  
            </script>
     			@endforeach
     		</table>
     		
     	</div>
     	
     </div>
     
   </div>
</div>


<!-- Modal -->
        <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reply to the conversation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

              </div>
              <div class="modal-body">
                <form method="post" action="{{route('reply_conversation')}}" enctype="multipart/form-data">
                  @csrf
                   <label>Subject : </label>
                   <label class="label-bold">{{$ticket->issue}}</label>
                  
                  <div class="mb-3 div-margin">
                    <label for="recipient-name" class="col-form-label">Recipient Name</label>
                    <!-- <input type="text" class="form-control" id="recipient" name="recipient" placeholder="Enter recipient name" required> -->

                    <select class="form-control" required="required" name="recipient" >
                      <option value="">Select Recipient</option>
                      @foreach($employee as $key => $value)

                         <option value="{{$value->id}}">{{$value->name}} - {{$value->roles->alias}}</option>
 
                      @endforeach
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Message</label>
                     <input type="text" class="form-control" id="message" name="message" required>
                  </div>
                  <input type="hidden" name="sender" value="{{Auth::user()->id}}">
                  <input type="hidden" name="ticket_no" value="{{$id}}">
                  <input type="hidden" name="ticket_id" value="{{$ticket->id}}">

                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Attach Image</label>
                      <input type="file" class="form-control form-control-sm" name="image" id="imgInp" accept="image/*">
                
                  </div>

                  <div class="modal-footer">
                   
                    <button type="submit" class="btn btn-danger">Send</button>
                  </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->


<!-- Completed Modal -->
        <div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add your comments and documents </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

              </div>
              <div class="modal-body">
                <!-- <form method="post" action="{{route('modify_ticket')}}" enctype="multipart/form-data"> -->
                  <form id="myform">
                  
                  @csrf
                   <label>Subject : </label>
                   <label class="label-bold">{{$ticket->issue}}</label>
                  
                  <div class="mb-6">
                   
                    
                     <!-- <input type="text" class="form-control" id="message" name="message" required> -->
                  </div>
                  <textarea name="message" id="comment" placeholder="Enter your comments here..." required style="width: 100%; padding: 10px"></textarea>
                  <input type="hidden" name="sender" id="sender" value="{{Auth::user()->id}}">
                  <input type="hidden" name="ticket_no" id="ticket_no" value="{{$id}}">
                  <input type="hidden" name="ticket_id" id="ticket_id" value="{{$ticket->id}}">
                  <input type="hidden" name="action" id="action" value="Completed">

                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Attach Image *</label>
                      <input type="file" id="file" class="form-control form-control-sm" name="image[]" id="imgInp" required accept="image/*" multiple>
                
                  </div>

                  <div class="modal-footer">
                   
                    <button type="submit" class="btn btn-danger" id="submittion">Send</button>
                  </div>
                </form>

                 <div class="form-group row">
                    <output id="result" />
                </div>
              </div>
              
            </div>
          </div>
        </div>
<!--Completed Modal -->

<script type="text/javascript">
  var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
  var imagesArray = [];
   var filesInput = document.getElementById('file');
    
    filesInput.addEventListener('change', function(e) {
      var output = document.getElementById('result');
      var files = e.target.files; //FileList object

       if(files.length > 4 || imagesArray.length >=4){
        document.getElementById('file').value= null;
        alert("You can only upload a maximum of 4 files");

        
      }
      else {
      
      for (var i = 0; i < files.length; i++) {
       // alert('ll');
        var currFile = files[i];
     
       imagesArray.push(files[i]);

        displayImages();

      
      }

       function displayImages() {

        let images = ""
        imagesArray.forEach((image, index) => {
     
          images += `<div class="image">
                <img  src="${URL.createObjectURL(image)}" alt="image">
                '<span data-indx="`+index+`" class="img-delete"><b class="remove_icon">X</b></span>'
              </div>` 
           })
        
         
        output.innerHTML = images

       }


       $(".img-delete").click(function(){
            //alert("kkk");
          //  alert(imagesArray.length);
                   var imgInd = $(this).attr('data-indx');
                  // alert(imgInd);
                   imagesArray.splice(imgInd,1);
                   $(this).parent(".image").remove();

                   
                   

                });

    
    }

    });

    $(document).ready(function(){

         $('#submittion').click(function(){

              
             var comments = $('#comment').val();
             var action = $('#action').val();
             var ticket_no = $('#ticket_no').val();
             var ticket_id = $('#ticket_id').val();
             var sender = $('#sender').val();
            // alert(comments);
            
            

            if(comments == ''){
              alert("Please Add comments");
              return;
             }
             
             
             if(imagesArray.length == 0){
              alert("Please attach image(s) ");
              return;
             }

             document.getElementById("submittion").style.display= "none" ;

              
                     var fd = new FormData();
                     console.log(fd);

                      imagesArray.forEach(function(image, i) {
                         fd.append('image[]',image);
                      });

                     // Append data 
                    // fd.append('file',imagesArray);
                     fd.append('_token',CSRF_TOKEN);
                     fd.append('ticket_no',ticket_no);
                     fd.append('ticket_id',ticket_id);
                     fd.append('sender',sender);
                     fd.append('message',comments);
                     fd.append('action',action);
                     // Hide alert 
                     $('#responseMsg').hide();
                    
                     
                     // AJAX request 
                     $.ajax({
                          url: "{{ route('modify_ticket') }}",
                          method: 'post',
                          data: fd,
                          contentType: false,
                          processData: false,
                          dataType: 'json',
                          success: function(response){
                             // console.log(response);
                            
                             // alert("Ticket Created Succesfully");
                              // window.location.href = "{{ route('tickets')}}";
                            // document.getElementById("myForm").reset();
                            //$('#myForm').trigger("reset");
                            jQuery("#submit input[type=text]").val('');
                             var data = response;
                             alert(data);


                          },
                          error: function(response){
                                console.log("error : " + JSON.stringify(response) );
                          }
                     });
               

         });
    });
</script>

<style type="text/css">
  output{
  width: 100%;
  min-height: 150px;
  display: flex;
  justify-content: flex-start;
  flex-wrap: wrap;
  gap: 15px;
  position: relative;
  border-radius: 5px;
}

output .image{
  height: 150px;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
  overflow: hidden;
  position: relative;
}

output .image img{
  height: 100%;
  width: 100%;
}

output .image span {
  position: absolute;
  top: -4px;
  right: 4px;
  cursor: pointer;
  font-size: 22px;
  color: white;
}

output .image span:hover {
  opacity: 0.8;
}

output .span--hidden{
  visibility: hidden;
}


</style>


@endsection