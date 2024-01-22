@extends('layouts.app')

@section('content')
<style type="text/css">
  thead th {
 
  height: 50px;
}
</style>

<div class="container">
    <div class="row justify-content-center">
      
      <div class="container-header">
            <label class="label-bold" id="div1">Vendors</label>
          @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2 OR Auth::user()->role_id == 6 OR Auth::user()->role_id == 7 OR Auth::user()->role_id == 10 OR Auth::user()->role_id == 11)  
         <div id="div2">
           <a class="btn btn-light btn-outline-secondary" href="{{route('add_vendor')}}"><i class="fa fa-plus"></i>
             <label id="modal">Add Vendor</label></a>   
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
           <form method="POST" action="{{ route('search_vendor')}}">
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
       

    </div>


    <div class="page-container">
    	<div class="div-margin">

    		 <div class="card border-white scroll tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">VID</th>
                              <th scope="col">Billing Name</th>
                              <th scope="col">Vendor Type</th>
                              <th scope="col">Address</th>
                              <th scope="col">Location/Area</th>
                              <th scope="col">City</th>
                              <th scope="col">State</th>
                              <th scope="col">Owner</th>
                              <th scope="col">Mobile</th>
                              <th scope="col">Email</th>
                              <!-- <th scope="col" width="200px">Address</th> -->
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key=>$value)
                            <tr>
                              <td>{{$value->vid}}</td>
                              <td>{{$value->billing_name}}</td>
                              @php
                               if($value->vendor_type == Sub_Contractor) $v_type = Sub Contractor ;
                               if($value->vendor_type == Labour_Contractor) $v_type = Labour Contractor ;
                               if($value->vendor_type == Service_Provider) $v_type = Service Provider ;
                               if($value->vendor_type == material_supplier) $v_type = Material Supplier ;

                              @endphp
                              
                              <td>{{$v_type}}</td>
                              <td>{{$value->building}}</td>
                              <td>{{$value->location}} / {{$value->area}}</td>
                              <td>{{$value->city}}</td>
                              <td>{{$value->state}}</td>
                              <td>{{$value->owner}}</td>
                              <td>{{$value->mobile}}</td>
                              <td>{{$value->email}}</td>
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

                                {!! $data->links('pagination::bootstrap-4') !!}
                         
                        
                    </div>
    		
    	</div>
    	
    </div>
  </div>
</div>

@endsection