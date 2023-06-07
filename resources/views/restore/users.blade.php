@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Users</label>
          <div id="div2">

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
                            @foreach($data as $key => $value)
                               <tr>
                                   <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                                   <td>{{$value->employee_id}}</td>
                                   <td>{{$value->name}}</td>
                                   <td>{{$value->email}}</td>
                                   <td>{{$value->mobile}}</td>
                                   <td>{{$value->role}}</td>                                  
                                   
                                   <td>
                                    <a onclick="return confirm('Are you sure to restore?')" href="{{route('restore_user',$value->user_id)}}"><button class="btn btn-light btn-sm btn-outline-success">Restore</button></a>
                                    <a onclick="return confirm('Are you sure to delete?')" href="{{route('trash_user',$value->user_id)}}"><button class="btn btn-light btn-outline-danger btn-sm">Delete</button></a></td>
                               </tr>
                            @endforeach   

                           </tbody>
                       </table>
                       <label>Showing {{ $data->firstItem() }} to {{ $data->lastItem() }}
                                    of {{$data->total()}} results</label>

                                {!! $data->links('pagination::bootstrap-4') !!}
                   </div>

               </div>
           </div>
       </div>
    </div>
</div>
</div>
@endsection
