@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
	 <div class="container-header">
            
          <div id="div2">
            <a class="btn btn-light" href="{{route('tickets')}}">
             <label id="modal">View Tickets </label> </a>
          </div>

         
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
           <a data-bs-toggle="modal" data-bs-target="#replyModal"  class="btn btn-light" href=""><i class="fa fa-plus"></i> 
             <label id="modal">Reply</label>
           </a>
          </div>

     	<div>
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
     				
     			</tr>
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
                <form method="post" action="{{route('reply_conversation')}}">
                  @csrf
                   <label>Subject : </label>
                   <label class="label-bold">{{$ticket->subject}}</label>
                  <div class="mb-3 div-margin">
                    <label for="recipient-name" class="col-form-label">Recipient Name</label>
                    <input type="text" class="form-control" id="recipient" name="recipient" placeholder="Enter recipient name" required>
                  </div>

                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Message</label>
                     <input type="text" class="form-control" id="message" name="message" required>
                  </div>
                  <input type="hidden" name="sender" value="{{Auth::user()->id}}">
                 
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