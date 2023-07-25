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
             <label id="modal">View Tickets </label> </a>
          </div>
          
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
              <label>PCN : </label> <label class="label-bold">{{$id}}</label>
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
     	<h4 class="label-bold">CATEGORY : {{$ticket->category}}</h4>
     	<label>Description : {{$ticket->issue}}</label>

       @foreach($conversation as $key => $value)

                   @php
                    if(($value->sender == Auth::user()->id) or ($value->recipient == Auth::user()->id)) 
                    {
                      $can_reply = 'True';
                    }

                   @endphp

        @endforeach

        @if($ticket->status != 'Resolved')
        @if($can_reply == "True" or Auth::user()->role_id == 1 or Auth::user()->role_id == 2 or Auth::user()->role_id == 5)
     	 <div id="div2" style="display: block">
           <a data-bs-toggle="modal" data-bs-target="#replyModal"  class="btn btn-light btn-outline-secondary" href=""><i class="fa fa-plus"></i> 
             <label id="modal">Reply</label>
           </a>
      </div>
       <div id="div2" style="display: block ; margin-right: 30px">
           <!-- <a onclick="return confirm('Ticket is Completed')" class="btn btn-light btn-outline-secondary" href="{{route('modify_ticket',[$id , 'Completed'])}}">
             <label id="modal">Completed</label>
           </a>
 -->
      <a data-bs-toggle="modal" data-bs-target="#completeModal"  class="btn btn-light btn-outline-secondary" href="">
             <label id="modal">Completed</label>
           </a>
      </div>

      
      @endif

      @if(Auth::user()->role_id == 1 or Auth::user()->role_id == 2)
      <div id="div2" style="display: block; margin-right: 30px">
           <!-- <a onclick="return confirm('Ticket is Resolved')" class="btn btn-light btn-outline-secondary" href="{{route('modify_ticket',[$id , 'Resolved'])}}"> 
             <label id="modal">Resolved</label>
           </a> -->

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
             				
             				<td>{{$value->created_at}}</td>
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
                <form method="post" action="{{route('modify_ticket')}}" enctype="multipart/form-data">
                  @csrf
                   <label>Subject : </label>
                   <label class="label-bold">{{$ticket->issue}}</label>
                  
                  <div class="mb-6">
                   
                    
                     <!-- <input type="text" class="form-control" id="message" name="message" required> -->
                  </div>
                  <textarea name="message" placeholder="Enter your comments here..." required style="width: 100%; padding: 10px"></textarea>
                  <input type="hidden" name="sender" value="{{Auth::user()->id}}">
                  <input type="hidden" name="ticket_no" value="{{$id}}">
                  <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                  <input type="hidden" name="action" value="Completed">

                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Attach Image *</label>
                      <input type="file" class="form-control form-control-sm" name="image" id="imgInp" required accept="image/*">
                
                  </div>

                  <div class="modal-footer">
                   
                    <button type="submit" class="btn btn-danger">Send</button>
                  </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>
<!--Completed Modal -->



@endsection