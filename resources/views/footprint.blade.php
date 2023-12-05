@extends('layouts.app')

@section('content')
<style type="text/css">
  thead th {
 
  height: 50px;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
           
            <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{ route('search_footprint')}}">
            @csrf
            <input type="hidden" name="search" value="{{$search}}">
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search here" value="{{$search}}">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>
           
        </div>
 
       
        <div>
        	 <label class="label-bold" style="margin-left: 20px" >Foot Prints</label>

        	<div class="card border-white scroll tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

                        <table class="table">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th>Time</th>
                              <th scope="col">Module</th>
                              <th scope="col">Action</th>
                              <!-- <th scope="col">Operation</th> -->
                              <th scope="col">Employee Name</th>
                              <th scope="col">Employee ID </th>
                              
                            
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key=>$value)
                            <tr>
                              <td>{{date('D', strtotime($value->created_at))}} , {{date('d M Y', strtotime($value->created_at))}}</td>
                              <td>{{date('H:i:s', strtotime($value->created_at))}}</td>
                              <td>{{$value->module}}</td>
                              <td>{{$value->action}}</td>
                              <!-- @php
                                if($value->operation == 'C') $opr = 'Created';
                                if($value->operation == 'U') $opr = 'Updated';
                                if($value->operation == 'D') $opr = 'Deleted';
                              @endphp
                              <td>{{$opr}}</td> -->
                              <td>{{$value->user->name}}</td>
                              <td>{{$value->user->employee_id}}</td>
                              
                            </tr>
 
                            @endforeach
                          
                          </tbody>
                        </table>

                         <label>Showing {{ $data->firstItem() }} to {{ $data->lastItem() }}
                                    of {{$data->total()}} results</label>

                                {!! $data->links('pagination::bootstrap-4') !!}
                        
                    </div>
                    <!--</div>-->
                 </div>
        </div>	
    </div>

   
</div>









@endsection