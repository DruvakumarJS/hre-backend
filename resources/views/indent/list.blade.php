@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Indent</label>

            <label style="margin-left: 50px" class="label-medium" id="div1">pending(23)</label>

            <label  style="margin-left: 20px" class="label-medium" id="div1">|</label>
          
            <label  style="margin-left: 20px" class="label-medium" id="div1">Completed(488)</label>
          
          <div id="div2" style="margin-right: 30px">
             <button class="btn btn-light" > View All Tickets</button>
          </div>

           <div id="div3" style="margin-right: 30px">
             <button class="btn btn-light" > View All Intends</button>
          </div>

            
        </div>

        <div style="margin-top: 50px">
        	<label style="margin-left: 20px">Recent Indents</label>

        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                               <th scope="col">Sl.no</th>
                              <th scope="col">Indend Number</th>
                               <th scope="col">PCN</th>
                              <th scope="col">Received</th>
                              <th scope="col">Pending</th>
                              <th scope="col">Status</th>
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($indents as $key =>$value)
                              <tr> 
                                <td>{{$key + $indents->firstItem()}}</td> 
                                <td>{{$value->indent_no}}</td> 
                                <td>{{$value->pcn}}</td>  
                                <td>{{$value->recieved}}</td>
                                <td>{{$value->pending}}</td>
                                <td>{{$value->status}}</td>
    
                               
                                <td> <a href="{{route('indent_details',$value->indent_no)}}"><label class="curved-text-button">View/Edit</label></a></td>
                                
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
@endsection