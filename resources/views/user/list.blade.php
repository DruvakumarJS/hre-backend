@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Users Master</label>
          <div id="div2">
              <a class="btn btn-light" href="{{route('create_user')}}"><i class="fa fa-plus"></i> 
             <label id="modal">Create User</label>
           </a>
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
                                <h2>Super Admin</h2>
                                <a href="{{route('superadmin')}}">View Details</a>
                            </div>

                            <h2 class="card-text" >{{$admins_count}}</h2>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h2>Project Manager</h2>
                                 <a href="{{route('manager')}}">View Details</a>
                            </div>
                            <h2 class="card-text">{{$manager_count}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h2>Supervisor</h2>
                                 <a href="{{route('supervisors')}}">View Details</a>
                            </div>
                            <h2 class="card-text" >{{$supervisors_count}}</h2>
                        </div>

                    </div>
                </div>

                 <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h2>Procurement</h2>
                                <a href="{{route('procurement')}}">View Details</a>
                            </div>
                            <h2 class="card-text">{{$procurement_count}}</h2>
                        </div>

                    </div>
                </div>


                <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h2>Finance</h2>
                                 <a href="{{route('finance')}}">View Details</a>
                            </div>
                            <h2 class="card-text">{{$finance_count}}</h2>
                        </div>

                    </div>
                </div>

            

            </div>
        </div>
    </div>
</div>
@endsection
