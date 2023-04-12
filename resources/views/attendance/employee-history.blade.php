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
                        <h5><b>Kubulu Babu</b></h5>
                        <h6>Supervisor / Bangalore</h6>
                        <h6>EMP12334</h6>
                    </div>
                    <div class="col-3 text-center">
                        <h1>32</h1>
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
                    <tr>
                        <td>01/02/2023</td>
                        <td>10:00 AM</td>
                        <td>07:00 PM</td>
                        <td>7 Hrs</td>
                    </tr>
                    <tr>
                        <td>01/02/2023</td>
                        <td>10:00 AM</td>
                        <td>07:00 PM</td>
                        <td>7 Hrs</td>
                    </tr>
                    <tr>
                        <td>01/02/2023</td>
                        <td>10:00 AM</td>
                        <td>07:00 PM</td>
                        <td>7 Hrs</td>
                    </tr>
                    <tr>
                        <td>01/02/2023</td>
                        <td>10:00 AM</td>
                        <td>07:00 PM</td>
                        <td>7 Hrs</td>
                    </tr>
                    <tr>
                        <td>01/02/2023</td>
                        <td>10:00 AM</td>
                        <td>07:00 PM</td>
                        <td>7 Hrs</td>
                    </tr>

                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
