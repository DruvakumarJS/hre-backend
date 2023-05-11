@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Indent</label>
            
            <a class="link-dark" href="{{route('filter_indents','all')}}"><label style="margin-left: 50px" class="label-medium" id="div1">All({{$all}})</label></a>
            

            <label  style="margin-left: 20px" class="label-medium" id="div1">|</label>
            
            <a class="link-dark" href="{{route('filter_indents','Active')}}"><label style="margin-left: 20px" class="label-medium" id="div1">Active({{$activeCount}})</label></a>
            

            <label  style="margin-left: 20px" class="label-medium" id="div1">|</label>
            
             <a class="link-dark" href="{{route('filter_indents','Pending')}}"><label style="margin-left: 20px" class="label-medium" id="div1">Pending({{$pendingCount}})</label></a>
            

            <label  style="margin-left: 20px" class="label-medium" id="div1">|</label>
          
            <a class="link-dark" href="{{route('filter_indents','Completed')}}"><label style="margin-left: 20px" class="label-medium" id="div1">Completed({{$compltedCount}})</label></a>
            


          
          <div id="div2" >
            <a href="{{route('tickets')}}"><button class="btn btn-light btn-outline-secondary" > View Tickets</button></a>
             
          </div>
         <!--  <div id="div2" style="margin-right: 30px">
            <a href="{{route('tickets')}}"><button class="btn btn-light btn-outline-secondary" > Download CSV</button></a>
             
          </div> -->

          

          
        </div>
      <div class="page-container">
        <div class="div-margin">
        	
        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Sl.no</th>
                              <th scope="col">Indent Number</th>
                              <th scope="col">PCN</th>
                              <th scope="col">Indent Owner</th>
                              <th scope="col">Status</th>
                              <th scope="col">Created Date</th>
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($indents as $key =>$value)
                              <tr> 
                                <td>{{$key + $indents->firstItem()}}</td> 
                                <td>{{$value->indent_no}}</td> 
                                <td>{{$value->pcn}}</td>  
                                <td>{{$value->user->name}}</td>  
                                <td>{{$value->status}}</td>
                                <td>{{$value->created_at}}</td> 
    
                               
                                <td> <a href="{{route('indent_details',$value->indent_no)}}"><button class="btn btn-light curved-text-button btn-sm">View</button></a></td>
                                
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