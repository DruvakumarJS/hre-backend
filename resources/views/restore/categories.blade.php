@extends('layouts.app')

@section('content')
<style type="text/css">
  thead th {
 
  height: 50px;
}
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <label class="label-bold">Restore & Recycle</label>
    </div>

    <div class="justify-content-center div-margin">

       <div class="page-container">
       <div class="row">
           <div class="col-md-12">
               <div class="users-list">
                   <div class="card border-white table-wrapper-scroll-y tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

                       <table class="table">
                           <thead>
                           <tr>
                                <th>Date</th>
                              <th scope="col">Category</th>
                              <th scope="col">Category Code</th>
                              
                              <th >Action</th>
                            
                           </tr>
                           </thead>
                           <tbody>
                            @foreach($data as $key => $value)
                               <tr>
                                    <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                                    <td>{{$value->category}}</td>
                                    <td>{{$value->material_category}}</td>
                                  
                                    <td>
                                      <a onclick="return confirm('Are you sure to restore?')"  onclick="return confirm('Are you sure to restore?')"  href="{{route('restore_category',$value->code)}}"><label class="btn btn-light btn-outline-success  btn-sm">Restore</label></a>
                                      <!-- <a onclick="return confirm('Are you sure to delete?')" href="{{route('trash_category',$value->code)}}"><label class="btn btn-light btn-outline-danger btn-sm">Delete</label></a>  -->  
                                    </td>
                               </tr>
                            @endforeach   

                           </tbody>
                       </table>
                       <label>Showing {{ $data->firstItem() }} to {{ $data->lastItem() }}
                                    of {{$data->total()}} results</label>

                                <div class="float">{!! $data->links('pagination::bootstrap-4') !!}</div>
                   </div>

               </div>
           </div>
       </div>
    </div>

      

      
    </div>

    
</div>
@endsection