@extends('layouts.app')

@section('content')

<div class="container" >
    <div class="row ">
        <div >
           
        <div class="container-header">
            <label class="label-bold" id="div1">Dashboard</label>
           
        </div>
   
       <div class="row">
                <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body">
                            <img src="{{ asset('images/indent.svg') }}" alt="intend" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="float:right;font-weight: bolder; font-size: 40px ; ">{{$todaysIndent}}</h2>
                        </div>
                       <div>
                            <h4 class="card-text-black" style="float:left;font-size: 25px; font-weight: bolder;">Received Indent</h4>
                            <a style="float: right;" href="{{route('intends')}}"><label class="curved-text-button">View</label></a>
                        </div>
                        <label class="card-text-label ">No. of indent received today</label>
                    </div>
                    <!--</div>-->
                </div>



                 <div class="col-sm-6 col-md-4" >
                    <div class="card border-black" style="background-color: #242424">
                        <div class="card-body" >
                            <img src="{{ asset('images/attendance.svg') }}" alt="attendance" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="color:#fff;float:right;font-weight: bolder; font-size: 40px ; ">{{$attendance}}</h2>
                        </div>
                       <div>
                            <h4 class="card-text-black" style="float:left;font-size: 25px; font-weight: bolder;color: #fff">Attendance</h4>
                            <a style="float: right;" href="{{route('attendance')}}"><label class="curved-text-button">View</label></a>
                        </div>
                        <label class="card-text-label" style="color:#fff">Today working</label>
                    </div>
                    <!--</div>-->
                </div>


                 <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body">
                            <img src="{{ asset('images/tickets.svg') }}" alt="ticket" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="float:right;font-weight: bolder; font-size: 40px ; ">{{$tickets}}</h2>
                        </div>
                        <div>
                           <h4 class="card-text-black" style="float:left;font-size: 25px; font-weight: bolder;">Tickets</h4>
                             <a style="float: right;margin-top: 10px" href="{{route('tickets')}}"><label class="curved-text-button">View</label></a>
                        </div>
                        <label class="card-text-label ">Pending Tickets</label>
                    </div>
                   
                </div>


              
            </div>

            <div>
                <label>Recent Indent</label>

                <div class="row">
                  <div class="col-sm-6 col-md-12">
                    <div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                             
                              <th scope="col">Indend Number</th>
                              <th scope="col">PCN</th>
                              <th scope="col">Indent Owner</th>
                              <th scope="col">Status</th>
                              <th scope="col">Created On</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($indents as $key =>$value)
                            <tr>  
                             
                                <td>{{$value->indent_no}}</td> 
                                <td>{{$value->pcn}}</td>  
                                <td>{{$value->user->name}}</td>  
                                <td>{{$value->status}}</td>
                                <td>{{$value->created_at}}</td>
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
</div>
@endsection
