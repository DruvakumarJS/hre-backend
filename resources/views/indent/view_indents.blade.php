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
          
          @if(Auth::user()->role_id == '1')
            <div id="div2" style="margin-right: 30px">
              <a onclick="return confirm('Further Dispatch will be restricted to this Indent number and it will be marked as Completed.')" href="{{route('update_indent_status',$id)}}"><button class="btn btn-light btn-outline-secondary">Mark as Complete</button></a>
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
                              <th scope="col">Total Quantity</th>
                              <th scope="col">GRN</th>
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
@endsection