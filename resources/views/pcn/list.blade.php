@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">Active PCNs</label>
           <div id="div2">
            <a class="btn btn-light btn-outline-secondary" href="{{route('view_pcn')}}">
             <label id="modal">View Detailed PCN </label> </a>
          
          </div>
          @if(Auth::user()->role_id == 1)
          <div id="div2" style="margin-right: 30px">
             <a class="btn btn-light btn-outline-secondary" href="{{route('create_pcn')}}"><i class="fa fa-plus"></i> 
             <label id="modal">Create PCN</label></a>
          </div>
          @endif

            
        </div>

       <div class="page-container">
        <div class="div-margin">
        	

        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Date</th>
                              <th scope="col">PCN</th>
                              <th scope="col">Billing Name</th>
                              <th scope="col">Brand</th>
                              <th scope="col">Email</th>
                              <th scope="col">Address</th>
                              @if(Auth::user()->id == '1')
                              <th scope="col">Status</th>
                              
                              <th scope="col">Action</th>
                             @endif
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($pcns as $key => $value)
                            <tr> 
                              <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                              <td>{{$value->pcn}}</td>
                              <td>{{$value->client_name}}</td>
                               <td>{{$value->brand}}</td>
                              <td>{{$value->customer->email}}</td>
                              <td>{{$value->area}},{{$value->city}},{{$value->state}}</td>
                              @if(Auth::user()->role_id == '1')
                              <td>{{$value->status}}</td>
                              
                              <td ><a href="{{route('edit_pcn',$value->pcn)}}"><button class="btn btn-light curved-text-button btn-sm">Edit</button></a>
                              </td>
                              @endif
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
</div>
@endsection