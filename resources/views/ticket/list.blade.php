@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
	 <div class="container-header">
            <label class="label-bold" id="div1">Tickets</label>
           <div id="div2">
            <a class="btn btn-light btn-outline-secondary" href="{{route('generate-ticket')}}">
             <label id="modal">Generate Ticket </label> </a>
          
          </div>
          <div id="div2" style="margin-right: 30px">
             <!-- <input class="form-control" type="text" name="search" placeholder="Filter "> -->
             
             <form method="post" action="{{route('filter')}}">
             	@csrf
             <div class="input-group mb-3">
				 
				  <select class="form-control" name="filter">
				  	<option value="">Select </option>
	             	<option value="0">All Tickets</option>
	             	<option value="{{Auth::user()->id}}">My Tickets</option>
	             	<option value="Pending">Pending Tickets</option>
	             	<option value="Closed">Closed Tickets</option>
	             	<option value="Reopend">Reopend Tickets</option>
                 </select>
                 <div class="input-group-prepend">
				    <button class="btn btn-outline-secondary rounded-0" type="submit">Filter</button>
				  </div>
				</div>
             </form>

          </div>       
       </div>

    <div class="page-container"> 
     <div>
     	<div class="card border-white table-responsive">
     		<table class="table">

     			<thead>
	                <tr>
	                 
	                  <th scope="col">Sl.No</th>
	                  <th scope="col">Ticket No</th>
	                  <th scope="col">PCN</th>
	                  <th scope="col" width="100px">Subject</th>
	                  <th scope="col">Description</th>
	                 <!--  <th scope="col">Creator</th>  -->
	                  <th scope="col">Priority</th>
	                  <th scope="col">TAT</th>
	                  <th scope="col" width="150px">Comments</th>
	                   
	                  <th scope="col">Status</th>
	                  <th scope="col" width="100px">Created Date</th>
	                  <th scope="col">Attachment</th>
	                  <th scope="col">Action</th>
	                 
	                </tr>
	            </thead>
	            <tbody>
	            @foreach($tickets as $key=>$value)
	                <tr>
	                	<td>{{$key + $tickets->firstItem()}}</td>
	                	<td>{{$value->ticket_no}}</td>
	                	<td>{{$value->pcn}}</td>
	                	<td>{{$value->category}}</td>
	                	<td>{{$value->issue}}</td>
	                	<!-- @if($value->creator == Auth::user()->id)
	                	<td>Self</td>
	                	@else
                        <td>{{$value->user->name}}</td>
	                	@endif  -->   
                       @php
	                	if($value->priority == 'High'){
	                	  $colors = 'red' ;
	                	}
	                	elseif($value->priority == 'Medium'){
	                	  $colors = 'gold' ;
	                	}
	                	else  
                         $colors = 'limegreen' ;
	                	 
                       @endphp
	                	<td style="color: <?php echo $colors  ?>;font-weight: bold;" >{{$value->priority}}</td>
	                	<td>{{$value->tat}}</td>
	                	<td>{{$value->comments}}</td>
	                	
	                	<td>{{$value->status}} <?php echo '<br>';echo($value->reopened == '1') ? 'Re-Opened':'' ?></td>
	                	<td>{{$value->created_at}}</td>
	                	<td>
	                		@if($value->filename != '')
	                		<a href="#" id="MybtnModal_{{$key}}" data-id="{{$value->filename}}">view</a>
	                		@endif
	                	</td>
	                	
	                	
	                	<td>
	                		@if(Auth::user()->id ==1 || Auth::user()->role == 'manager')
	                		<a href="{{route('edit-ticket', $value->ticket_no)}}"><button class="btn btn-light curved-text-button btn-sm">Edit</button></a>
                            @endif
	                		 @if($value->status == 'Created')
	                		 <a href=""><button class="btn btn-light btn-outline-success btn-sm" disabled="" >Details</button></a>

	                		 @else
	                		 <a href="{{route('ticket-details', $value->ticket_no)}}"><button class="btn btn-light btn-outline-success btn-sm" >Details</button></a>

	                		 @endif

	                		

	                	</td>
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
	            
	            	
	            </tbody>

     			

     		</table>
     		<label>Showing {{ $tickets->firstItem() }} to {{ $tickets->lastItem() }}
                                    of {{$tickets->total()}} results</label>

                                {!! $tickets->links('pagination::bootstrap-4') !!}

     	</div>
     	
     </div>
    </div> 
   </div>
  </div> 


<script type="text/javascript">
	function getTickets(){
		var filter = document.getElementById('filter').value;
		alert(filter);
	}
</script>
@endsection