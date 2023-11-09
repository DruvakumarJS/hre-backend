@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
     <!-- <div class="row">

       <div class="col-md-2">
          <label>Intend Number</label>
          <div>
            <label class="label-bolder">{{$id}}</label>
          </div>
              
        </div>

        <div class="col-md-2">
          <label>PCN</label>
          <div>
            <label class="label-bolder">{{$pcn}}</label>
          </div>
              
        </div>

     </div> -->


      <div class="container-header">
        <div id="div1">
          
            <div>
              <label class="label-bolder">{{$id}}</label>
            </div>
             <label>Indent Number</label>
          
        </div>
           
        <div id="div1" style="margin-left: 30px">
           
            <div>
             <label class="label-bolder">{{$pcn}}</label>
            </div>
            <label>Project Code Number</label>
          
        </div>
             
           <div id="div2">
            <a href="{{route('intends')}}"><button class="btn btn-light btn-outline-secondary" >View Indents</button></a>
          </div>
          
          @if(Auth::user()->role_id == '1' or Auth::user()->role_id == '2')
            <div id="div2" style="margin-right: 30px">
              <a data-bs-toggle="modal" data-bs-target="#triggerModal"  class="btn btn-light btn-outline-secondary" href="" title="<?php echo ($indents->settlement_triggerd == 'YES')? $indents->trigger_comments.'-'.$indents->commentor->employee_id:''  ?>"><label id="modal">Trigger settlement</label></a>

            </div>
          @endif
          
          @if(Auth::user()->role_id == '3' AND $indents->settlement_triggerd == 'YES')
            <div id="div2" style="margin-right: 30px">
              <button class="btn btn-light btn-outline-secondary" title="<?php echo ($indents->settlement_triggerd == 'YES')? $indents->trigger_comments.'-'.$indents->commentor->employee_id:''  ?>" >settlement Comments</button>
            </div>
          @endif


           @if( (Auth::user()->role_id == '1' or Auth::user()->role_id == '3') AND $indents->settlement_triggerd == 'YES')
            <div id="div2" style="margin-right: 30px">
              <a data-bs-toggle="modal" data-bs-target="#settlementModal"  class="btn btn-light btn-outline-secondary" href="" title="<?php echo ($indents->indent_settled == 'YES')? $indents->settled_comments.'-'.$indents->settler->employee_id:''  ?>" ><label id="modal">Indent Settled </label></a> 
            </div>
          @endif
        

        </div>
    	

         <div style="margin-top: 50px">
        	<label class="label-bold" style="margin-left: 20px">Material List</label>

        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Date</th>
                              <th scope="col">Material_id</th>
                              <th scope="col">Material Name</th>
                              <th scope="col">Brand</th>
                              <th scope="col">Information</th>
                              <th scope="col">Description</th>                          
                              <th scope="col">Total Indent</th>
                              <th scope="col">Total GRN</th>
                              <th scope="col">Total Dispatch</th>
                              <th scope="col">Pending</th>
                              <th scope="col">Status</th>
                              <th scope="col">Action</th>
             
                            </tr>
                          </thead>
                          <tbody>
                          	@foreach($indents_list as $key => $value)
                             <tr>
                             	<td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                             	<td>{{$value->material_id}}</td>
                             	<td>{{$value->materials->name}}</td>
                              <td>{{$value->materials->brand}}</td>
                              <td>
                                <table>
                                <tbody>
                                  @php
                                   $info = json_decode($value->materials->information);
                                  @endphp

                                  @foreach($info as $key => $val)

                                          <tr>
                                              <td>{{$key}} = {{$val}}</td>
                                          </tr>

                                  @endforeach
                                </tbody>
                              </table>
                              </td>
                             	<td>{{$value->decription}}</td>
                             	<td>{{$value->quantity}} {{$value->materials->uom}}</td>
                             	<td>{{$value->recieved}} {{$value->materials->uom}}</td>
                              <td>{{$value->grns_sum_dispatched}} {{$value->materials->uom}}</td>
                             	<td>{{$value->pending}} {{$value->materials->uom}}</td>
                             	<td>{{$value->status}}</td>
                             	<td>
                                <a href="{{route('edit_intends' , $value->id)}}"><button class="btn btn-light curved-text-button btn-sm">
                                  <?php echo ((Auth::user()->role_id == '3') ||(Auth::user()->role_id == '1')) ? 'Dispatch' : 'View' ?></button>
                                </a>
                             		
                             	</td>
                             </tr>

                          	@endforeach
                            
                            
                          </tbody>
                        </table>

                        <label>Showing {{ $indents_list->firstItem() }} to {{ $indents_list->lastItem() }}
                                    of {{$indents_list->total()}} results</label>

                                {!! $indents_list->links('pagination::bootstrap-4') !!}
                        
                    </div>
                    <!--</div>-->
                 </div>    
       
    </div>

  
</div>

<!-- trigger Modal -->
        <div class="modal fade" id="triggerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Trigger for Indent Settlement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{route('trigger_settlement')}}">
                  @csrf
                  
                  <input type="hidden" name="indent_no" value="{{$id}}">

                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Add your Comments</label>
                    <textarea class="form-control" id="comment" name="comment" ></textarea>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Trigger</button>
                  </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->

<!-- settlement Modal -->
        <div class="modal fade" id="settlementModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Indent Settlement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{route('settle_indent')}}">
                  @csrf
                  
                  <input type="hidden" name="indent_no" value="{{$id}}">

                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Add your Comments</label>
                    <textarea class="form-control" id="comment" name="comment" ></textarea>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Settle</button>
                  </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->
@endsection