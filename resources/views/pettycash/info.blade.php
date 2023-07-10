@extends('layouts.app')

@section('content')
<div class="container">
     <div class="container-header">
        <label class="label-bold" id="div1">Petty Cash</label>

@if(Auth::user()->role_id == '1' || Auth::user()->role_id == '5' )
        <div id="div2" >
            <a class="btn btn-light btn-outline-secondary" href="{{route('create_new')}}"><i class="fa fa-plus"></i> Create New</a>
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
                   
                    <th scope="col">Issued On</th>
                    <th scope="col">Issued Amount</th>
                    <th scope="col">Purpose</th>
                    <th scope="col">Payment Mode</th> 
                    <th scope="col">Reference No.</th>            
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$value)
                    <tr>
                       
                        <td>{{date("d-m-Y", strtotime($value->issued_on))}}</td>
                        <td><span>&#8377;</span>{{$value->total}}</td>
                        <td>{{$value->comments}}</td>
                        <td>{{$value->mode}}</td>
                        <td>{{$value->reference_number}}</td>
                        <td>
                           <a href="{{route('edit_pettycash',$value->id)}}"><button class="btn btn-light btn-sm btn-outline-secondary">Edit</button></a>

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