@extends('layouts.app')

@section('content')


<div class="container">
    <div class="container-header">
        <label class="label-bold" id="div1">Employee History</label>



        <div id="div2" >
            <div class="mb-3 d">
                <select class="form-control">
                    <option>Choose Months</option>
                </select>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-12">
            <div class="card employee-card">
                <div class="row">
                    <div class="col-3">
                        <h5><b>{{$employee->name}}</b></h5>
                        <h6>{{$employee->user->roles->alias}}</h6>
                        <h6>{{$employee->employee_id}}</h6>
                    </div>
                    <div class="col-3 text-center">
                         @php
                          $minute = $total_hour;
                          $hour=  floor($minute / 60) ;
                          $min = $minute % 60 ;
                        @endphp
                        <h2>{{$hour}}Hr : {{$min}}Min</h2>
                        <p>Total Working Hours</p>
                    </div>
                    <div class="col-3 text-center">

                        <h1>32</h1>
                        <p>Total Working Hours</p>
                    </div>
                    <div class="col-3 text-center">
                        <h1>02</h1>
                        <p>Leaves</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="card border-white">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Login Time</th>
                    <th scope="col">Logout Time</th>
                    <th scope="col">Working Hours</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($attendance as $key=>$value)
                    <tr>
                        <td>{{$value->date}}</td>
                        <td>{{$value->login_time}}</td>
                        <td>{{$value->logout_time}}</td>
                         @php
                          $minute = $value->total_hours;
                          $hour=  floor($minute / 60) ;
                          $min = $minute % 60 ;
                         @endphp
                        <td>{{$hour}}Hr : {{$min}}Min</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
