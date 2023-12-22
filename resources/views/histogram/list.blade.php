@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">Histogram</label>
           
         @if(Auth::user()->roles->team_id == 1 OR Auth::user()->roles->team_id == 2 OR Auth::user()->roles->team_id == 3 OR Auth::user()->roles->team_id == 4 OR (Auth::user()->roles->team_id == 5 AND Auth::user()->role_id == 10) )
          <div id="div2" style="margin-right: 30px">
             <a  href="{{route('new_histogram')}}"> <button class="btn btn-outline-secondary">Fill New Histogram</button></a>
          </div>
          @endif

          <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('search_histogram')}}">
            @csrf
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search here" value="{{$search}}">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>
           
        </div>

       <div class="page-container">
        <div class="div-margin">
        	

        	<div class="card border-white scroll tableFixHead" style="height: 270px; padding: 0px 5px 20px 20px">

                        <table class="table">
                          <thead>
                            <tr style="height: 50px">
                              <th scope="col">Histogram ID</th>
                              <th scope="col">PCN</th>
                              <th scope="col">Billing Name</th>
                              <th scope="col">Brand</th>
                              <th scope="col">location</th>
                              <th scope="col">Area</th>
                              <th scope="col">City</th>
                              <th scope="col">State</th>
                              <th scope="col">Action</th>
                          
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key=>$value)
                            <tr>
                              <td>PH{{$value->id}}</td>
                              <td>{{$value->pcn}}</td>
                              <td>{{$value->billing_name}}</td>
                              <td>{{$value->project_name}}</td>
                              <td>{{$value->location}}</td>
                              <td>{{$value->area}}</td>
                              <td>{{$value->city}}</td>
                              <td>{{$value->state}}</td>
                              <td>
                                @if(Auth::user()->roles->team_id == 1 OR Auth::user()->roles->team_id == 2 OR Auth::user()->roles->team_id == 3 OR Auth::user()->roles->team_id == 4 ) 
                                 <a href="{{ route('view_history',$value->id)}}"><button class="btn btn-sm btn-outline-secondary">View History</button></a>
                                 @endif

                                 @if(Auth::user()->roles->team_id == 1 OR Auth::user()->roles->team_id == 2 OR Auth::user()->roles->team_id == 3 OR Auth::user()->roles->team_id == 4 OR Auth::user()->roles->team_id == 5 OR Auth::user()->roles->team_id == 13 OR Auth::user()->roles->team_id == 14 OR Auth::user()->roles->team_id == 6 OR Auth::user()->roles->team_id == 7 OR Auth::user()->roles->team_id == 10 OR Auth::user()->roles->team_id == 11  ) 
                                  <a href="{{ route('update_form',$value->id)}}"><button class="btn btn-sm btn-outline-success">Update</button></a>
                                @endif
                              </td>
                              
                            </tr>

                            @endforeach
                             
                          </tbody>
                        </table>

                        
                        
                    </div>
                    <!--</div>-->
            
           
            <label class="label-bold">Pending Form</label>

            <!-- <div id="div3">
              <form method="post" action="{{ route('search_pending_forms')}}">
                 @csrf
                <input type="text" name="search2" >
                <button>Search</button>
              </form>
              
            </div> -->

            <div class="card border-white scroll tableFixHead" style="height: 270px; padding: 0px 5px 20px 20px">

                        <table class="table">
                          <thead>
                            <tr style="height: 50px">
                              
                              <th scope="col">Pending Form</th>
                              <th scope="col">Histogram ID</th>
                              <th scope="col">Billing Name</th>
                              <th scope="col">Brand Name</th>
                              <th scope="col">location</th>
                              <th scope="col">Area</th>
                              <th scope="col">City</th>
                              <th scope="col">State</th>
                              <th scope="col">Date</th>
                              <th scope="col">Submitted By</th>
                              
                             @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2 OR Auth::user()->role_id == 3 OR Auth::user()->role_id == 4 OR Auth::user()->role_id == 5 OR Auth::user()->role_id == 6 OR Auth::user()->role_id == 7) 
                              <th scope="col">Action</th>
                             @endif
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($histogram as $key=>$value)
                            <tr>
                              <td>{{$key+1}}</td>
                              <td>PH{{$value->id}}</td>
                              <td>{{$value->billing_name}}</td>
                              <td>{{$value->brand}}</td>
                              <td>{{$value->location}}</td>
                              <td>{{$value->area}}</td>
                              <td>{{$value->city}}</td>
                              <td>{{$value->state}}</td>
                              <td>{{$value->created_at}}</td>
                              <td>{{$value->user->name}}</td>
                              <td>
                                @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2 OR Auth::user()->role_id == 3 OR Auth::user()->role_id == 4 OR Auth::user()->role_id == 5 OR Auth::user()->role_id == 6 OR Auth::user()->role_id == 7)
                                <a href="{{ route('view_form',$value->id)}}"><button class="btn btn-sm btn-outline-secondary">View Form</button></a>
                                @endif

                                @if(auth::user()->id == $value->user_id)
                                 <a href="{{route('edit_my_form',$value->id)}}" ><button class="btn btn-sm btn-outline-success">Edit</button></a>
                                @endif

                                @if(auth::user()->role_id  == 1 OR auth::user()->role_id == 2)
                                 <a onclick="return confirm('You are deleting the Histogram request')"  href="{{ route('delete_histogram',$value->id)}}" ><button class="btn btn-sm btn-outline-danger">Delete</button></a>
                                @endif
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
</div>
@endsection