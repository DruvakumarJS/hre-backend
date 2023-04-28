@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">Edit Tickets</label>
           <div id="div2">
            <a class="btn btn-light" href="{{route('tickets')}}">
             <label id="modal">View Tickets </label> </a>
          
          </div>

     </div>

     <div class="form-build">
     	<div class="row">
     			<div class="col-6">
     				<form method="post" action="{{route('update-ticket')}}">
     					@csrf
     					<div class="form-group row">
                            <label for="" class="col-5 col-form-label">Project Code Number *</label>
                            <div class="col-7">
                                <input name="pcn" id="pcn" type="text" class="typeahead form-control" required="required" placeholder="Enter PCN" value="{{$tickets->pcn}}" readonly="readonly">
                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Indent No</label>
                            <div class="col-7">
                                <input name="indent_no" id="indent_no" type="text" class="typeahead form-control" placeholder="Enter Indent No (Optional)" value="{{$tickets->indent_no}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Customer Issue *</label>
                            <div class="col-7">
                                <textarea  name="issue" id="issue" type="text" class="typeahead form-control" required="required" placeholder="Enter Customer issue here" >{{$tickets->issue}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Assign to *</label>
                            <div class="col-7">
                                <!-- <input name="assign_to" type="assign_to" class="typeahead form-control" required="required" placeholder="Assign ticket to Employee " value="{{$tickets->employee->name}}"> -->
                                <select class="form-control" name="user_id" >
                                    <option value="">Select user</option>
                                    <option value="{{Auth::user()->id}}" <?php echo (Auth::user()->id == $tickets->assigned_to) ? 'selected' : ''; ?> >Self</option>

                                    @foreach($supervisor as $key => $value)
                                    
                                    <option value="{{$value->user_id}}" <?php echo ($value->user_id == $tickets->assigned_to) ? 'selected' : ''; ?>>{{$value->name}}</option>

                                    @endforeach
                                </select>
                               
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Status</label>
                            <div class="col-7">
                                <!-- <input name="assign_to" type="assign_to" class="typeahead form-control" required="required" placeholder="Assign ticket to Employee " value="{{$tickets->employee->name}}"> -->
                                <select class="form-control" name="status" required="required" >
                                   
                                    <option value="Pending" <?php echo ($tickets->status == 'Pending') ? 'selected' : ''; ?>  >Pending</option>
                                    <option value="Closed" <?php echo ($tickets->status == 'Closed') ? 'selected' : ''; ?> >Closed</option>
                                    <option value="Reopen" <?php echo ($tickets->status == 'Reopen') ? 'selected' : ''; ?> >Reopen</option>
                                   
                                </select>
                               
                            </div>
   
                        </div>
                        <input type="hidden" name="owner" value="{{Auth::user()->id}}">
                        <input type="hidden" name="id" value="{{$tickets->id}}">

                         <div class="form-group row">
                            <div class="offset-5 col-7">
                                <button name="submit" type="submit" class="btn btn-success">Update Ticket</button>
                                
                            </div>
                        </div>

     					
     				</form>
     				
     			</div>
     		
     		
     	</div>
     	
     </div>

    </div>
</div>


@endsection