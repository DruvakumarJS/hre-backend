@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">{{$role}}</label>

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

    
            @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
        @endif

    <div class="page-container">
       <div class="row">
           <div class="col-md-12">
               <div class="users-list">
                   <div class="card border-white table-wrapper-scroll-y ">

                       <table class="table">
                           <thead>
                           <tr>
                               <th>Date</th>
                               <th scope="col">Employee ID</th>
                               <th scope="col">Name</th>
                               <th scope="col">Email ID</th>
                               <th scope="col">Mobile</th>
                               <th scope="col">Role</th>
                               
                               <th scope="col">Action</th>
                           </tr>
                           </thead>
                           <tbody>
                            @foreach($users as $key => $value)
                               <tr>
                                   <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                                   <td>{{$value->employee_id}}</td>
                                   <td>{{$value->name}}</td>
                                   <td>{{$value->email}}</td>
                                   <td>{{$value->mobile}}</td>
                                   <td>{{$value->role}}</td>                                  
                                   
                                   <td>
                                    <a href="{{route('edit_user',$value->user_id)}}"><button class="btn btn-light btn-sm curved-text-button">Edit</button></a>
                                   @if($value->user->isloggedin == '0')
                                     <button class="btn btn-danger btn-sm " disabled>Force Logout</button>
                                   @else 
                                    <a  onclick="return confirm('The Employee can login with his credentials on different device .')" href="{{route('force_logout',$value->user_id)}}"><button class="btn btn-success btn-sm ">Force Logout</button></a>
                                   @endif 
                                   
                                   @if($value->user_id != 1)
                                    <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_user',$value->user_id)}}"><button class="btn btn-light btn-outline-danger btn-sm">Delete</button></a>
                                    @endif
                                  </td>
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
