@extends('layouts.app')

@section('content')


<div class="container">
    <div class="container-header">
        <label class="label-bold" id="div1">Attendance</label>

        <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light" href=""><i class="fa fa-plus"></i> Create Employee</a>


        </div>

        <div id="div2" style="margin-right: 30px">
            <a  class="btn btn-light" href="#"></i> View Employees</a>
        </div>

        <div id="div3" style="margin-right: 30px">
            <button class="btn btn-light" > Download CSV</button>
        </div>
    </div>

    <div class="row">
        <div class="card border-white">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Employee No</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Location</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>EMP0123232</td>
                        <td>Ramesh</td>
                        <td>Supervisor</td>
                        <td>Bangalore</td>
                        <td>ramesh@hre.com</td>
                        <td>+91 92323 23234</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light">view</button>
                        </td>
                    </tr>
                    <tr>
                        <td>EMP0123232</td>
                        <td>Ramesh</td>
                        <td>Supervisor</td>
                        <td>Bangalore</td>
                        <td>ramesh@hre.com</td>
                        <td>+91 92323 23234</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light">view</button>
                        </td>
                    </tr>
                    <tr>
                        <td>EMP0123232</td>
                        <td>Ramesh</td>
                        <td>Supervisor</td>
                        <td>Bangalore</td>
                        <td>ramesh@hre.com</td>
                        <td>+91 92323 23234</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light">view</button>
                        </td>
                    </tr>
                    <tr>
                        <td>EMP0123232</td>
                        <td>Ramesh</td>
                        <td>Supervisor</td>
                        <td>Bangalore</td>
                        <td>ramesh@hre.com</td>
                        <td>+91 92323 23234</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light">view</button>
                        </td>
                    </tr>
                    <tr>
                        <td>EMP0123232</td>
                        <td>Ramesh</td>
                        <td>Supervisor</td>
                        <td>Bangalore</td>
                        <td>ramesh@hre.com</td>
                        <td>+91 92323 23234</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light">view</button>
                        </td>
                    </tr>
                    <tr>
                        <td>EMP0123232</td>
                        <td>Ramesh</td>
                        <td>Supervisor</td>
                        <td>Bangalore</td>
                        <td>ramesh@hre.com</td>
                        <td>+91 92323 23234</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light">view</button>
                        </td>
                    </tr>
                    <tr>
                        <td>EMP0123232</td>
                        <td>Ramesh</td>
                        <td>Supervisor</td>
                        <td>Bangalore</td>
                        <td>ramesh@hre.com</td>
                        <td>+91 92323 23234</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light">view</button>
                        </td>
                    </tr>
                    <tr>
                        <td>EMP0123232</td>
                        <td>Ramesh</td>
                        <td>Supervisor</td>
                        <td>Bangalore</td>
                        <td>ramesh@hre.com</td>
                        <td>+91 92323 23234</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light">view</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
