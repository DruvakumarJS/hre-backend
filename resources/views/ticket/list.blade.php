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
            @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '3' )
             <form method="post" action="{{route('filter')}}">
             	@csrf
             <div class="input-group mb-3">
				 
				  <select class="form-control" name="filter">
				  	<option value="">Select </option>
	             	<option value="0">All Tickets</option>
	             	<option value="{{Auth::user()->id}}">My Tickets</option>
	             	<option value="Created">Created Tickets</option>
	             	<option value="Pending">Pending Tickets</option>
	             	<option value="Completed">Completed Tickets</option>
	             	<option value="Reopend">Reopend Tickets</option>
	             	<option value="Rejected">Rejected Tickets</option>
                 </select>
                 <div class="input-group-prepend">
				    <button class="btn btn-outline-secondary rounded-0" type="submit">Filter</button>
				  </div>
				</div>
             </form>
            @endif

          </div>       
       </div>

    <div class="page-container"> 
     <div>
     	<div class="card border-white table-responsive">
     		<table class="table">

     			<thead>
	                <tr>
	                  <th scope="col">Date</th>
	                  <th scope="col">Ticket No</th>
	                  <th scope="col">PCN</th>
	                  <th scope="col" width="150px">Department</th>
	                  <th scope="col" width="150px">Description</th>
	                 <!--  <th scope="col">Creator</th>  -->
	                  <th scope="col">Priority</th>
	                  <th scope="col">TAT</th>
	                  
	                  <th scope="col">Status</th>
	                 
	                  <th scope="col">Attachment</th>
	                  <th scope="col">Action</th>
	                 
	                </tr>
	            </thead>
	            <tbody>
	            @foreach($tickets as $key=>$value)
	                <tr>
	                	<td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
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
	                	<td><button class="btn btn-light" style="width:50px; height: 10px;background-color: <?php echo $colors;  ?>" > </button></i></td>

	                	<td><?php echo ($value->tat!='') ? date("d-m-Y", strtotime($value->tat)) :''  ?></td>
	                	
	                	<td>{{$value->status}} <?php echo '<br>';echo($value->reopened == '1') ? 'Re-Opened':'' ?></td>
	                	
	                	<td>
	                		@if($value->filename != '')
	                		<a href="#" id="MybtnModal_{{$key}}" data-id="{{$value->filename}}"><i class="fa fa-image" style="color:black"></i></a>
	                		@endif
	                	</td>
	                	
	                	
	                	<td>
	                		@if(Auth::user()->id ==1 || Auth::user()->role == 'manager')
	                		<a href="{{route('edit-ticket', $value->ticket_no)}}"><button class="btn btn-light curved-text-button btn-sm">Edit</button></a>
	                		@elseif($value->status == 'Created')
	                		<a href="{{route('edit-ticket', $value->ticket_no)}}"><button class="btn btn-light curved-text-button btn-sm">Edit</button></a>
	                		@else
	                		<a href=""><button class="btn btn-light curved-text-button btn-sm" disabled>Edit</button></a>
                            @endif

	                		 @if($value->status == 'Created')
	                		 <a href=""><button class="btn btn-light btn-outline-success btn-sm" disabled="" >More Info</button></a>

	                		 @else
	                		 <a href="{{route('ticket-details', $value->ticket_no)}}"><button class="btn btn-light btn-outline-success btn-sm" >More Info</button></a>

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