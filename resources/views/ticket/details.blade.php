@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
	 <div class="container-header">
            
          <div id="div2">
            <a class="btn btn-light btn-outline-secondary" href="{{route('tickets')}}">
             <label id="modal">View Tickets </label> </a>
          </div>
          
           @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
           @endif 
         
          <div id="div2" style="margin-right: 30px">
           
          </div>       
     </div>

     <div>
     	
     	<div class="card">

     		<div class="row">
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

     			

     			<div class="col-md-2">
     				<div class="row">
     					<label>Ticket Owner</label>
     				    <h4>{{$ticket->employee->name}}</h4>
     				</div>
     				
     			</div>

     			<div class="col-md-3">
     				<div class="row">
     					<label>Created Date</label>
     				    <h4>{{$ticket->created_at}}</h4>
     				</div>
     				
     			</div>

     			
     		</div>
     	</div>
     </div>
     
     <div class="div-margin">
     	<h4 class="label-bold">Subject : {{$ticket->subject}}</h4>
     	<h3>Conversation</h3>


     	 <div id="div2">
           <a data-bs-toggle="modal" data-bs-target="#replyModal"  class="btn btn-light btn-outline-secondary" href=""><i class="fa fa-plus"></i> 
             <label id="modal">Reply</label>
           </a>
          </div>
        

     		<table class="table ">
     			<tr>
     				<th>Date</th>
     				<th>Sender</th>
     				<th>Recipient</th>
     				<th>Message</th>
     			</tr>

                @foreach($conversation as $key => $value)
     			<tr>
     				
     				<td>{{$value->created_at}}</td>
     				<td>{{$value->mailsender->name}}</td>
     				<td>{{$value->mailrecipient->name}}</td>
     				<td>{{$value->message}}</td>
            @if(!empty($value->filename))
             <td>
              <a id="MybtnModal_{{$key}}" data-id="{{$value->filename}}"> <button class="btn btn-light">Attachment</button></a>
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
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                       <img class="imagen" id="blah" src="{{ URL::to('/') }}/ticketimages/{{$value->filename}}" alt="ticketimage" style="width: 400px;height: 250px" />
                                      
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
                   <label class="label-bold">{{$ticket->subject}}</label>
                  
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
                      <input type="file" class="form-control form-control-sm" name="image" id="imgInp" >
                
                  </div>

                  <div class="modal-footer">
                   
                    <button type="submit" class="btn btn-primary">Send</button>
                  </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->



@endsection