@extends('layouts.app')

@section('content')
<style type="text/css">
  thead th {
 
  height: 50px;
}
</style>

<div class="container-fluid">
     <div class="container-header">
        <label class="label-bold" id="div1">Petty Cash</label>
@if(Auth::user()->role_id == '1' OR Auth::user()->role_id == '6' OR Auth::user()->role_id == '7'  )

        <div id="div2" >
            <a class="btn btn-light btn-outline-secondary" href="{{route('create_new')}}"><i class="fa fa-plus"></i> Issue Petty Cash</a>
        </div>
@endif        
     
@if(Auth::user()->role_id == '1' OR Auth::user()->role_id == '2' OR Auth::user()->role_id == '6' OR Auth::user()->role_id == '7' OR Auth::user()->role_id == '8' )
        <div id="div2" style="margin-right: 30px">
           <form method="GET" action="{{route('search_pettycash')}}">
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

     <div class="page-container">
        <div class="card border-white table-wrapper-scroll-y tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

            <table class="table">
                <thead>
                <tr>
                    <th >Employee ID</th>
                    <th >Name</th>
                    <th >Role</th>
                    <th >Issued Amount</th>
                    <th >Balance Amount</th>          
                    <th >Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$value)
                    <tr>
                        <td>{{$value->employee->employee_id}}</td>
                        <td>{{$value->employee->name}}</td>
                        <td>{{$value->employee->user->roles->alias}}</td>
                        <td class="number">{{ $value['total_issued']}}</td>
                        <td class="number">{{$value['total_balance']}}</td>
                          @php
                         $size = sizeof($value->details);
                        @endphp
                      
                        <td>
                            <a href="{{route('view_summary',$value->user_id)}}"><button class="btn btn-sm btn-light btn-outline-secondary">Statement</button></a>
                            <a href="{{route('details_pettycash',$value->user_id)}}"><button class="btn btn-sm btn-outline-success">Transaction info</button></a>
                           
                            @if(Auth::user()->role_id == '1' OR Auth::user()->role_id == '2' OR Auth::user()->role_id == '6')
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

           <label>Showing {{ $data->firstItem() }} to {{ $data->lastItem() }}
                                    of {{$data->total()}} results</label>

            <div class="float">{!! $data->links('pagination::bootstrap-4') !!}</div>              

          

        </div>
    </div>
</div>

 <script>
    function formatNumberIndianStyle(number) {
        let numStr = number.toString();

        // Return the number as-is if it has 3 or fewer digits
        if (numStr.length <= 3) {
            return `₹${numStr}`; 
        }

        let lastThreeDigits = numStr.slice(-3);
        let remainingDigits = numStr.slice(0, -3);

        // Format the remaining digits with commas
        if (remainingDigits !== '') {
            remainingDigits = remainingDigits.replace(/\B(?=(\d{2})+(?!\d))/g, ",");
        }
       
        return `₹${remainingDigits + ',' + lastThreeDigits}`;

        
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        let numberCells = document.querySelectorAll('.number');
        numberCells.forEach((cell) => {
            let originalNumber = cell.textContent.trim(); // Get the original number
            let formattedNumber = formatNumberIndianStyle(originalNumber); // Format it
            cell.textContent = formattedNumber; // Update the table cell
        });
    });
</script>


@endsection