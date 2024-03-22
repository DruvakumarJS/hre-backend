@extends('layouts.app')

@section('content')

<style type="text/css">
  td{
max-width: 150px;
overflow: hidden;
text-overflow: clip;
white-space: nowrap;
}
 .scrollable-cell {
     
      overflow-x: auto;/* Display ellipsis (...) for overflowed content */
  }
  ::-webkit-scrollbar {
  height: 4px;              /* height of horizontal scrollbar ← You're missing this */
  width: 4px;
}   

</style>
<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">Active PCNs</label>
           <div id="div2">
            <a class="btn btn-light btn-outline-secondary" href="{{route('view_pcn')}}">
             <label id="modal">View Detailed PCN </label> </a>
          
          </div>
          @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2)
          <div id="div2" style="margin-right: 30px">
             <a class="btn btn-light btn-outline-secondary" href="{{route('create_pcn')}}"><i class="fa fa-plus"></i> 
             <label id="modal">Create PCN</label></a>
          </div>
          @endif

          <div id="div2" style="margin-right: 30px">
           <form method="GET" action="{{route('search_pcn')}}">
            @csrf
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search here">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>
         
          

            
        </div>

       <div class="page-container">
        <div class="div-margin">
        	

        	<div class="card border-white scroll tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

                        <table class="table">
                          <thead>
                            <tr style="height: 50px">
                              <th scope="col">PCN</th>
                              <th scope="col">Billing Name</th>
                              <th scope="col">Brand</th>
                              <th scope="col">Email</th>
                              <th scope="col">Address</th>
                              <th scope="col">Status</th>
                              
                              @if(Auth::user()->role_id == '1' OR Auth::user()->role_id == '2')
                              
                              <th scope="col">Action</th>
                             @endif
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($pcns as $key => $value)
                            <tr> 
                              <td>{{$value->pcn}}</td>
                              <td>{{$value->client_name}}</td>
                              <td width="100px">{{$value->brand}}</td>
                              <td>{{$value->customer->email}}</td>
                              <td  class="scrollable-cell" data-toggle="tooltip" data-placement="top"
                               title="{{$value->location}},{{$value->area}},{{$value->city}},{{$value->state}},{{$value->pincode}}">{{$value->location}},{{$value->area}},{{$value->city}},{{$value->state}},{{$value->pincode}}</td>
                              <td>{{$value->status}}</td>
                              @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2)
                              <td >
                                
                                 <a href="{{route('edit_pcn',$value->pcn)}}"><button class="btn btn-light curved-text-button btn-sm">Edit</button></a>
                               
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