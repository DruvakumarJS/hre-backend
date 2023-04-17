@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

    	 <div >
	    	 	<label>Intend Number</label>
	    	 	<div>
	    	 		<label class="label-bolder">{{$id}}</label>
	    	 	</div>
	            
             </div>

         <div style="margin-top: 50px">
        	<label style="margin-left: 20px">Material List</label>

        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Sl.no</th>
                              <th scope="col">material_id</th>
                              <th scope="col">Material Name</th>
                              <th scope="col">Brand</th>
                              <th scope="col">Information</th>
                              <th scope="col">description</th>                          
                              <th scope="col">quantity</th>
                              <th scope="col">recieved</th>
                              <th scope="col">pending</th>
                              <th scope="col">status</th>
                              <th scope="col">Action</th>
             
                            </tr>
                          </thead>
                          <tbody>
                          	@foreach($indents_list as $key => $value)
                             <tr>
                             	<td>{{$key+1}}</td>
                             	<td>{{$value->material_id}}</td>
                             	<td>{{$value->materials->name}}</td>
                              <td>{{$value->materials->brand}}</td>
                              <td>
                                <table>
                                <tbody>
                                  @php
                                   $info = json_decode($value->materials->information);
                                  @endphp

                                  @foreach($info as $key => $val)

                                          <tr>
                                              <td>{{$key}} = {{$val}}</td>
                                          </tr>

                                  @endforeach
                                </tbody>
                              </table>
                              </td>
                             	<td>{{$value->decription}}</td>
                             	<td>{{$value->quantity}}</td>
                             	<td>{{$value->recieved}}</td>
                             	<td>{{$value->pending}}</td>
                             	<td>{{$value->status}}</td>
                             	<td>
                                <a href=""><i class="fa fa-edit"></i></a>
                             		
                             	</td>
                             </tr>

                          	@endforeach
                            
                            
                          </tbody>
                        </table>
                        
                    </div>
                    <!--</div>-->
                 </div>    
       
    </div>

  
</div>
@endsection