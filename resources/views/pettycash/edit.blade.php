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
          
          @if($data->status == 'Active')
           <div id="div2" style="margin-right: 30px">
              <a class="btn btn-light btn-outline-secondary" href="{{route('modify_pettycash_status',[$data->id,'Inactive'])}}">
              <label id="modal">Deactivate the Transaction</label> </a>
           </div>
          @else
          <div id="div2" style="margin-right: 30px">
              <a class="btn btn-light btn-outline-secondary" href="{{route('modify_pettycash_status',[$data->id,'Active'])}}">
              <label id="modal">Activate the Transaction</label> </a>
           </div>
          @endif 

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
                            <label for="" class="col-5 col-form-label">Issued Date*</label>
                            <div class="col-7">
                                <input name="issued_date"  type="date" class="form-control" required="required" placeholder="Enter Amount" value="{{$data->issued_on}}">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Description*</label>
                            <div class="col-7">
                                <input name="comment" id="comment" type="text" class="form-control" required="required" placeholder="Enter description" value="{{$data->comments}}">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Mode of Payment* </label>
                            <div class="col-7">
                               <select class="form-control"name='mode' id='mode' required="required">
                                   <option value="">Select Mode</option>
                                   <option value="Cash" <?php echo  ($data->mode == 'Cash')  ? 'selected':'' ?> >Cash</option>
                                   <option value="Online" <?php echo ($data->mode == 'Online')  ? 'selected':'' ?> >Online</option>
                               </select>
                            </div>
                        </div>

                        <div class="form-group row" >
                            <label id="ref_lable" class="col-5 col-form-label" style="display:  none">Reference Number* </label>
                            <div class="col-7">
                                <input name="refernce" id="refernce" type="text" class="form-control" placeholder="Enter Reference Number" id="refernce" value="{{$data->reference_number}}" style="display: none">
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

<script type="text/javascript">
     var mode = document.getElementById("mode").value;

     if(mode=='Online'){
            document.getElementById("refernce").style.display= "block" ;
            document.getElementById("ref_lable").style.display= "block" ;
            document.getElementById("refernce").required = true;
     }

     $('select').on('change', function() {

         if(this.value == "Online"){
            document.getElementById("refernce").style.display= "block" ;
            document.getElementById("ref_lable").style.display= "block" ;
            document.getElementById("refernce").required = true;

         }
         else if(this.value == "Cash"){
            document.getElementById("refernce").style.display= "none" ;
            document.getElementById("ref_lable").style.display= "none" ;
            document.getElementById("refernce").required = false;
            document.getElementById('refernce').value='';
         }
   
     });

</script>



@endsection