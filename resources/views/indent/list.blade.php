@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Indent</label>

            <!-- <a href="{{route('filter_indents','Active')}}"
                class="{{request()->routeIs('filter_indents')? 'link-dark active' : ''}}" >
                <label id="div1" style="margin-left: 50px" class="nav-links">Active11({{$activeCount}})</label></a>
            -->

            
            <a class="{{request()->routeIs('filter_indents')
                      ? 'active' : ''}}"
                       href="{{route('filter_indents','all')}}" > <button class="btn" id="div1" style="margin-left: 50px">All({{$all}})</button> </a>

            <label  style="margin-left: 20px;margin-top: 10px" class="label-medium" id="div1">|</label>
            
            <a class="{{request()->routeIs('filter_indents')
                      ? 'active' : ''}}" href="{{route('filter_indents','Active')}}"><button class="btn" id="div1" style="margin-left: 20px">Active({{$activeCount}})</button></a>


            <!-- <label style="margin-left: 20px;margin-top: 10px" class="label-medium" id="div1">|</label>
            
             <a class="{{request()->routeIs('filter_indents')
                      ? 'active' : ''}}" href="{{route('filter_indents','Pending')}}"><button class="btn" id="div1" style="margin-left: 20px;">Pending({{$pendingCount}})</button>
             </a>
             -->

            <label  style="margin-left: 20px;margin-top: 10px" class="label-medium" id="div1">|</label>
          
            <a class="{{request()->routeIs('filter_indents')
                      ? 'active' : ''}}" href="{{route('filter_indents','Completed')}}">
              <button class="btn" id="div1" style="margin-left: 20px">Completed({{$compltedCount}})</button>
              </a>
          
         
          <div id="div2" style="margin-right: 30px">
            <a href="{{route('create_indent')}}"><button class="btn btn-light btn-outline-secondary" > Create Indent</button></a>
             
          </div>

          <div id="div2" style="margin-right: 30px">
            <a href="{{route('grn')}}"><button class="btn btn-light btn-outline-secondary" > GRN</button></a>
             
          </div>

          

          
        </div>
      <div class="page-container">
        <div class="div-margin">
        	
        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Date</th>
                              <th scope="col">Indent Number</th>
                              <th scope="col">PCN</th>
                              <th scope="col">Billing Details </th>
                              <th scope="col">Indent Owner</th>
                              <th scope="col">Status</th>
                             
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($indents as $key =>$value)
                              <tr> 
                                <td>{{date("d-m-Y", strtotime($value->created_at))}}</td> 
                                <td>{{$value->indent_no}}</td> 
                                <td>{{$value->pcn}}</td> 
                                <td >{{$value->pcns->client_name}} , {{$value->pcns->area}} , {{$value->pcns->city}}</td> 
                                <td>{{$value->user->name}}</td>  
                                <td>{{$value->status}}</td>
                                
                                <td> 
                                  <a href="{{route('indent_details',$value->indent_no)}}"><button class="btn btn-light curved-text-button btn-sm">View</button></a>

                                  <a onclick="return confirm('Are you sure to download?')" href="{{route('export_indent',$value->id)}}" style="margin-left: 10px; color: black"><i class='fa fa-download'></i></a>
                                </td>
                                
                              </tr>
                          @endforeach
                            
                          </tbody>
                        </table>

                         <label>Showing {{ $indents->firstItem() }} to {{ $indents->lastItem() }}
                                    of {{$indents->total()}} results</label>

                                {!! $indents->links('pagination::bootstrap-4') !!}
                        
                        
                    </div>
                    <!--</div>-->
                 </div>
        </div>
      </div>    	
    </div>
</div>
@endsection