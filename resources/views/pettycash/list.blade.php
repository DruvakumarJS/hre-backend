@extends('layouts.app')

@section('content')
<div class="container">
     <div class="container-header">
        <label class="label-bold" id="div1">Petty Cash</label>

@if(Auth::user()->role_id == '1' || Auth::user()->role_id == '5' )
        <div id="div2" >
            <a class="btn btn-light btn-outline-secondary" href="{{route('create_new')}}"><i class="fa fa-plus"></i> Issue Pettycash</a>
        </div>

       

        <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('search_pettycash')}}">
            @csrf
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search by Name / ID">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>

           <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('export_pettycash')}}"> Download CSV</a>
        </div>

@endif
 </div>
     @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
        @endif  

     <div class="row">
        <div class="card border-white">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Issued Amount</th>
                    <th scope="col">Balance Amount</th>          
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$value)
                    <tr>
                        <td>{{$value->employee->employee_id}}</td>
                        <td>{{$value->employee->name}}</td>
                        <td>{{$value->employee->user->roles->alias}}</td>
                        <td><span>&#8377;</span>{{$value['total_issued']}}</td>
                        <td><span>&#8377;</span>{{$value['total_balance']}}</td>
                          @php
                         $size = sizeof($value->details);
                        @endphp
                      
                        <td>
                            <a href="{{route('view_summary',$value->user_id)}}"><button class="btn btn-sm btn-light btn-outline-secondary">Statement</button></a>
                            <a href="{{route('details_pettycash',$value->user_id)}}"><button class="btn btn-sm btn-outline-success">Transaction info</button></a>
                            @if(Auth::user()->role_id == '1')
                            <a href="{{route('pettycash_info',$value->user_id)}}"><button class="btn btn-sm btn-light btn-outline-secondary">More</button></a>
                            @endif

                            @if($value['user_id'] == Auth::user()->id)
                             <a href="{{route('pettycash_expenses')}}"><button class="btn btn-light btn-sm btn-outline-danger">Upload Expenses</button></a>
                             @endif

                            @if($size!=0)
                            <i class="fa fa-clock-o " style="color: red;width: 2px ; height: 2px ; margin-left: 10px"></i>
                             @endif
 
                           
                        </td>
                       
                    </tr>

                    @endforeach

                   
                </tbody>
            </table>

           

          

        </div>
    </div>
</div>
@endsection