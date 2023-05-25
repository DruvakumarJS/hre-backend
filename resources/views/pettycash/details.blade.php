@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
     <div class="container-header">
        <label class="label-bold" id="div1">Petty Cash Details</label>
        <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('pettycash')}}"> View PettyCash List</a>
        </div>
    </div>




    <div class="form-build">
    	<div class="row">
    		<div class="col-md-2">
    			<label>Employee Name</label>
    			<h3 class="label-bold">{{$pettycash->employee->name}}</h3>
    			
    		</div>
    		<div class="col-md-2">
    			<label>Contact No</label>
    			<h3 class="label-bold">{{$pettycash->employee->mobile}}</h3>
    			
    		</div>

    		<div class="col-md-2">
    			<label>Total Amount</label>
    			<h3 class="label-bold">{{$pettycash->total}}</h3>
    			
    		</div>

    		<div class="col-md-2">
    			<label>Outsatnding Amount</label>
    			<h3 class="label-bold">{{$pettycash->remaining}}</h3>
    			
    		</div>
    		
    	</div>

    	<div class="row div-margin">
    			<div class="col-md-1">
    				<label class="label-bold " >Date</label>
    			</div>

    			<div class="col-md-1">
    				<label class="label-bold">Bill No.</label>
    			</div>

    			<div class="col-md-1">
    				<label class="label-bold">Spent Amount</label>
    			</div>

    			<div class="col-md-2">
    				<label class="label-bold">Comments</label>
    			</div>

    			<div class="col-md-1">
    				<label class="label-bold">File Name</label>
    			</div>

    			<div class="col-md-2">
    				<label class="label-bold">Staus</label>
    			</div>

    			<div class="col-md-1">
    				
    			</div>
    			
    		</div>
    	@foreach($data as $key =>$value)
    	<div class="card card border-white">

    		<div class="row">
    			<div class="col-md-1">
    				<label>{{date("d-m-Y", strtotime($value->created_at))}}</label>
    			</div>

    			<div class="col-md-1">
    				<label>{{$value->billing_no}}</label>
    			</div>

    			<div class="col-md-1">
    				<label>{{$value->spent_amount}}</label>
    			</div>

    			<div class="col-md-2">
    				<label>{{$value->comments}}</label>
    			</div>

    			<div class="col-md-1">
    				<label>{{$value->filename}}</label>
    			</div>

    			<div class="col-md-2">
    				@if($value->isapproved == '0')
    					<label style="color: blue">Waiting for approval</label>
    			    @elseif($value->isapproved == '1')
    			         <label style="color: green">Accepted</label>
    			    @else 
    			         <label style="color: red">Rejected</label> 
    			    @endif         
    			</div>

               
    			<div class="col-md-2">
    				@if( (Auth::user()->role == 'admin') || (Auth::user()->role == 'finance'))
    				@if($value->isapproved == '0')
    					<a href="{{route('update_bill_status',['id' => $value->id, 'status' => '1']) }}"><button class="btn btn-sm btn-outline-success">Accept</button></a>
    					<a href="{{route('update_bill_status',['id' => $value->id, 'status' => '2'] ) }}"><button  class="btn btn-sm btn-outline-danger">Reject</button></a>
    			    @endif
    			    @endif		
    			</div>

    			
    			
    		</div>
    		
    	</div>
    	@endforeach

    </div>

 </div>    
</div>
@endsection