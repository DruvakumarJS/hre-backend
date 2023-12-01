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
            <label class="label-bold" id="div1">Customers / Clients</label>
          @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2)  
         <div id="div2">
           <a class="btn btn-light btn-outline-secondary" href="{{route('add_vendor')}}"><i class="fa fa-plus"></i>
             <label id="modal">Add Vendor</label></a>   
         </div>

          <div id="div2" style="margin-right: 30px" >
            <a data-bs-toggle="modal" data-bs-target="#importModal"  class="btn btn-light btn-outline-secondary" href=""><label id="modal">Download CSV</label></a>
          </div>
          @endif

          

          <div id="div2" style="margin-right: 30px">
           <form method="POST" action="">
            @csrf
            <input type="hidden" name="search" value="">
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search here" value="">
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
                              <td>{{$value->vid_id}}</td>
                              <td>{{$value->billing_name}}</td>
                              <td>{{$value->vendor_type}}</td>
                              <td>{{$value->building}}</td>
                              <td>{{$value->location}} / {{$value->area}}</td>
                              <td>{{$value->city}}</td>
                              <td>{{$value->state}}</td>
                              <td>{{$value->owner}}</td>
                              <td>{{$value->mobile}}</td>
                              <td>{{$value->email}}</td>
                              <td>
                                <a href="{{ route('edit_vendor',$value->id)}}"><button class="btn btn-sm btn-light btn-outline-secondary">Edit</button></a>
                              </td>
                            </tr>

                            @endforeach
                          	
                            
                          </tbody>
                        </table>

                         
                        
                    </div>
    		
    	</div>
    	
    </div>
  </div>
</div>

@endsection