@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      
      <div class="container-header">
            <label class="label-bold" id="div1">Customers / Clients</label>
         <div id="div2">
           <a class="btn btn-light btn-outline-secondary" href="{{route('create_customer')}}"><i class="fa fa-plus"></i>
             <label id="modal">Create Customer</label></a>
              
         </div>
        @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
        @endif

    </div>
       

    </div>


    <div class="page-container">
    	<div class="div-margin">

    		 <div class="card border-white table-responsive" >

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Sl.No</th>
                              <th scope="col">Customer Name</th>
                              <th scope="col">Brand</th>
                              <th scope="col">Email</th>
                              <th scope="col">Mobile</th>
                              <th scope="col" width="200px">Address</th>
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            
                          	@foreach($customers as $key =>$value)

                            <tr>  
                               <td>{{$key + $customers->firstItem()}}</td>
                              <td>{{$value->name}}</td>
                              <td>{{$value->brand}}</td>
                              <td>{{$value->email}}</td>
                              <td>{{$value->mobile}}</td>
                              <td>
                                  @foreach($value->address as $key1 =>$value1)
                                     {{$key1+1}} : {{ $value1->area }} ,{{ $value1->city }} , {{ $value1->state }} <br>
                                  @endforeach
                                </td>
                              <td>
                              	 <a href="{{route('edit_customer',$value->id)}}"><button class="btn btn-light btn-sm curved-text-button">Edit</button></a>
                                <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_customer', $value->id)}}"><button class="btn btn-light btn-outline-danger btn-sm">Delete</button></a>  
                              </td>
                            </tr>
                            @endforeach
                            
                          </tbody>
                        </table>

                         <label>Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }}
                                    of {{$customers->total()}} results</label>

                                {!! $customers->links('pagination::bootstrap-4') !!}
                        
                    </div>
    		
    	</div>
    	
    </div>
  </div>
</div>
@endsection