@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            
        
        <div class="container-header">
            <label class="label-bold" id="div1">Indent Details </label>
            <div id="div2">
                <a href="{{route('indent_details',$indend_data->indent->indent_no)}}"><button class="btn btn0sm btn-outline-secondary">Back to Indents</button></a>
                
            </div>
         
        </div>

        <div class="div-margin">
            <div class="HeadCounter">
                <div class="row">
                    <div class="col">
                        <label>Indent Number</label>
                        <h3 class="label-bold">{{$indend_data->indent->indent_no}}</h3>
                    </div>
                    <div class="col">
                        <label>PCN</label>
                        <h3 class="label-bold">{{$indend_data->indent->pcn}}</h3>
                    </div>
                    <div class="col">
                        <label>Dispatched</label>
                        <h3 class="label-bold">{{$total_dispatch}} {{$indend_data->materials->uom}}</h3>
                        <label></label>
                    </div>
                    <div class="col">
                        <label>Pending</label>
                        <h3 class="label-bold">{{$indend_data->pending}} {{$indend_data->materials->uom}}</h3>
                    </div>
                    <div class="col">
                        <label>Accepted</label>
                        <h3 class="label-bold">{{$indend_data->recieved}} {{$indend_data->materials->uom}}</h3>
                    </div>
                </div>
            </div>



            <div class="row" style="margin-top: 20px">
                <div class="card border-white col-md-4">
                    <div>
                        <label>Material Category</label>
                        <div>
                            <label class="label-bold">{{$indend_data->materials->Category->category}}</label>
                        </div>
                    </div>

                    <div style="margin-top: 20px">
                        <label>Material Id</label>
                        <div>
                            <label class="label-bold">{{$indend_data->material_id}}</label>
                        </div>
                    </div>

                    <div style="margin-top: 20px">
                        <label>Material Name</label>
                        <div>
                            <label class="label-bold">{{$indend_data->materials->name}}</label>
                        </div>
                    </div>

                    <div style="margin-top: 20px">
                        <label>Brand Name</label>
                        <div>
                            <label class="label-bold">{{$indend_data->materials->brand}}</label>
                        </div>
                    </div>

                    <div style="margin-top: 20px">
                        <label>Material Specifications</label>
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

                    <div style="margin-top: 20px">
                        <label>Created Date</label>
                        <div>
                            <label class="label-bold">{{date('d-m-Y H:i' ,strtotime($indend_data->created_at))}}</label>
                        </div>
                    </div>

                </div>
                <div class=" col-md-8 div-margin">
                    <div style="margin-left: 20px">

                    @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2' || Auth::user()->roles->team_id == 5 )
                     @if($indend_data->pending > 0 && $indend_data->indent->status == 'Active')
                    
                        <form id="form" method="post" action="{{route('update_quantity')}}">
                            @csrf
                            <div class="form-group row">
                               
                                <label for="text" class="col-3 col-form-label">Quantity Dispatched </label>
                               
                                <div class="col-3">
                                    <input id="text" type="Number" class="form-control" placeholder="Enter numbers"
                                           name="quantity" required="required" min="1" max="<?php echo $indend_data->pending-$dispatched ;?>" value="{{old('quantity')}}">
                                </div>

                                <div class="col-3">
                                    <input type="text" class="form-control" name="dispatch_comment" placeholder="Enter Dispatch Coments" required>
                                </div>
                                <input type="hidden" name="indent_no" value="{{$indend_data->indent->indent_no}}">
                                <input type="hidden" name="category" value="{{$indend_data->materials->Category->category}}">
                                <input type="hidden" name="pcn" value="{{$indend_data->indent->pcn}}">
                                <input type="hidden" name="id" value="{{$id}}">
                                <input type="hidden" name="pending" value="{{$indend_data->pending}}">
                                <div class="col-md-3">
                                    <button class="btn btn-danger" id="submit">Submit</button>
                                </div>
                            </div>

                        </form>
                        @endif
                       
                        @endif 

                        @if(Session::has('message'))
                            <p id="mydiv" class="text-danger text-center div-margin">{{ Session::get('message') }}</p>
                        @endif


                        <label class="label-bolder div-margin">Recent Updates</label>
                        @if($indend_data->indent->status != 'Active')
                         <label style="color: red">( This Indent is Settled )</label>
                        @endif

                        <div class="card">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>GRN</th>
                                <th>D_Comments</th>
                                <th>GRN Status</th>
                                <th>Dispatched</th>
                                <th>Accepted</th>
                                <th>Rejected</th>
                                <th>Comments</th>
                                <th>D_Date</th>
                                <th></th>
                            </tr>
                            </thead>
                        @foreach($grn as $key =>$value)
                                <tr>
                                    <td>{{$value->grn}}</td>
                                    <td>{{$value->dispatch_comment}}</td>
                                    <td>{{$value->status}}</td>
                                    <td>{{$value->dispatched}}</td>
                                    <td>{{$value->approved}} </td>
                                    <td>{{$value->damaged}} </td>
                                    <td>{{$value->comment}}</td>
                                    <td>{{date('d-m-Y H:i' ,strtotime($value->created_at))}}</td>
                                    <td>
                                        @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2' || Auth::user()->role_id == '10')
                                        @if($value->status == 'Awaiting for Confirmation' && $indend_data->indent->status == 'Active') 
                                        <a id="MybtnModal_{{$key}}"><button class="btn btn-sm btn-outline-secondary">Edit</button></a>
                                        @endif
                                        @endif
                                    </td>
                                </tr>

                                <!--  Modal -->
                                        <div class="modal fade" id="modal_{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Dispatch Quantity - {{$value->grn}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                <form method="POST" action="{{ route('edit_quantity') }}" >
                                                    @csrf

                                                   <label for="text" >Quantity Dispatched </label>

                                                    <input id="text" type="Number" class="form-control" placeholder="Enter numbers"
                                                     name="quantity" required="required" min="1" max="{{$indend_data->pending-$dispatched+$value->dispatched }}" value="{{$value->dispatched}}"  style="width:150px" >
                                                    
                                                    <div style="margin-top: 20px">
                                                        <input type="text" class="form-control" name="dispatch_comment" placeholder="Enter Dispatch Coments" value="{{$value->dispatch_comment}}" required>
                                                    </div>
                                                      
                                                    <input type="hidden" name="indent_no" value="{{$indend_data->indent->indent_no}}">
                                                    <input type="hidden" name="pcn" value="{{$indend_data->indent->pcn}}">
                                                    <input type="hidden" name="id" value="{{$id}}">
                                                    <input type="hidden" name="grn" value="{{$value->grn}}">
                                                    <input type="hidden" name="pending" value="{{$indend_data->pending}}">
                                                    <button class="btn btn-outline-success div-margin">Update</button>
                                                   
                                                    
                                                </form>
                                              </div>
                                              
                                            </div>
                                          </div>
                                        </div>
                                <!-- Modal -->
                                <script>
                                $(document).ready(function(){
                                  $('#MybtnModal_{{$key}}').click(function(){
                                    $('#modal_{{$key}}').modal('show');
                                  });
                                });  
                                </script>

                        @endforeach
                        </table>
                        </div>
                    </div>
                </div>
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
