@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
	 <div class="container-header">
            <label class="label-bold" id="div1">Departments</label>
           <div id="div2">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="" class="btn btn-light btn-outline-secondary" >
             <label id="modal">Create Department </label> </a>
          </div>
        
       </div>
      
      <div class="page-container div-margin">
      	<div class="card ">
	       	<table class="table">
	       		<thead>
	       			<tr>
	       				<th>Created Date</th>
	       				<th>Department Name</th>
	       				<th>Description</th>
	       				<th></th>
	       				
	       			</tr>
	       		</thead>

	       		<tbody>
	       			@foreach($data as $key=>$value)
	       			<tr>
	       				<td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
	       				<td>{{$value->department}}</td>
	       				<td>{{$value->description}}</td>
	       				<td><a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_department', $value->id)}}"><button class="btn btn-sm btn-outline-danger">Delete</button></a></td>
	       			</tr>
	       			@endforeach
	       		</tbody>
	       		
	       	</table>
       	
       </div>

      	
      </div>
       
  
     		

   </div>
  </div>

  <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{route('create_department')}}">
                  @csrf
                  <div class="mb-3">
                    <label class="col-form-label">Department Name </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Department Name" required>
                  </div>

                  <div class="mb-3">
                    <label class="col-form-label">Description (optional)</label>
                    <textarea class="form-control" id="desc" name="desc" ></textarea>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">SAVE</button>
                  </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal --> 


@endsection