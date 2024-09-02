@extends('layouts.app')

@section('content')
<style type="text/css">
  thead th {
 
  height: 50px;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
           
           <div id="div2">
            
             <a data-bs-toggle="modal" data-bs-target="#exampleModal"  class="btn btn-light btn-outline-secondary" href="">Set Closing Date</i> </a>
    
          </div>
        
        </div>

<!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set Financial Year Closing Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{route('save_acc_closure_date')}}">
                  @csrf
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Financial Year</label>
                    <input type="text" class="form-control" name="financial_year" value="<?php echo date("m") >= 4 ? date("Y"). '-' . (date("Y")+1) : (date("Y") - 1). '-' . date("Y");  ?>" required>
                  </div>

                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Financial Year Closing Date</label>
                     <input type="text" class="form-control" id="date" name="date" autocomplete="off" required>
                  </div>

          
                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Comments</label>
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



        <div>
        	<label class="label-bold" style="margin-left: 20px" >Financial Year Closing Details</label>

        	<div class="card border-white table-wrapper-scroll-y tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Financial Year</th>
                              <th scope="col">F.Y Closing Date</th>
                              <th scope="col">Comments</th>
                              <th >Action</th> 
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key=>$value)
                             <tr>
                               <td>{{$value->financial_year}}</td>
                               <td>{{date('d-m-Y',strtotime($value->yearend_date))}}</td>
                               <td>{{$value->comments}}</td>
                               <td>
                                  <a id="MybtnModal_{{$key}}" data-id="{{$value->category}}"> <button class="btn btn-light curved-text-button btn-sm">Edit</button></i></a>

                                @if(auth::user()->role_id == 1)
                                  @if($value->isactive == 'true' )
                                  <a onclick="return confirm('You are disabling freeze date ')" href="{{route('disable_freezedate',$value->id)}}" > <button class="btn btn-danger btn-sm" >Disable</button></i></a>

                                  @else
                                  <a onclick="return confirm('You are activating freeze date ')" href="{{route('enable_freezedate',$value->id)}}" > <button class="btn btn-success btn-sm" >Enable</button></i></a>

                                  @endif
                                @endif 
                                  
                               </td> 
                             </tr>

                             <!-- Modal -->

                              <div class="modal" id="modal_{{$key}}" >
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Edit Material Category</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="post" action="{{route('update_acc_closure_date',$value->id)}}">
                                          @method('PUT')
                                          @csrf

                                          <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Financial Year</label>
                                            <input type="text" class="form-control" name="financial_year" value="{{$value->financial_year}}" readonly>
                                          </div>

                                          <div class="mb-3">
                                            <label for="message-text" class="col-form-label">Accounts Closure Date</label>
                                             <input type="text" class="form-control" id="date{{$key}}" name="date" required value="{{$value->yearend_date}}">
                                          </div>

                                  
                                          <div class="mb-3">
                                            <label for="message-text" class="col-form-label">Comments</label>
                                            <textarea class="form-control" id="desc" name="desc" >{{$value->comments}}</textarea>
                                          </div>

                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Update</button>
                                          </div>
                                        </form>
                                      </div>
                                      </div>
                                    </div>
                                  </div>

                        <!--  end Modal -->

                                 <script>
                                    $(document).ready(function(){
                                      $('#MybtnModal_{{$key}}').click(function(){
                                        $('#modal_{{$key}}').modal('show');
                                      });
                                    });  

                                    $( function() {
                                          $( "#date{{$key}}" ).datepicker({
                                            //minDate:0,
                                            dateFormat: 'dd-mm-yy',
                                            onSelect: function(dateText, $el) {
                                             
                                        }
                                      });
                                    });   
                                </script>
                            @endforeach
                            
                          </tbody>
                        </table>

                         <label>Showing {{ $data->firstItem() }} to {{ $data->lastItem() }}
                                    of {{$data->total()}} results</label>

                                {!! $data->links('pagination::bootstrap-4') !!}
                        
                    </div>
                    <!--</div>-->
                 </div>
        </div>	
    </div>

   
</div>




<script type="text/javascript">
 
      $( "#date" ).datepicker({
        //minDate:0,
        dateFormat: 'dd-mm-yy',
        onSelect: function(dateText, $el) {
         
        }
      });
          
</script>








@endsection