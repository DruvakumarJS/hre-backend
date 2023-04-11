@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      
      <div class="container-header">
            <label class="label-bold" id="div1">Customers / Clients</label>
         <div id="div2">
           <a class="btn btn-light" href="{{route('create_customer')}}"><i class="fa fa-plus"></i>
             <label id="modal">Create Customer</label></a>
              
         </div>

    </div>
       

    </div>


    <div class="page-container">
    	<div class="div-margin">

    		 <div class="card border-white" >

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Sl.No</th>
                              <th scope="col">Customer Name</th>
                              <th scope="col">Brand</th>
                              <th scope="col">Email</th>
                              <th scope="col">Mobile</th>
                              <th scope="col">Address</th>
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            
                          	@foreach($customers as $key =>$value)

                            <tr>  
                               <td>{{$key+1}}</td>
                              <td>{{$value->name}}</td>
                              <td>{{$value->brand}}</td>
                              <td>{{$value->email}}</td>
                              <td>{{$value->mobile}}</td>
                              <td>
                                  @foreach($value->address as $key1 =>$value1)
                                     #{{$key1+1}} : {{ $value1->area }} ,{{ $value1->city }} , {{ $value1->state }} <br>
                                  @endforeach
                                </td>
                              <td>
                              	 <a href=""><button class="btn btn-light btn-sm">Edit</button></a>
                                <a href=""><button class="btn btn-danger btn-sm">Delete</button></a>  
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