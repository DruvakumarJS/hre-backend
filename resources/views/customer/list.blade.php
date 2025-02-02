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
            <label class="label-bold" id="div1">Customers / Clients</label>
          @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2)  
         <div id="div2">
           <a class="btn btn-light btn-outline-secondary" href="{{route('create_customer')}}"><i class="fa fa-plus"></i>
             <label id="modal">Create Customer</label></a>   
         </div>

          <div id="div2" style="margin-right: 30px" >
            <a data-bs-toggle="modal" data-bs-target="#importModal"  class="btn btn-light btn-outline-secondary" href=""><label id="modal">Import Customer</label></a>
          </div>
          @endif

          

          <div id="div2" style="margin-right: 30px">
           <form method="GET" action="{{route('search_customer')}}">
            @csrf
            <input type="hidden" name="search" value="{{$search}}">
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search here" value="{{$search}}">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>

          @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2 OR Auth::user()->role_id == 6 OR Auth::user()->role_id == 7)
          <div id="div2" style="margin-right: 30px" >
           <!--  <a href="{{route('export_customer',$search)}}" class="btn btn-light btn-outline-secondary" href=""><label >Download CSV</label></a> -->
            <form method="POST" action="{{route('export_customer')}}">
            @csrf
            <input type="hidden" name="search" value="{{$search}}">
             <div class="input-group mb-3">
            
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary" type="submit" >Download CSV</button>
                </div>
              </div>
           </form>
          </div>

          @endif

        @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
        @endif

    </div>
       

    </div>


    <div class="page-container">
    	<div class="div-margin">

    		 <div class="card border-white table-wrapper-scroll-y tableFixHead " style="height: 600px; padding: 0px 5px 20px 20px">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Customer ID</th>
                              <th scope="col">Creation Date</th>
                              <th scope="col">Billing Name</th>
                              <th scope="col">Contact person</th>
                              <th scope="col">Designation</th>
                              <th scope="col">Mobile</th>
                              <th scope="col">Email</th>
                              <!-- <th scope="col" width="200px">Address</th> -->
                              <th scope="col"></th>
                              <th scope="col"></th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            
                          	@foreach($customers as $key =>$value)

                            <tr>
                              <th>MAC{{$value->id}}</th>
                              <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                              <td width="300px">{{$value->name}}</td>
                              <td>{{$value->full_name}}</td>
                              <td>{{$value->designation}}</td>
                              <td>{{$value->mobile}}</td>
                              <td>{{$value->email}}</td>
                              
                             <!--  <td>
                                  @foreach($value->address as $key1 =>$value1)
                                     {{$key1+1}} : {{ $value1->area }} ,{{ $value1->city }} , {{ $value1->state }} <br>
                                  @endforeach
                                </td> -->
                             
                                <td>
                                   @if(Auth::user()->role_id == '1' OR Auth::user()->role_id == '2')
                                	  <a href="{{route('edit_customer',$value->id)}}"><button class="btn btn-light btn-sm curved-text-button">Edit</button></a>
                                   @endif
                                </td>
                                <td>
                                  @if(Auth::user()->role_id == '1')
                                   <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_customer', $value->id)}}"><button class="btn btn-light btn-outline-danger btn-sm">Delete</button></a> 
                                  @endif 
                                </td>
                             
                            </tr>
                            @endforeach
                            
                          </tbody>
                        </table>

                         <label>Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }}
                                    of {{$customers->total()}} results</label>
                                    <div class="float">{!! $customers->links('pagination::bootstrap-4') !!}</div>
                         
                    </div>
    		
    	</div>
    	
    </div>
  </div>
</div>

<!-- Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Customers from Excel sheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('import_customer') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <div class="custom-file text-left">
                            <input type="file" name="file" class="custom-file-input" id="customFile">
                           
                        </div>
                    </div>
                    <button class="btn btn-danger">Import</button>
                    
                </form>

                    <div id="div2">
                       <a target="_blank" href="{{ URL::to('/') }}/templates/HRE_Customers_Template.xlsx" ><button class="btn btn-sm btn-light">Download Template</button></a>
                    </div>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->
@endsection