@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Users Master / {{$role}}</label>
          <div id="div2">

              <div id="div2" style="margin-right: 30px" >
            <a class="btn btn-light btn-outline-secondary" href="{{route('users')}}"> 
             <label id="modal">User Master</label>
           </a>
          </div>

              <div id="div2" style="margin-right: 30px" >
            <a class="btn btn-light btn-outline-secondary" href="{{route('create_user',$role_name)}}"><i class="fa fa-plus"></i> 
             <label id="modal">Add User</label>
           </a>
          </div>

        

           <div id="div3" style="margin-right: 30px">
             <a href="{{route('export-users',$role_name)}}"> <button class="btn btn-light btn-outline-secondary" > Download CSV</button> </a>
          </div>
        </div>
    </div>
    <div class="page-container">
       <div class="row">
           <div class="col-md-12">
               <div class="users-list">
                   <div class="card border-white">

                       <table class="table">
                           <thead>
                           <tr>
                            <th>Sl.no</th>
                               <th scope="col">Employee ID</th>
                               <th scope="col">Name</th>
                               <th scope="col">Email ID</th>
                               <th scope="col">Mobile</th>
                               <th scope="col">Role</th>
                               <th scope="col">Created On</th>
                               <th scope="col">Action</th>
                           </tr>
                           </thead>
                           <tbody>
                            @foreach($users as $key => $value)
                               <tr>
                                   <td>{{$key + $users->firstItem()}}</td>
                                   <td>{{$value->employee_id}}</td>
                                   <td>{{$value->name}}</td>
                                   <td>{{$value->email}}</td>
                                   <td>{{$value->mobile}}</td>
                                   <td>{{$value->role}}</td>                                  
                                   <td>{{$value->created_at}}</td>
                                   <td>
                                    <a href="{{route('edit_user',$value->user_id)}}"><button class="btn btn-light btn-sm curved-text-button">Edit</button></a>
                                    <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_user',$value->user_id)}}"><button class="btn btn-light btn-outline-danger btn-sm">Delete</button></i></a></td>
                               </tr>
                            @endforeach   

                           </tbody>
                       </table>
                       <label>Showing {{ $users->firstItem() }} to {{ $users->lastItem() }}
                                    of {{$users->total()}} results</label>

                                {!! $users->links('pagination::bootstrap-4') !!}
                   </div>

               </div>
           </div>
       </div>
    </div>
</div>
</div>
@endsection
