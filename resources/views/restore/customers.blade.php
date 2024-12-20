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

      <label>Customers</label>

     
        <div class="col-md-3">
          <!-- <a href="{{route('restore-customers','customer')}}"><button class="btn btn-sm btn-light btn-outline-secondary">Customers</button></a>
           -->
        </div>

         
      </div>
 
     <div class="page-container">
      <div class="card border-white table-wrapper-scroll-y tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Date</th>
                              <th scope="col">Customer Name</th>
                              <th scope="col">Brand</th>
                              <th scope="col">Email</th>
                              <th scope="col">Mobile</th>
                              <!-- <th scope="col" width="200px">Address</th> -->
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            
                            @foreach($data as $key =>$value)

                            <tr>
                              <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                              <td>{{$value->name}}</td>
                              <td>{{$value->brand}}</td>
                              <td>{{$value->email}}</td>
                              <td>{{$value->mobile}}</td>
                             <!--  <td>
                                  @foreach($value->address as $key1 =>$value1)
                                     {{$key1+1}} : {{ $value1->area }} ,{{ $value1->city }} , {{ $value1->state }} <br>
                                  @endforeach
                                </td> -->
                              <td>
                                 <a onclick="return confirm('Are you sure to restore?')"  href="{{route('restore_customer',$value->id)}}"><button class="btn btn-light btn-sm btn-outline-success">Restore</button></a>
                               <!--  <a onclick="return confirm('Are you sure to delete?')" href="{{route('trash_customer', $value->id)}}"><button class="btn btn-light btn-outline-danger btn-sm">Delete</button></a> -->  
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
@endsection