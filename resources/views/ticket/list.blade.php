@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
	 <div class="container-header">
            <label class="label-bold" id="div1">Tickets</label>
           <div id="div2">
            <a class="btn btn-light" href="{{route('generate-ticket')}}">
             <label id="modal">Genrate Ticket </label> </a>
          
          </div>
          <div id="div2" style="margin-right: 30px">
             <input class="form-control" type="text" name="search" placeholder="serach">
          </div>       
     </div>

     <div class="div-margin">
     	<div class="card border-white">
     		<table class="table">

     			<thead>
	                <tr>
	                 
	                  <th scope="col">Sl.No</th>
	                  <th scope="col">Ticket ID</th>
	                  <th scope="col">PCN</th>
	                  <th scope="col">Issue</th>
	                  <th scope="col">Customer Name</th>
	                  <th scope="col">Owner</th>
	                  <th scope="col">Assigned to</th>
	                  <th scope="col">Created Date</th>
	                  <th scope="col">Status</th>
	                  <th scope="col">Action</th>
	                 
	                </tr>
	            </thead>
	            <tbody>
	            @foreach($tickets as $key=>$value)
	                <tr>
	                	<td>{{$key + $tickets->firstItem()}}</td>
	                	<td>{{$value->ticket_id}}</td>
	                	<td>{{$value->pcn}}</td>
	                	<td>{{$value->issue}}</td>
	                	<td>{{$value->Pcn->client_name}}</td>
	                
	                	@if($value->owner == Auth::user()->id)
	                	<td>Self</td>
	                	@else
                        <td>{{$value->user->name}}</td>
	                	@endif

	                	@if($value->employee->id == Auth::user()->id)
	                	<td>Self</td>
	                	@else
                        <td>{{$value->employee->name}}</td>
	                	@endif
	                	
	                	
	                	<td>{{$value->created_at}}</td>
	                	<td>{{$value->status}}</td>
	                	<td>
	                		<a href="{{route('edit-ticket', $value->ticket_id)}}"><label class="btn btn-light">Edit</label></a>

	                	</td>
	                </tr>
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
@endsection