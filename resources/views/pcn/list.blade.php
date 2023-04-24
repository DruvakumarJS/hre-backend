@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">PCN</label>
           <div id="div2">
            <a class="btn btn-light" href="{{route('view_pcn')}}"></i> 
             <label id="modal">View All PCN </label></a>
            
          </div>
          <div id="div2" style="margin-right: 30px">
             <a class="btn btn-light" href="{{route('create_pcn')}}"><i class="fa fa-plus"></i> 
             <label id="modal">Create PCN</label></a>
          </div>

          
            
        </div>

        <div style="margin-top: 50px">
        	<label style="margin-left: 20px">Active PCNs</label>

        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th>Sl.no</th>
                              <th scope="col">PCN</th>
                              <th scope="col">PCN Owner</th>
                              <th scope="col">Customer Name</th>
                              <th scope="col">Customer Email</th>
                              <th scope="col">Address</th>
                              <th scope="col">Create On</th>
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($pcns as $key => $value)
                            <tr>  
                              <td>{{$key + $pcns->firstItem()}}</td>
                              <td>{{$value->pcn}}</td>
                              <td>{{$value->employee->name}}</td>
                              <td>{{$value->client_name}}</td>
                              <td>{{$value->customer->email}}</td>
                              <td>{{$value->area}},{{$value->city}},{{$value->state}}</td>
                              <td>{{$value->created_at}}</td>
                              <td ><a href="{{route('edit_pcn',$value->pcn)}}"><label class="curved-text">View/Edit</label></a>
                              </td>
                            </tr>
                          @endforeach
                             
                          </tbody>
                        </table>

                        <label>Showing {{ $pcns->firstItem() }} to {{ $pcns->lastItem() }}
                                    of {{$pcns->total()}} results</label>

                                {!! $pcns->links('pagination::bootstrap-4') !!}
                        
                    </div>
                    <!--</div>-->
                 </div>
        </div>
    </div>
</div>
@endsection