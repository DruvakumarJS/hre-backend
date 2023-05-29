@extends('layouts.app')

@section('content')


<div class="container">
    <div class="container-header">
        <label class="label-bold" id="div1">Attendance</label>

        <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href=""><i class="fa fa-plus"></i> Create Employee</a>


        </div>

        <div id="div2" style="margin-right: 30px">
            <a  class="btn btn-light btn-outline-secondary" href="{{route('employee-details')}}"></i> View Employees</a>
        </div>

        <!-- <div id="div3" style="margin-right: 30px">
            <button class="btn btn-light btn-outline-secondary" > Download CSV</button>
        </div> -->
    </div>

    <label>Today's Attendance</label>

    <div class="row">
        <div class="card border-white">

            <table class="table">
                <thead>
                <tr>
                   
                    <th scope="col">Employee ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Login </th>
                    <th scope="col">Logout</th>
                    <th scope="col">Total Hours</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($attendance as $key=>$value)
                    <tr>
                       
                        <td>{{$value->employee->employee_id}}</td>
                        <td>{{$value->employee->name}}</td>
                        <td>{{$value->user->roles->alias}}</td>
                        <td>{{$value->login_time}}</td>
                        <td>{{$value->logout_time}}</td>
                        @php
                          $minute = $value->total_hours;
                          $hour=  floor($minute / 60) ;
                          $min = $minute % 60 ;
                        @endphp
                        @if($value->total_hours == '0')
                        <td></td>
                        @else
                        <td>{{$hour}}Hr : {{$min}}Min</td>
                        @endif
                        
                        <td>
                            <a href="{{route('employee-history', $value->user_id)}}"><button type="button" class="btn btn-sm curved-text">view</button></a>
                        </td>
                    </tr>
                   @endforeach 
                </tbody>
            </table>

            <label>Showing {{ $attendance->firstItem() }} to {{ $attendance->lastItem() }}
                                    of {{$attendance->total()}} results</label>

                                {!! $attendance->links('pagination::bootstrap-4') !!}

        </div>
    </div>

</div>
@endsection
