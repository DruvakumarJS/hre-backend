@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Materials</label>
           
          <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('materials_master')}}"></i> View Category</a>
            
          </div>

           <div id="div2" style="margin-right: 30px" >
            <a data-bs-toggle="modal" data-bs-target="#importModal"  class="btn btn-light btn-outline-secondary" href=""><label id="modal">Import</label></a>
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


<!-- Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Materials from Excel sheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('import_material') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <div class="custom-file text-left">
                            <input type="file" name="file" class="custom-file-input" id="customFile">
                           
                        </div>
                    </div>
                    <button class="btn btn-primary">Import</button>
                    
                </form>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->
@endsection