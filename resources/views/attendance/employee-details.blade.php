@extends('layouts.app')

@section('content')

<style type="text/css">
  thead th {
 
  height: 50px;
}
</style>


<div class="container-fluid">
    <div class="container-header">
        <label class="label-bold" id="div1">Current month Attendance</label>

        <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('attendance')}}"> View Today's Attendance</a>

        </div>

        

       <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('search_employee')}}" >
            @csrf
             <div class="input-group mb-3">
                <input class="form-control" type="text" id="search" name="search" placeholder="Search by Name / ID"  value="{{$search}}">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit"  >Search</button>
                </div>
              </div>
           </form>
          </div>

        <div id="div2" style="margin-right: 30px">
            <a  class="btn btn-light btn-outline-secondary" href="{{route('download_monthly_attendance')}}"> Download CSV</a>
        </div>
          
    </div>

    

    <div class="page-container">
        <div class="card border-white scroll tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

            <table class="table">
                <thead>
                <tr>
                   
                    <th scope="col">Employee ID</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Role</th>
                    <th scope="col">Days Present</th>
                   <!--  <th scope="col">Total Working Hours</th> -->
                    
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        
                        <td>{{$value['employee_id']}}</td>
                        <td>{{$value['name']}}</td>
                        <td>{{$value['mobile']}}</td>
                        <td>{{$value['role']}}</td>
                        <td>{{$value['days_present']}}</td>
                        <!-- @php
                          $minute = $value['working_hours'];
                          $hour=  floor($minute / 60) ;
                          $min = $minute % 60 ;
                        @endphp
                        @if($value['working_hours'] == '0')
                        <td>0 Min</td>
                        @else
                        <td>{{$hour}}Hr : {{$min}}Min</td>
                        @endif -->
                       
                        <td>
                           <a href="{{route('employee-history', $value['user_id'])}}"><button type="button" class="btn btn-sm curved-text">View Attendance</button></a>
                        </td>
                    </tr>

                    @endforeach


                    
                </tbody>
            </table>
             <label>Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }}
                    of {{$employees->total()}} results</label>

                
              <div class="float">{!! $employees->links('pagination::bootstrap-4') !!}</div>
        </div>
    </div>

</div>

<script type="text/javascript">
  $("#search").keyup(function(){
         //if($(this).val().length > 1)
            //$('#form :submit').click();
             $("#btn_search").click();
    });
</script>
@endsection
