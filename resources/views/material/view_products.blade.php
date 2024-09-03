@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Materials</label>
          
         @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2 OR auth::user()->role_id == 10 OR auth::user()->role_id == 11)
          <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('add_product',$id)}}"><i class="fa fa-plus"></i> Create Material</a>
          </div>
          @endif

          <div id="div2" style="margin-right: 30px">
             <a  class="btn btn-light btn-outline-secondary" href="{{route('materials_master')}}"> View Category</a>
          </div>

          
          <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('search_product')}}">
            @csrf
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search here">
                <div class="input-group-prepend">
                   <input type="hidden" name="id" value={{$id}}>
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>

           <!-- <div id="div3" style="margin-right: 30px">
            <a href="{{route('export-materials',$id)}}"> <button class="btn btn-light btn-outline-secondary" > Download CSV</button></a>
            
          </div> -->

   </div>


          <label class="label-bold">Category : {{$category}}</label>
          <div>
             <label class="label-bold">Category Code : {{$material_category}}</label>
          </div>

          <div class="page-container">
        	<div class="card border-white table-wrapper-scroll-y">

                        <table class="table">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th scope="col">Material Id</th>
                              <th scope="col">Material Name</th>
                              <th scope="col">Make / Brand</th>
                              <th scope="col">UoM</th>
                              <th scope="col">Specifications</th>
                              <th></th>
                            </tr>
                          </thead>

                          <tbody>
                          @foreach($MaterialList as $key=>$value)
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
                               @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2)
                                 <td>
                                    <a href="{{route('edit_product',$value->item_code)}}" > <i class='fa fa-edit' style='font-size:24px;color:blue;'></i></a>
                                </td>

                                <td >
                                    <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_product',$value->id)}}" > <i class='fa fa-trash' style='font-size:24px;color:red;'></i></a>

                                </td>
                               @endif
                            </tr>

                          @endforeach

                          </tbody>
                        </table>

                        <label>Showing {{ $MaterialList->firstItem() }} to {{ $MaterialList->lastItem() }}
                                    of {{$MaterialList->total()}} results</label>

                                 <div class="float">{!! $MaterialList->links('pagination::bootstrap-4') !!}</div>

                    </div>
                    <!--</div>-->
                 </div>
        </div>
    </div>


</div>
@endsection
