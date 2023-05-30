@extends('layouts.app')

@section('content')
<style type="text/css">
    img[src=""] {
    display: none;
}
</style>

<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">Edit Petty Cash</label>
           <div id="div2">
            <a class="btn btn-light btn-outline-secondary" href="{{route('pettycash')}}">
             <label id="modal">View PettyCash List </label> </a>
          
          </div>

     </div>

     <div class="form-build">
     	<div class="row">
     			<div class="col-6">
     				<form method="post" action="{{route('update_pettycash', $data->id)}}" enctype="multipart/form-data">
     					@csrf
     					<div class="form-group row">
                            <label for="" class="col-5 col-form-label">Employee Name*</label>
                            <div class="col-7">
                                <select class="form-control" name="user_id" required>
                                    <option value="">Select Employee</option>
                                    @foreach($employee as $key => $value)
                                    <option value="{{$value->id}}" <?php echo ($value->id == $data->user_id)?'selected':''  ?>>{{$value->name}} - {{$value->roles->alias}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Alloted Amount (in rupees)*</label>
                            <div class="col-7">
                                <input name="amount" id="amount" type="text" class="form-control" required="required" placeholder="Enter Amount" value="{{$data->total}}">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Description*</label>
                            <div class="col-7">
                                <input name="comment" id="comment" type="text" class="form-control" required="required" placeholder="Enter description" value="{{$data->comments}}">
                            </div>
                        </div>


                        <input type="hidden" name="rowid" value="{{$data->id}}">


                         <div class="form-group row">
                            <div class="offset-5 col-7">
                                <button  type="submit" class="btn btn-danger">Update</button>
                                
                            </div>
                        </div>

                    	
     				</form>
     				
     			</div>

                <div class="col-6">
                     <img class="imagen" id="blah" src="" alt="ticketimage" style="width: 200px;height: 200px" />

                </div>
     		
     		
     	</div>
     	
     </div>

    </div>
</div>



@endsection