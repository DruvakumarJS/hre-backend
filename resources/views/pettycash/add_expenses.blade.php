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
        <label class="label-bold" id="div1">Petty Cash Expenses</label>

        <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('pettycash')}}"> View PettyCash List</a>
        </div>

    </div>

    <div class="form-build">
     	<div class="row">
     			<div class="col-6">
     				<form method="post" action="{{route('upload_bills', $data->id)}}" enctype="multipart/form-data">
     					@csrf
     					
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Amount (in rupees)*</label>
                            <div class="col-7">
                                <input name="amount" id="amount" type="text" class="form-control" required="required" placeholder="Enter Amount">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Description </label>
                            <div class="col-7">
                                <input name="comment" id="comment" type="text" class="form-control" placeholder="Enter description" required="required">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Upload bill</label>
                            <div class="col-7">
                                <input type="file" class="form-control form-control-sm" name="bill" id="imgInp" required>
                
                            </div>
                        </div>


                        <input type="hidden" name="id" value="{{$data->id}}">

                         <div class="form-group row">
                            <div class="offset-5 col-7">
                                <button  type="submit" class="btn btn-danger">Submit</button>
                                
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