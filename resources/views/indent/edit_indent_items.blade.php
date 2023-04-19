@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <label class="label-bold">Intend Details</label>

    </div>

    <div style="margin-top: 70px">

    	<div class="row">
    		 <div class="col-md-2">
	    	 	<label>Intend Number</label>
	    	 	<div>
	    	 		<label class="label-bolder">{{$indend_data->indent->indent_no}}</label>
	    	 	</div>
	            
         </div>

          <div class="col-md-2">
          <label>PCN </label>
          <div>
            <label class="label-bolder">{{$indend_data->indent->pcn}}</label>
          </div>
              
         </div>

              <div class="col-md-1">
	    	 	 <label style="font-weight: bold;font-size: 23px ; color: #44B400; margin-left: 10px">{{$indend_data->recieved}}</label>
	    	 	 <div>
	    	 	 	<label class="label-bold">Dispatched</label>
	    	 	 </div>
	             
             </div>

                <div class="col-md-1">
	    	 	 <label style="font-weight: bold;font-size: 23px ; color: #FF0000; margin-left: 10px">{{$indend_data->pending}}</label>
	    	 	 <div>
	    	 	 	<label class="label-bold">Pending</label>
	    	 	 </div>
	             
             </div>

              <div class="col-md-1">
           <label style="font-weight: bold;font-size: 23px ; color: #FF0000; margin-left: 10px">{{$indend_data->pending}}</label>
           <div>
            <label class="label-bold">Received</label>
           </div>
               
             </div>


        @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
        @endif 
<!-- <p id="mydiv" class="text-danger text-center">hfhfh</p>
 -->             

    	</div >
        <div class="row" style="margin-top: 20px">

        	<div class="card border-white col-md-6">
        		<div>
        			<label class="label-small">Material Category</label>
        			<div>
        				<label class="label-bold">{{$indend_data->materials->Category->category}}</label>
        			</div>	
        		</div>

            <div style="margin-top: 20px">
              <label class="label-small">Material Id</label>
              <div>
                <label class="label-bold">{{$indend_data->material_id}}</label>
              </div>  
            </div>

        		<div style="margin-top: 20px">
        			<label class="label-small">Material Name</label>
        			<div>
        				<label class="label-bold">{{$indend_data->materials->name}}</label>
        			</div>	
        		</div>

        		<div  style="margin-top: 20px">
        			<label class="label-small">Brand Name</label>
        			<div>
        				<label class="label-bold">{{$indend_data->materials->brand}}</label>
        			</div>	
        		</div>

        		<div  style="margin-top: 20px">
        			<label class="label-small">Material Description</label>
        			<div>
                @php
                   $info = json_decode($indend_data->materials->information , true);

                @endphp
                @foreach($info as $key =>$value)
        				<label class="label-bold">{{$key}} : {{$value}}</label>
                @php echo"<br/>"; @endphp
                @endforeach
        			</div>	
        		</div>

        		<div  style="margin-top: 20px">
        			<label class="label-small">Created Date</label>
        			<div>
        				<label class="label-bold">{{$indend_data->created_at}}</label>
        			</div>	
        		</div>
    		
    	    </div>

    	    <div class=" col-md-6" >
    	    <div style="margin-left: 60px">
         <form method="post" action="{{route('update_quantity')}}">
          @csrf
          <div class="row">
            <div class="col-md-3">
              <label>Qunatity Received</label>
              <input class="form-control" type="text" name="quantity" required="required">
            </div>

             <div class="col-md-3" >
              <button class="btn btn-danger">Update</button>
            </div>

            <input type="hidden" name="indent_no" value="{{$indend_data->indent->indent_no}}">
            <input type="hidden" name="pcn" value="{{$indend_data->indent->pcn}}">
            <input type="hidden" name="id" value="{{$id}}">
            
          </div>
         </form>  

    	    	<label class="label-bolder div-margin">Recent Updates</label>

            <div class="div-margin">
                    <div class="row">
                       <div class="col-md-2">
                          <label class="label-bolder">#</label>
                       </div>

                        <div class="col-md-3">
                          <label class="label-bolder">Quantity </label>
                       </div>

                        <div class="col-md-4">
                          <label class="label-bolder">Date </label>
                       </div>

                        
                    
                   </div>
      
            </div>

            @foreach($indent_tracker as $key =>$value)
    	    	<div class="card">
                    <div class="row">
                   	   <div class="col-md-2">
                   	   	  <label class="label-medium">{{$key+1}}</label>
                   	   </div>

                   	    <div class="col-md-3">
                   	   	  <label class="label-medium">{{$value->quantity}}</label>
                   	   </div>

                   	    <div class="col-md-4">
                   	   	  <label class="label-medium">{{$value->created_at}}</label>
                   	   </div>

                   	    <div class="col-md-3">
                   	   	 <label class="curved-text" style="background-color: #44B400 ; color:#fff">Received</label> 
                   	   </div>
                   	
                   </div>
  		
    	    	</div>
            @endforeach
    	    	
             </div>
    		
    	   </div>
     	
        </div>
    </div>
</div>
@endsection