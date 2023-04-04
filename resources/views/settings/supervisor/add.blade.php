@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <label class="label-bold">Add Supervisors</label>
    </div>

    <div style="margin-top: 50px">
    	<label>Add New Supervisor</label>
         <div>
         	<label>Name</label>
    	    <input type="text" name="" placeholder="Name"> 	
         </div>

          <div>
         	<label>Mobile</label>
    	    <input type="text" name="" placeholder="Mobile"> 	
         </div>

          <div>
         	<label>Email</label>
    	    <input type="text" name="" placeholder="Email id"> 	
         </div>

          <div>
         	<label>Name</label> 
    	    <input type="text" name="" placeholder="Name"> 	
         </div>
    	

    </div>
</div>
@endsection