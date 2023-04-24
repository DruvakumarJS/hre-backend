@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
     <div class="row">

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

         <!-- <div class="col-md-2">
             <a href="{{route('export-indents',$id)}}"><button class="btn btn-light" > Download CSV</button></a>
          </div> -->
       


     </div>
    	

         <div style="margin-top: 50px">
        	<label style="margin-left: 20px">Material List</label>

        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Sl.no</th>
                              <th scope="col">Material_id</th>
                              <th scope="col">Material Name</th>
                              <th scope="col">Brand</th>
                              <th scope="col">Information</th>
                              <th scope="col">Description</th>                          
                              <th scope="col">Total Quantity</th>
                              <th scope="col">Delivered</th>
                              <th scope="col">Pending</th>
                              <th scope="col">Status</th>
                              <th scope="col">Action</th>
             
                            </tr>
                          </thead>
                          <tbody>
                          	@foreach($indents_list as $key => $value)
                             <tr>
                             	<td>{{$key + $indents_list->firstItem()}}</td>
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
                             	<td>{{$value->quantity}}</td>
                             	<td>{{$value->recieved}}</td>
                             	<td>{{$value->pending}}</td>
                             	<td>{{$value->status}}</td>
                             	<td>
                                <a href="{{route('edit_intends' , $value->id)}}"><i class="fa fa-edit"></i></a>
                             		
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
@endsection