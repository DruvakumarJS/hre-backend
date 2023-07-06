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
                <label>Issued Amount</label>
                <h3 class="label-bold"><span>&#8377;</span>{{$pettycash->total_issued}}</h3>
                
            </div>

            <div class="col-md-2">
                <label>Bill Accepted for</label>
                <h3 class="label-bold"><span>&#8377;</span>{{$pettycash->total_issued-$pettycash->total_balance}}</h3>
                
            </div>


             <div class="col-md-2">
                <label>Balance Amount</label>
                @if(auth::user()->role_id == '5' || auth::user()->role_id == '1')
                @if($pettycash->employee->user_id == auth::user()->id)
                 <h3 class="label-bold"><span>&#8377;</span><?php echo intval($pettycash->total_issued) - intval($myspent) ; ?></h3>
                @else
                <h3 class="label-bold"><span>&#8377;</span>{{$pettycash->total_balance}}</h3>
                @endif

                @else
                <h3 class="label-bold"><span>&#8377;</span><?php echo intval($pettycash->total_issued) - intval($myspent) ; ?></h3>
                 @endif
                
                
            </div>
            
        </div>

         <div class="card">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Date</th>
                               <!--  <th>Transaction Ref</th> -->
                                <th>Amount Utilised</th>
                                <th>Purpose</th>
                                <th width="200px">Description</th>
                                <th>Bill Date</th>
                                <th>Proof of Expense</th>
                                <th>Status</th>
                                <th width="200px">Remarks</th>
                                <th></th>
                            </tr>
                            </thead>
                        @foreach($data as $key =>$value)
                                <tr>
                                    <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                                   <!--  <td>{{$value->billing_no}}</td> -->
                                    <td><span>&#8377;</span>{{$value->spent_amount}}</td>
                                    <td>{{$value->purpose}}</td>
                                    <td>{{$value->pcn}} {{$value->comments}}</td>
                                    <td>{{date("d-m-Y", strtotime($value->bill_date))}}</td>
                                    <td>
                                        @if($value->filename != '')
                                        <a target="_blank" href="{{ URL::to('/') }}/pettycashfiles/{{$value->filename}}"><i class="fa fa-eye" style="color: black"></i></a> 

                                        <a download href="{{ URL::to('/') }}/pettycashfiles/{{$value->filename}}"><i class="fa fa-download" style="margin-left: 10px;color: black"></i></a> 
                                        @endif
                                    </td>
                                    @if($value->isapproved == '0')
                                        <td style="color: blue">Waiting for approval</td>
                                    @elseif($value->isapproved == '1')
                                         <td style="color: green">Approved</td>
                                    @else 
                                         <td style="color: red">Rejected</td> 
                                    @endif

                                    <td >{{$value->remarks}}</td> 
                                    <td>
                                        @if( (Auth::user()->role == 'admin') || (Auth::user()->role == 'finance'))
                                            @if($value->isapproved == '0')
                                                <a id="MybtnModal_{{$key}}" data-bs-toggle="modal" data-bs-target="#importModal" href=""><button class="btn btn-sm btn-outline-warning">Approve/Reject</button></a>
                                               
                                            @endif
                                            @endif  
                                    </td> 
                                   </tr>

<!--  Modal -->
        <div class="modal fade" id="modal_{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Bill Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('update_bill_status') }}" >
                    @csrf

                    <div class="form-group ">
                            <label class="label-bold">Bill Date :</label> <label>{{date("d-m-Y", strtotime($value->bill_date))}} {{$value->spent_amount}}</label>
                            <textarea name="remarks" placeholder="Enter Remarks here" style="width: 100%;padding: 10px" required></textarea> 
                           
                       
                    </div>
                    <input type="hidden" name="id" value="{{$value->id}}">
                    <button class="btn btn-outline-success" name="status" value="1">Approve</button>
                    <button class="btn btn-outline-danger" name="status" value="2">Reject</button>
                    
                </form>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->
<script>
$(document).ready(function(){
  $('#MybtnModal_{{$key}}').click(function(){
    $('#modal_{{$key}}').modal('show');
  });
});  
</script>
                        @endforeach
                        </table>
                        </div>

 </div>    
</div>



@endsection