@extends('layouts.app')

@section('content')


<div class="container">
    <div class="container-header">
        <label class="label-bold" id="div1">Current month Attendance</label>

        <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('attendance')}}"> View Today's Attendance</a>

        </div>

        <div id="div2" style="margin-right: 30px">
            <a  class="btn btn-light btn-outline-secondary" href="{{route('download_monthly_attendance')}}"> Download</a>
        </div>

        <!-- <div id="div2" style="margin-right: 30px">
            <a  class="btn btn-light" href="#"></i> View Employees</a>
        </div>

        <div id="div3" style="margin-right: 30px">
            <button class="btn btn-light" > Download CSV</button>
        </div> -->
    </div>

    

    <div class="row">
        <div class="card border-white">

            <table class="table">
                <thead>
                <tr>
                   
                    <th scope="col">Employee ID</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Days Present</th>
                    <th scope="col">Total Working Hours</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        
                        <td>{{$value['employee_id']}}</td>
                        <td>{{$value['name']}}</td>
                        <td>{{$value['role']}}</td>
                        <td>{{$value['days_present']}}</td>
                        @php
                          $minute = $value['working_hours'];
                          $hour=  floor($minute / 60) ;
                          $min = $minute % 60 ;
                        @endphp
                        @if($value['working_hours'] == '0')
                        <td>0 Min</td>
                        @else
                        <td>{{$hour}}Hr : {{$min}}Min</td>
                        @endif
                        <td>{{$value['mobile']}}</td>
                        <td>
                           <a href="{{route('employee-history', $value['user_id'])}}"><button type="button" class="btn btn-sm curved-text">View Attendance</button></a>
                        </td>
                    </tr>

                    @endforeach


                    
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
