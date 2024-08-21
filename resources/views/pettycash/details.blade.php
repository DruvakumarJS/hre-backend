@extends('layouts.app')

@section('content')

<style type="text/css">
  thead th {
 
  height: 50px;
}
</style>

<div class="container">
	<div class="row justify-content-center">
     <div class="container-header">
        <label class="label-bold" id="div1">Petty Cash Details</label>
        <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('pettycash')}}"> View PettyCash List</a>
        </div>

        <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('search_bills')}}" >
            @csrf
             <div class="input-group mb-3">
              <input type="hidden" name="filter" >
                <input type="hidden" name="user_id" value="{{$id}}">
                <input class="form-control" type="text" name="search" placeholder="Search" value="{{$search}}">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>

        @if($id == auth::user()->id)
        <div id="div2" style="margin-right: 30px">
            <a href="{{route('pettycash_expenses')}}"><button class="btn btn-light btn-outline-secondary">Upload Expenses</button></a>
        </div>

        <div id="div2" style="margin-right: 30px">
            <a onclick="return confirm('A mail will be sent to Finance department as a remainder for approval .')" href="{{route('pettycash_approval_reminder', auth::user()->id)}}"><button class="btn btn-light btn-outline-secondary">Send Reminder</button></a>
        </div>
        @endif



      
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
                <label>Staff Wallet Balance Amount</label>
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

         <div class="card border-white scroll tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>PC ID</th>
                                <th>Bill Date</th>
                                <th>Bill Number</th>
                                <th>Amount Utilised</th>
                                <th>Purpose</th>
                                <th>PCN</th>
                                <th width="170px">Narration</th>
                                <th>Proof</th>
                                <th width="140px">Status</th>
                                <th>Entry Date</th>
                                <th width="150px">Remarks</th>
                               
                                <th>Action</th>
                            </tr>
                            </thead>
                        @foreach($data as $key =>$value)
                                <tr>
                                    <td>{{$value->billing_no}}</td>
                                    <td width="100px">{{date("d-m-Y", strtotime($value->bill_date))}}</td>
                                    <td>{{$value->bill_number}}</td>
                                    <td><span>&#8377;</span>{{$value->spent_amount}}</td>
                                    <td>{{$value->purpose}}</td>
                                    <td>{{$value->pcn}}</td>
                                    <td>{{$value->comments}}</td>
                                    
                                    <td>
                                        @if($value->filename != '')
                                        <a id="MyproofModal_{{$key}}"><i class="fa fa-eye" style="color: black"></i></a> 

                                        <!-- <a download href="{{ URL::to('/') }}/pettycashfiles/{{$value->filename}}"><i class="fa fa-download" style="margin-left: 10px;color: black"></i></a> -->

                                        <a href="{{route('download_bills',$value->id)}}"><i class="fa fa-download" style="color: black"></i></a> 

                                        @endif
                                    </td>

                                   
                                    @if($value->isapproved == '0')
                                        <td style="color: blue">Awaiting approval</td>
                                    @elseif($value->isapproved == '1')
                                         <td style="color: green">Approved</td>
                                    @else 
                                         <td style="color: red">Rejected</td> 
                                    @endif
                                    <td width="100px">{{date("d-m-Y", strtotime($value->created_at))}}</td> 
                                    <td>{{$value->remarks}} {{$value->isactive }}</td>
                                    
                                  
                                    @if( ((strtotime($value->bill_date) > strtotime($closure_date)) OR (auth::user()->role_id == '1' AND $isactive == 'false') ) OR $closure_date == '')
                                     <td>

                                        @if($value->user_id == Auth::user()->id)
                                         @if($value->isapproved == '0')
                                       
                                        <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_expense',$value->id)}}"><button class="btn btn-sm btn-outline-danger">Delete</button></a> 
                                         
                                         @endif
                                        @endif 

                                         @if( (Auth::user()->role_id == '1') || (Auth::user()->role_id == '2') || (Auth::user()->role_id == '6') || (Auth::user()->role_id == '7') || (Auth::user()->role_id == '8'))
                                            @if($value->isapproved == '0')
                                                
                                                <a  id="MybtnModal_{{$key}}" data-bs-toggle="modal" data-bs-target="#importModal" href=""><button class="btn btn-sm btn-outline-secondary">Action</button></a>
                                              
                                            @endif
                                            @endif

                                            @if( ( Auth::user()->role_id == '1' OR Auth::user()->role_id == '2' OR Auth::user()->role_id == '6' ) && $value->isapproved != '0')   


                                               <a style="margin-top: 10px" id="MyrevertModal_{{$key}}" data-bs-toggle="modal" data-bs-target="#importModal" href=""><button class="btn btn-sm btn-outline-danger">Revert</button></a>  
                                            @endif
                                      </td> 
                                    @else
                                      <td> <button class="btn btn-sm btn-danger" disabled>Freezed</button></td>
                                    @endif  
                                   
                                   <!-- 
                                      @if( (Auth::user()->role_id == '1') && $value->isapproved != '0')
                                       <td>
                                         <a id="MyrevertModal_{{$key}}" data-bs-toggle="modal" data-bs-target="#importModal" href=""><button class="btn btn-sm btn-outline-danger">Revert</button></a>
                                        </td> 
                                      @endif -->
                                    

                                   </tr>

