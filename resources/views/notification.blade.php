@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Notifications</label>
         
        </div>
    </div>

    <div class="page-container">
       <div class="row">
           <div class="col-md-4">
               <div class="users-list">
                   <div >

                   	<div class="card font-weight-bold" style="border-radius: 0;">
                   	  
                   	  @foreach($data as $key=>$value)
                   	   	 <a href="{{route('view_notification', ['id' => $value->id, 'module' => $value->module])}}" style="color: black; text-decoration: none">
	                   	  <div>
	                   	  	<span style="font-weight :<?php echo ($value->status == '0') ? 'bold':'normal';  ?>">{{$value->created_at}}</span>
	                   	  <div>
	                   	  	<label style="margin-left: 30px ; font-weight : <?php echo ($value->status == '0') ? 'bold':'normal';  ?>">{{$value->message}}</label>
	                   	  </div>
	                   	  <div style="height: 3px; background-color: grey"></div>
	                   	  </div>
	                   	 </a>
                   	  
	                  @endforeach
                   	</div>
 
                       
                   </div>	

               </div>
           </div>
       </div>
    </div>
    </div>



@endsection
