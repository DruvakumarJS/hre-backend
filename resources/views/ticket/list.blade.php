@extends('layouts.app')

@section('content')

@php
if($filter == 'Pending/Ongoing'){$filter = 'Pending';}
@endphp

<style type="text/css">
  thead th {
 
  height: 50px;
}

td{
max-width: 100px;
overflow: hidden;
text-overflow: clip;
white-space: nowrap;
}


</style>

<div class="container">
    <div class="row justify-content-center">
	 <div class="container-header">
            <label class="label-bold" id="div1">Tickets</label>
           <div id="div2">
            <a class="btn btn-light btn-outline-secondary" href="{{route('generate-ticket')}}">
             <label id="modal">Generate Ticket </label> </a>
          </div>
       

           <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('search_ticket')}}" >
            @csrf
             <div class="input-group mb-3">
             	<input type="hidden" name="filter" value="{{$filter}}">
                <input class="form-control" type="text" name="search" placeholder="Search ticket">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>
 

 
          <div id="div2" style="margin-right: 30px">
             <!-- <input class="form-control" type="text" name="search" placeholder="Filter "> -->
            @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2' )
             <form method="post" action="{{route('filter')}}">
             	@csrf
             <div class="input-group mb-3">
				 
				  <select class="form-control" name="filter" onchange="filetrdata()">
				  	<option value="">Select </option>
	             	<option value="0">All Tickets</option>
	             	<option <?php echo ($filter == '1')?'selected':''  ?> value="{{Auth::user()->id}}">My Tickets</option>
	             	<option <?php echo ($filter == 'Created')?'selected':''  ?> value="Created">Created Tickets</option>
	             	<option <?php echo ($filter == 'Pending')?'selected':''  ?> value="Pending">Pending Tickets</option>
	             	<option <?php echo ($filter == 'Completed')?'selected':''  ?> value="Completed">Completed Tickets</option>
	             	<option <?php echo ($filter == 'Resolved')?'selected':''  ?> value="Resolved">Resolved Tickets</option>
	             	<option <?php echo ($filter == 'Reopend')?'selected':''  ?> value="Reopend">Reopend Tickets</option>
	             	<option <?php echo ($filter == 'Rejected')?'selected':''  ?> value="Rejected">Rejected Tickets</option>
                 </select>
                 <div class="input-group-prepend">
				    <button class="btn btn-outline-secondary rounded-0" id="btn_filter" type="submit" style="display: none">Filter</button>
				  </div>
				</div>
             </form>
            @endif

          </div> 


          <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('export_tickets',$filter)}}">
             <label id="modal">Download CSV</label> </a>
          </div>      
       </div>

    <div class="page-container"> 
     <div class="row">
     	<div class="card border-white scroll tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">
     		<table class="table" >

     			<thead>
	                <tr>
	                  <th scope="col">C_Date</th>
	                  <th scope="col">Ticket_No</th>
	                  <th scope="col">PCN</th>
	                  <th scope="col">Billing Details</th>
	                  <th scope="col">Department</th>
	                  <th scope="col">Description</th>
	                  <th scope="col">Creator</th> 
	                  <th scope="col">Priority</th>
	                  <th scope="col">TAT</th>
	                  
	                  <th scope="col">Status</th>
	                 
	                  <th scope="col">Attachment</th>
	                  <th scope="col">Action</th>
	                 
	                </tr>
	            </thead>
	           
	            @foreach($tickets as $key=>$value)
	                <tr>
	                	<td width="90px;">{{date("d-m-Y", strtotime($value->created_at))}}</td>
	                	<td width="50px;">{{$value->ticket_no}}</td>
	                	<td width="25px;">{{$value->pcn}}</td>
	                	<td>{{$value->pcns->brand}},{{$value->pcns->city}}</td>
	                	<td width="50px">{{$value->category}}</td>
	                	<td style="overflow: hidden;word-break: break-word;">{{$value->issue}}</td>
	                	 
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
                       <td width="50px">{{$value->user->name}}</td>
	                	<td width="20px"><button class="btn btn-light" style="width:25px; height: 10px;background-color: <?php echo $colors;  ?>" > </button></td>

	                	<td width="100px"><?php echo ($value->tat!='') ? date("d-m-Y", strtotime($value->tat)) :''  ?></td>
	                	
	                	<td width="50px">{{$value->status}} <?php echo '<br>';echo($value->reopened == '1') ? 'Re-Opened':'' ?></td>
	                	
	                	<td style="text-align: center;width: 20px ">
	                		@if($value->filename != '')
	                		<a href="#" id="MybtnModal_{{$key}}" data-id="{{$value->filename}}"><i class="fa fa-eye" style="color:black"></i></a>

	                		@endif
	                	</td>
	                	
	              
	                	<td>
	                		@if(Auth::user()->role_id == 1 || Auth::user()->role == 'manager')
	                		<a href="{{route('edit-ticket', $value->ticket_no)}}"><button class="btn btn-light curved-text-button btn-sm" style="padding: 1px 10px">Update</button></a>
	                		@elseif($value->status == 'Created')
	                		<a href="{{route('edit-ticket', $value->ticket_no)}}"><button class="btn btn-light curved-text-button btn-sm" style="padding: 1px 10px">Update</button></a>
	                		@else
	                		<!-- <a href=""><button class="btn btn-light curved-text-button btn-sm" disabled>Edit</button></a> -->
                            @endif

	                		 @if($value->status == 'Created' || $value->status == 'Rejected'  )
	                		 <a href=""><button class="btn-light btn-outline-grey btn-sm" disabled >Info/Convo</button></a>

	                		 @else
	                		 <a href="{{route('ticket-details', $value->ticket_no)}}"><button class="btn btn-light btn-outline-success btn-sm" style="padding: 1px 10px">Info/Convo</button></a>

	                		 @endif

	                		

	                	</td>
	                </tr>

        <!-- Modal -->
                  <div class="modal" id="modal_{{$key}}" >
			        <div class="modal-dialog">
			          <div class="modal-content">
			            <div class="modal-header">
			              <h5 class="modal-title" id="exampleModalLabel">Attachments </h5>

			               <a href="{{route('download_ticket',$value->id)}}"><i style="margin-left: 30px" class="fa fa-download"></i></a>
			             
			              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			            </div>
			            <div class="modal-body">
			            	@php
			            	$revertNames = explode(',', $value->filename);
			            	@endphp

                          @foreach($revertNames as $key2=>$value2)
			               <img class="imagen" id="blah" src="{{ URL::to('/') }}/ticketimages/{{$value2}}" alt="ticketimage" style="width: 400px;height: 250px; margin: 10px" />

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

	function filetrdata(){
		$('#btn_filter').click();
	}
</script>
@endsection