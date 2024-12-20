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
            <label class="label-bold" id="div1">Materials</label>
          
        </div>


        <div class="page-container">
        
     
        	<div class="card border-white table-wrapper-scroll-y tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

                        <table class="table">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th scope="col">Material Id</th>
                              <th scope="col">Material Name</th>
                              <th scope="col">Make / Brand</th>
                              <th scope="col">UoM</th>
                              <th scope="col">Specifications</th>
                              
                              <th >Action</th>
                             
                             
                            </tr>
                          </thead>
                          <tbody>

                          @foreach($data as $key=>$value)
                            <tr>
                            <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>  
                              <td>{{$value->item_code}}</td>
                              <td>{{$value->name}}</td>
                              <td>{{$value->brand}}</td>
                              <td>{{$value->uom}}</td>
                              <td> <table>
                                <tbody>
                                  @php
                                   $info = json_decode($value->information);
                                  @endphp

                                  @foreach($info as $key => $val)
                                    
                                          <tr>
                                              <td>{{$key}} = {{$val}}</td>
                                          </tr>
                                     
                                  @endforeach
                                </tbody>
                              </table>
                            </td>
                              
                              <td>
                                  <a onclick="return confirm('Are you sure to restore?')" href="{{route('restore_material',$value->id)}}" > <button class="btn btn-light btn-outline-success btn-sm">Restore</button></a>   
                             
                                  <!-- <a onclick="return confirm('Are you sure to delete?')" href="{{route('trash_material',$value->id)}}" > <button class="btn btn-light btn-outline-danger btn-sm">Delete</button></a> -->   
                              </td>
                              
                            </tr>
                          
                          @endforeach   
                             
                          </tbody>
                        </table>
                         <label>Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{$data->total()}} results</label>

                                <div class="float">{!! $data->links('pagination::bootstrap-4') !!}</div>
                                       
                    </div>
                    <!--</div>-->
                 </div>
        </div>	
    </div>

   
</div>
@endsection