<!--Action  Modal -->
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
                            <label class="label-bold">Bill Date :</label> <label>{{date("d-m-Y", strtotime($value->bill_date))}} </label>   <label class="label-bold" style="margin-left: 20px">Bill Amount :</label> <label>{{$value->spent_amount}} </label>
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
<!-- Action Modal End  -->

<!-- Revert Modal -->
        <div class="modal fade" id="revertmodal_{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Revert Bill Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{ route('revert_bill_status') }}" >
                    @csrf

                    <div class="form-group ">
                            <label class="label-bold">Bill Date :</label> <label>{{date("d-m-Y", strtotime($value->bill_date))}} </label><label class="label-bold" style="margin-left: 20px">Bill Amount :</label> <label>{{$value->spent_amount}} </label>
                            <div>
                              <label class="label-bold">Remarks : </label> <label>{{$value->remarks}}</label>
                            </div>
                       
                    </div>

                     <textarea name="reason" placeholder="Enter reason for revert" style="width: 100%;padding: 10px" required></textarea> 

                    <input type="hidden" name="id" value="{{$value->id}}">
                     <input type="hidden" name="remarks" value="{{$value->remarks}}">
                    <input type="hidden" name="pre_status" value="{{$value->isapproved}}">

                    @if($value->isapproved == '2')
                    <button class="btn btn-success" name="status" value="1">Approve</button>
                    @endif
                    @if($value->isapproved == '1')
                    <button class="btn btn-danger" name="status" value="2">Reject</button>
                    @endif
                    
                </form>
              </div>
              
            </div>
          </div>
        </div>
<!-- Revert Modal End-->
<script>
$(document).ready(function(){
  $('#MybtnModal_{{$key}}').click(function(){
    $('#modal_{{$key}}').modal('show');
  });

  $('#MyrevertModal_{{$key}}').click(function(){
    $('#revertmodal_{{$key}}').modal('show');
  });
});  
</script>





<!-- proof -->

<!--  Modal -->
        <div class="modal fade" id="proof_{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bill Proof</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                @php
                $revertNames = explode(',', $value->filename);
                @endphp

              @foreach($revertNames as $key2=>$value2)
               @if(str_contains($value2, ".pdf"))
                <img class="imagen" id="blah" src="{{ URL::to('/') }}/images/pdf.png" alt="pettycashproof" style="width: 100px;height: 100px;margin: 10px" />
               @else
               <img class="imagen" id="blah" src="{{ URL::to('/') }}/pettycashfiles/{{$value2}}" alt="ticketimage" style="width: 400px;height: 250px" />
               @endif

               <a target="_blank" href="{{ URL::to('/') }}/pettycashfiles/{{$value2}}"><i class="fa fa-expand" style="color: black;font-size:30px;margin: 10px"></i></a> 

               <!-- <a download href="{{ URL::to('/') }}/pettycashfiles/{{$value2}}"><i class="fa fa-download" style="margin-left: 10px"></i></a> -->


             
               @endforeach
              
            </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->
<script>
$(document).ready(function(){
  $('#MyproofModal_{{$key}}').click(function(){
    $('#proof_{{$key}}').modal('show');
  });
});  
</script>

<!-- Proof -->
                        @endforeach
                        </table>
                        </div>

 </div>    
</div>



@endsection