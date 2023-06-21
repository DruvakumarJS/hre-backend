@extends('layouts.app')

@section('content')
<div class="container">
     <div class="container-header">
        <label class="label-bold" id="div1">Petty Cash</label>

@if(Auth::user()->role_id == '1' || Auth::user()->role_id == '5' )
        <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('create_new')}}"><i class="fa fa-plus"></i> Create New</a>
        </div>

        <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('export_pettycash')}}"> Download CSV</a>
        </div>
@endif
    </div>

     <div class="row">
        <div class="card border-white">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Role</th>
                    <th scope="col">Issued Amount</th>
                    <th scope="col">Balance Amount</th>   
                    <th scope="col">Payment Mode</th>           
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$value)
                    <tr>
                        <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                        <td>{{$value->employee->employee_id}}</td>
                        <td>{{$value->employee->name}}</td>
                        <td>{{$value->employee->mobile}}</td>
                        <td>{{$value->employee->user->roles->alias}}</td>
                        <td><span>&#8377;</span>{{$value->total}}</td>
                        <td><span>&#8377;</span>{{$value->remaining}}</td>
                        <td>{{$value->mode}}</td>
                        @php
                         $size = sizeof($value->details);
                        @endphp
                        <td>
                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'finance')
                            <a href="{{route('edit_pettycash',$value->id)}}"><button class="btn btn-light btn-sm curved-text-button">Edit</button></a>
                            @else 
                            <a href="{{route('pettycash_expenses',$value->id)}}"><button class="btn btn-light btn-sm btn-outline-danger">Upload Expenses</button></a>
                            @endif
                            <a href="{{route('details_pettycash',$value->id)}}"><button class="btn btn-light btn-sm btn-outline-success">Details</button></a>
                            @if($size!=0)
                            <i class="fa fa-clock-o " style="color: red;width: 2px ; height: 2px ; margin-left: 10px"></i>
                             @endif

                        </td>
                        
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
@endsection