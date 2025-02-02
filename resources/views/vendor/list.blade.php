@extends('layouts.app')

@section('content')
<style type="text/css">
  thead th {
 
  height: 50px;
}
</style>

<style type="text/css">
  td{
max-width: 150px;
overflow: hidden;
text-overflow: clip;
white-space: nowrap;
}

</style>

<div class="container-fluid">
    
      <div class="container-header">
            <label class="label-bold" id="div1">Vendors</label>
          @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2 OR Auth::user()->role_id == 6 OR Auth::user()->role_id == 7 OR Auth::user()->role_id == 10 OR Auth::user()->role_id == 11)  
         <div id="div2">
           <a class="btn btn-light btn-outline-secondary" href="{{route('add_vendor')}}"><i class="fa fa-plus"></i>
             <label id="modal">Add Vendor</label></a>   
         </div>

          <div id="div2" style="margin-right: 30px" >
            <a data-bs-toggle="modal" data-bs-target="#importModal"  class="btn btn-light btn-outline-secondary" href=""><label id="modal">Import Vendors</label></a>
          </div>

          <div id="div2" style="margin-right: 30px" >
             <form method="post" action="{{ route('export_vendors')}}">
              @csrf
              <input type="hidden" name="search" value="{{$search}}">

              <button class="btn btn-outline-secondary" type="submit">Download CSV</button>

             </form>
          </div>

          

          @endif

          

          <div id="div2" style="margin-right: 30px">
           <form method="GET" action="{{ route('search_vendor')}}">
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

          
        @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
        @endif

    </div>
    
    <div class="page-container">
    	
    		 <div class="card border-white table-wrapper-scroll-y tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

                        <table class="table table-responsive">
                          <thead>
                            <tr>
                              <th scope="col">VID</th>
                              <th scope="col">Billing Name</th>
                              <th scope="col">Vendor Type</th>
                              <th scope="col">Address</th>
                              <th scope="col">PAN</th>
                              <th scope="col">GST</th>
                              <th scope="col">Owner</th>
                              <th scope="col">Mobile / Email</th>
                              <!-- <th scope="col">Email</th> -->
                              <!-- <th scope="col" width="200px">Address</th> -->
                              <th scope="col">Action</th>
                              <!-- <th></th> -->
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key=>$value)
                            <tr>
                              <td>{{$value->vid}}</td>
                              <td>{{$value->billing_name}}</td>
                             <!--  <td>{{$value->vendor_type}}</td> -->
                               @php
                               if($value->vendor_type == 'Sub_Contractor' OR $value->vendor_type == 'Sub Contractor') $v_type = 'Sub Contractor' ;
                               if($value->vendor_type == 'Labour_Contractor' OR $value->vendor_type == 'Labour Contractor') $v_type = 'Labour Contractor' ;
                               if($value->vendor_type == 'Service_Provider' OR $value->vendor_type == 'Service Provider') $v_type = 'Service Provider' ;
                               if($value->vendor_type == 'material_supplier' OR $value->vendor_type == 'Material Supplier' OR $value->vendor_type == 'Material_Supplier') $v_type = 'Material Supplier' ;

                              @endphp

                              <td>{{$v_type}}</td>
                              <td  data-toggle="tooltip" data-placement="top"
                               title="{{$value->building}},{{$value->location}},{{$value->area}},{{$value->city}},{{$value->state}}">{{$value->building}},{{$value->location}},{{$value->area}},{{$value->city}},{{$value->state}}</td>
                             
                              <td>{{$value->pan}}</td>
                              <td>{{$value->gst}}</td>
                              <td>{{$value->owner}}</td>
                              <td  data-toggle="tooltip" data-placement="top"
                               title="{{$value->mobile}} - {{$value->email}}">{{$value->mobile}} - {{$value->email}}</td>
                              <!-- <td>{{$value->email}}</td> -->
                              <td>
                                @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2 OR Auth::user()->role_id == 6 OR Auth::user()->role_id == 10)
                                <a href="{{ route('edit_vendor',$value->id)}}"><button class="btn btn-sm btn-light btn-outline-secondary">Edit</button></a>
                                @endif

                                 @if(Auth::user()->role_id == 1 )
                                <a onclick="return confirm('You are deleting a Vendor ')" href="{{ route('delete_vendor',$value->id)}}"><button class="btn btn-sm btn-light btn-outline-danger">Delete</button></a>
                                @endif
                                
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

<!-- Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Vendor Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('import_vendors') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <div class="custom-file text-left">
                            <input type="file" name="file" class="custom-file-input" id="customFile" required>
                           
                        </div>
                    </div>
                    <button class="btn btn-danger">Import</button>
                    
                </form>

                    <div id="div2">
                       <a target="_blank" href="{{ URL::to('/') }}/templates/HRE-Vendor_template.csv" ><button class="btn btn-sm btn-light">Download Template</button></a>
                    </div>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->
@endsection