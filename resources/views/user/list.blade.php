@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Users Master</label>
          <div id="div2">
             <button class="btn btn-light" ><i class="fa fa-plus"></i> Create User</button>
          </div>
           <div id="div3" style="margin-right: 30px">
             <button class="btn btn-light" > Download CSV</button>
          </div>
        </div>
    </div>
    <div class="page-container">
        <div class="top-counter">
            <div class="row">
                <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h2>Procurement</h2>
                                <a href="{{route('add_procurement')}}">View Details</a>
                            </div>

                            <h2 class="card-text" >34</h2>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h2>Project Manager</h2>
                                <a href="#">View Details</a>
                            </div>
                            <h2 class="card-text">34</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h2>Supervisor</h2>
                                <a href="#">View Details</a>
                            </div>
                            <h2 class="card-text" >34</h2>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h2>Finance</h2>
                                <a href="#">View Details</a>
                            </div>
                            <h2 class="card-text">34</h2>
                        </div>

                    </div>
                </div>

                <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h2>Super Admin</h2>
                                <a href="#">View Details</a>
                            </div>
                            <h2 class="card-text">34</h2>
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
@endsection
