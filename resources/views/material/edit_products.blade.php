@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Materials</label>
           
          <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light" href=""><i class="fa fa-plus"></i> Create Material</a>
            
          </div>

          <div id="div2" style="margin-right: 30px">
             <a  class="btn btn-light" href="{{route('materials_master')}}"></i> View Category</a>
          </div>

           <div id="div3" style="margin-right: 30px">
             <button class="btn btn-light" > Download CSV</button>
          </div>

            
        </div>


        <div style="margin-top: 50px">
        

          <label class="label-bold">Category : {{$category}}</label>
          <div>
             <label class="label-bold">Material Category : {{$material_category}}</label>

          </div>
         

        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Material Id</th>
                              <th scope="col">Material Name</th>
                              <th scope="col">Make / Brand</th>
                              <th scope="col">Size</th>
                              <th scope="col">Thickness</th>
                              <th scope="col">Grade</th>
                              <th scope="col">Shade No</th>
                              <th scope="col">Unit</th>
                              <th ></th>
                             
                            </tr>
                          </thead>
                          <tbody>

                          @foreach($MaterialList as $key=>$value)
                            <tr>  
                              <td>{{$value->item_code}}</td>
                              <td>{{$value->name}}</td>
                              <td>{{$value->brand}}</td>
                              <td>{{$value->size}}</td>
                              <td>{{$value->thickness}}</td>
                              <td>{{$value->grade}}</td>
                              <td>{{$value->shade_no}}</td>
                              <td>{{$value->unit}}</td>
                               <td>
                                  <a href="" > <i class='fa fa-edit' style='font-size:24px;color:blue;'></i></a>   
                              </td>

                              <td >
                                  <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_product',$value->id)}}" > <i class='fa fa-trash' style='font-size:24px;color:red;'></i></a>
     
                              </td>
                              
                            </tr>
                          
                          @endforeach   
                             
                          </tbody>
                        </table>
                        @if(sizeof($MaterialList)>0)
                        <label>Showing {{ $MaterialList->firstItem() }} to {{ $MaterialList->lastItem() }}
                                    of {{$MaterialList->total()}} results</label>

                                {!! $MaterialList->links() !!}
                        @endif
                    </div>
                    <!--</div>-->
                 </div>
        </div>	
    </div>

   
</div>
@endsection