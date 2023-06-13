@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">User Masters</label>
         
           <div id="div3" style="margin-right: 30px">
           <a href="{{route('export-users','All_users')}}"> <button class="btn btn-light btn-outline-secondary" > Download CSV</button> </a>
             
          </div>

         <div id="div2" style="margin-right: 30px" >
            <a data-bs-toggle="modal" data-bs-target="#importModal"  class="btn btn-light btn-outline-secondary" href=""><label id="modal">Import</label></a>
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
                                <div class="div-margin">
                                     <a href="{{route('admin')}}"><label class="btn btn-light" id="modal">View Users</label></a>
                                 <a style="margin-left: 30px" href="{{route('create_user','admin')}}"> 
                                    <label class="btn btn-light curved-text-button" id="modal">Create User</label>
                                 </a>
                                </div>
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
                                 <div class="div-margin">
                                     <a href="{{route('manager')}}"><label class="btn btn-light" id="modal">View Users</label></a>
                                 <a style="margin-left: 30px" href="{{route('create_user','manager')}}"></i> 
                                    <label class="btn btn-light curved-text-button" id="modal">Create User</label>
                                 </a>
                                </div>
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
                                 <div class="div-margin">
                                     <a href="{{route('supervisor')}}"><label class="btn btn-light" id="modal">View Users</label></a>
                                 <a style="margin-left: 30px" href="{{route('create_user','supervisor')}}"></i> 
                                    <label class="btn btn-light curved-text-button" id="modal">Create User</label>
                                 </a>
                                </div>
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
                                <div class="div-margin">
                                     <a href="{{route('procurement')}}"><label class="btn btn-light" id="modal">View Users</label></a>
                                 <a style="margin-left: 30px" href="{{route('create_user','procurement')}}"></i> 
                                    <label class="btn btn-light curved-text-button" id="modal">Create User</label>
                                 </a>
                                </div>
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
                                <div class="div-margin">
                                     <a href="{{route('finance')}}"><label class="btn btn-light" id="modal">View Users</label></a>
                                 <a style="margin-left: 30px" href="{{route('create_user','finance')}}"></i> 
                                    <label class="btn btn-light curved-text-button" id="modal">Create User</label>
                                 </a>
                                </div>
                                
                            </div>
                            <h2 class="card-text">{{$finance_count}}</h2>
                        </div>

                    </div>
                </div>

            

            </div>
        </div>
    </div>
</div>



<!-- Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Users from Excel sheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('import_user') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <div class="custom-file text-left">
                            <input type="file" name="file" class="custom-file-input" id="customFile">
                           
                        </div>
                    </div>
                    <button class="btn btn-primary">Import</button>
                    
                </form>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->
@endsection
