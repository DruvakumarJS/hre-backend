@extends('layouts.app')

@section('content')
<style type="text/css">
  thead th {
 
  height: 50px;
}
</style>
<div class="container-fluid">
  <div class="row justify-content-center">
	 <div class="container-header">
            <label class="label-bold" id="div1">GRNs</label>

            <div id="div2" style="margin-left: 30px">
              <a href="{{route('intends')}}"><button class="btn btn-light btn-outline-secondary" > View Indents </button></a>
            </div>

        
            <div id="div2" style="margin-right: 30px">
           <form method="GET" action="{{route('search_deligation_grn')}}">
            @csrf
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search GRN here" value="{{$search}}">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>
      
    </div>

    <div class="page-container">
        <div class="div-margin">
            
            <div class="card border-white scroll tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Creation Date</th>  
                              <th scope="col">GRN</th>
                              <th scope="col">PCN</th>
                              <th scope="col">Indent No</th>
                              <th scope="col">GRN owner</th>
                              <th scope="col">Delegated To</th>
                              <th scope="col">Deleigate</th>
                            </tr>
                          </thead>
                          @foreach($grns as $key=>$value)
                             <tr>
                               <td>{{date('Y-m-d',strtotime($value->created_at))}}</td>
                               <td>{{$value->grn}}</td>
                               <td>{{$value->pcn}}</td>
                               <td>{{$value->indent_no}}</td>
                               <td>{{$value->user->name}} - {{$value->user->employee_id}}</td>
                               <td> {{ ($value->delegated_id == '')?'':$value->deligatee->name .' - '.$value->deligatee->employee_id}}</td>
                               <td>
                                <a id="MybtnModal_{{$key}}"  ><button class="btn btn-sm btn-warning text-white">Delegate</button></a>
                               </td>
                             </tr>

                              <!-- Modal -->

                              <div class="modal" id="modal_{{$key}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Delegate GRN</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="post" id="form" action="{{route('deligate_grn')}}">
                                        @csrf
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">GRN</label>
                                          <input type="text" class="form-control" id="grn" name="grn" value="{{$value->grn}}" readonly required>
                                        </div>

                                         <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">Employee </label>
                                          <select class="form-control form-select" name="user_id">
                                             <option>Select Employee</option>
                                             @foreach($employee as $keys=>$val)
                                               <option value="{{$val->user_id}}">{{$val->name}} - {{$val->employee_id}}</option>
                                             @endforeach  
                                          </select>
                                        </div>
                                       <input type="hidden" name="grn_id" value="{{$value->id}}">

                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                          <button type="submit" class="btn btn-danger" id="submit">Submit</button>
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
                          </script>
                          @endforeach                         
                            
                         
                        </table>

                        <label>Showing {{ $grns->firstItem() }} to {{ $grns->lastItem() }}
                                    of {{$grns->total()}} results</label>

                        <div class="float">{!! $grns->appends('abc')->links('pagination::bootstrap-4') !!}</div>
                        
                        
                    </div>
                    <!--</div>-->
                 </div>
        </div>
    </div> 
</div>	

<script>
$(document).ready(function() {
    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');
    });
});
</script>

@endsection