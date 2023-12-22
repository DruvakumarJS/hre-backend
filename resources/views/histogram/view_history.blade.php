@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">Histogram History </label>
            <label>{{$histogram->pcn}} - {{$histogram->project_name}}</label>
         
          <div id="div2" style="margin-right: 30px">
             <a  href="{{route('histogram')}}"> <button class="btn btn-outline-secondary">Histogram</button></a>
          </div>
          
       @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
        @endif  
      
        </div>

       <div class="page-container">
        <div class="div-margin">
        	

        	<div class="card border-white scroll tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

                        <table class="table">
                          <thead>
                            <tr style="height: 50px">
                              <th scope="col">PCN</th>
                              <th scope="col">Subitted By</th>
                              <th scope="col">Submitted Date</th>
                              <th scope="col">Submitted Time</th>
                              <th scope="col">Action</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key=>$value)
                            <tr>
                              <td>{{$value->pcn}}</td>
                              <td>{{$value->user->employee_id}} - {{$value->user->name}}</td>
                              <td>{{date('d-m-Y' ,strtotime($value->submission_date))}}</td>
                              <td>{{date('H:i' ,strtotime($value->submission_time))}}</td>
                              <td>
                                <a target="_blank" href="{{ URL::to('/') }}/{{$value->path}}/{{$value->filename}}" ><button class="btn btn-sm btn-light btn-outline-secondary">View PDF</button></a>

                                @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2)
                                <a onclick="return confirm('Are you sure to Delete Permanently?, If Required,Download or Save or Print prior to delete')" href="{{route('delete_history',[$value->id , $value->histogram_id])}}"><button class="btn btn-sm btn-light btn-outline-secondary">Delete PDF</button></a>
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