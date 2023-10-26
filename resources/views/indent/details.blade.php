@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div>

        <label class="label-bold">Indent Details</label>

         <div id="div2">
             <button class="btn btn-light" ><i class="fa fa-plus"></i> Create User</button>
            
          </div>
          <div id="div2" style="margin-right: 30px">
             <button class="btn btn-light" ><i class="fa fa-plus"></i> Create Customer</button>
          </div>
        
      </div>
        
       
    </div>

    <div style="margin-top: 50px">

    	<div class="row">
    		 <div class="col-md-2">
	    	 	<label>Indent Number</label>
	    	 	<div>
	    	 		<label class="label-bolder">{{$id}}</label>
	    	 	</div>
	            
             </div>

              <div class="col-md-1">
	    	 	 <label style="font-weight: bold;font-size: 23px ; color: #44B400; margin-left: 10px">20</label>
	    	 	 <div>
	    	 	 	<label class="label-bold">Received</label>
	    	 	 </div>
	             
             </div>

                <div class="col-md-1">
	    	 	 <label style="font-weight: bold;font-size: 23px ; color: #FF0000; margin-left: 10px">15</label>
	    	 	 <div>
	    	 	 	<label class="label-bold">Pending</label>
	    	 	 </div>
	             
             </div>

             

    	</div>
        <div class="row" style="margin-top: 20px">

        	<div class="card border-white col-md-6">
        		<div>
        			<label class="label-small">Material Category</label>
        			<div>
        				<label class="label-bold">Hardware</label>
        			</div>	
        		</div>

        		<div style="margin-top: 20px">
        			<label class="label-small">Material Name</label>
        			<div>
        				<label class="label-bold">Telephonic Draw Channel</label>
        			</div>	
        		</div>

        		<div  style="margin-top: 20px">
        			<label class="label-small">Brand Name</label>
        			<div>
        				<label class="label-bold">EBCO</label>
        			</div>	
        		</div>

        		<div  style="margin-top: 20px">
        			<label class="label-small">Material Description</label>
        			<div>
        				<label class="label-bold">270 Degree Hinges close Ebco code : H270</label>
        			</div>	
        		</div>

        		<div  style="margin-top: 20px">
        			<label class="label-small">Created Date</label>
        			<div>
        				<label class="label-bold">12/03/2023</label>
        			</div>	
        		</div>
    		
    	    </div>

    	    <div class=" col-md-6" >
    	    <div style="margin-left: 60px">
    	    	<label class="label-bolder">Recent Updates</label>
    	    	<div class="card border-white" >
                   <div class="row">
                   	   <div class="col-md-2">
                   	   	  <label class="label-medium">M001</label>
                   	   </div>

                   	    <div class="col-md-3">
                   	   	  <label class="label-medium">Quantity-12</label>
                   	   </div>

                   	    <div class="col-md-4">
                   	   	  <label class="label-medium">sent Date 23/3/2023</label>
                   	   </div>

                   	    <div class="col-md-3">
                   	   	 <label class="curved-text" style="background-color: #44B400">Received</label> 
                   	   </div>
                   	
                   </div>
  		
    	    	</div>



    	    	<div class="card border-white" >
                  <div class="row">
                       <div class="col-md-2">
                          <label class="label-medium">M001</label>
                       </div>

                        <div class="col-md-3">
                          <label class="label-medium">Quantity-12</label>
                       </div>

                        <div class="col-md-4">
                          <label class="label-medium">sent Date 23/3/2023</label>
                       </div>

                        <div class="col-md-3">
                         <label class="curved-text" style="background-color: #B44B00">Pending</label> 
                       </div>
                    
                   </div>
  		
    	    	</div>
    	    	
             </div>
    		
    	   </div>
     	
        </div>
    	

    </div>
</div>
@endsection