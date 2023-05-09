@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Materials</label>
           
          <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('materials_master')}}"></i> View Category</a>
            
          </div>

           <div id="div3" style="margin-right: 30px">
             <a href="{{route('export-materials','all')}}"><button class="btn btn-light btn-outline-secondary" > Download CSV</button></a>
          </div>

            
        </div>


        <div>
        

        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th>Sl.no</th>
                              <th scope="col">Material Id</th>
                              <th scope="col">Material Name</th>
                              <th scope="col">Make / Brand</th>
                              <th scope="col">UoM</th>
                              <th scope="col">Specifications</th>
                              
                              <th >Action</th>
                             
                             
                            </tr>
                          </thead>
                          <tbody>

                          @foreach($MaterialList as $key=>$value)
                            <tr>
                            <td>{{$key + $MaterialList->firstItem()}}</td>  
                              <td>{{$value->item_code}}</td>
                              <td>{{$value->name}}</td>
                              <td>{{$value->brand}}</td>
                              <td>{{$value->uom}}</td>
                              <td>Action <table>
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
                                  <a href="{{route('edit_product',$value->item_code)}}" > <button class="btn btn-light curved-text-button btn-sm">Edit</button></i></a>   
                             
                                  <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_product',$value->id)}}" > <button class="btn btn-light btn-outline-danger btn-sm">Delete</button></a>   
                              </td>
                              
                            </tr>
                          
                          @endforeach   
                             
                          </tbody>
                        </table>
                         <label>Showing {{ $MaterialList->firstItem() }} to {{ $MaterialList->lastItem() }} of {{$MaterialList->total()}} results</label>

                                {!! $MaterialList->links('pagination::bootstrap-4') !!}
                                       
                    </div>
                    <!--</div>-->
                 </div>
        </div>	
    </div>

   
</div>
@endsection