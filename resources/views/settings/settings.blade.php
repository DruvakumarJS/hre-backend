@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <label class="label-bold">Settings</label>
    </div>

    <div class="row">
                <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body">
                        	<div class="row">
                        		 <h4 class="card-text-black" style="color: #000; font-weight: bold; font-size: 25px">Project Manager</h4> 
                        		 
                        	</div>

                        	 <div>
                             <a style="float: right;" href=""><label class="curved-text-button">Add</label></a>
                              <a style="float: right;margin-right: 20px" href=""><label class="curved-text-button">View</label></a>
                           
                        </div >
                           

                        </div>	
                       
                        
                    </div>
                    <!--</div>-->
                </div>



                 <div class="col-sm-6 col-md-4" >
                    <div class="card border-white">
                        <div class="card-body">
                            <h4 class="card-text-black" style="color: #000; font-weight: bold; font-size: 25px">Supervisors</h4> 
                        </div>
                        <div  >
                           
                             <a style="float: right;" href=""><label class="curved-text-button">Add</label></a>
                              <a style="float: right;margin-right: 20px" href=""><label class="curved-text-button">View</label></a>
                           
                        </div >
                        
                    </div>
                    <!--</div>-->
                </div>


                 <div class="col-sm-6 col-md-4 ">
                   <div class="card border-white">
                        <div class="card-body">
                            <h4 class="card-text-black" style="color: #000; font-weight: bold; font-size: 25px">Procurement</h4> 
                        </div>
                        <div  >
                           
                             <a style="float: right;" href=""><label class="curved-text-button">Add</label></a>
                              <a style="float: right;margin-right: 20px" href=""><label class="curved-text-button">View</label></a>
                           
                        </div >
                        
                    </div>
                    <!--</div>-->
                </div>


              
            </div>
</div>
@endsection