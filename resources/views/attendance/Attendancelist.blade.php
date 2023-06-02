@extends('layouts.app')

@section('content')
<style>

</style>


<div class="container">
    <div class="container-header">
        <label class="label-bold" id="div1">Attendance</label>

        <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href=""><i class="fa fa-plus"></i> Create Employee</a>

        </div>

        <div id="div2" style="margin-right: 30px">
            <a  class="btn btn-light btn-outline-secondary" href="{{route('employee-details')}}"> View Employees</a>
        </div>

        <div id="div2" style="margin-right: 30px">
            <a  class="btn btn-light btn-outline-secondary" href="{{route('download_monthly_attendance')}}"> Download</a>
        </div>

        
       
    </div>

    <label>Today's Attendance</label>
   
    <div class="row">
        <div class="card border-white">

            <table class="table">
                <thead>
                <tr>
                   
                    <th scope="col">Employee ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Login </th>
                    <th scope="col">Logout</th>
                    <th scope="col">Total Hours</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($attendance as $key=>$value)
                    <tr>
                       
                        <td>{{$value->employee->employee_id}}</td>
                        <td>{{$value->employee->name}}</td>
                        <td>{{$value->user->roles->alias}}</td>
                        <td>{{$value->login_time}}</td>
                        <td>{{$value->logout_time}}</td>
                        @php
                          $minute = $value->total_hours;
                          $hour=  floor($minute / 60) ;
                          $min = $minute % 60 ;
                        @endphp
                        @if($value->total_hours == '0')
                        <td></td>
                        @else
                        <td>{{$hour}}Hr : {{$min}}Min</td>
                        @endif
                        
                        <td>
                            <a href="{{route('employee-history', $value->user_id)}}"><button type="button" class="btn btn-sm curved-text">view</button></a>
                        </td>
                    </tr>
                   @endforeach 
                </tbody>
            </table>

            <label>Showing {{ $attendance->firstItem() }} to {{ $attendance->lastItem() }}
                                    of {{$attendance->total()}} results</label>

                                {!! $attendance->links('pagination::bootstrap-4') !!}

        </div>
    </div>

</div>

<script type="text/javascript">
 var initialMouse = 0;
var slideMovementTotal = 0;
var mouseIsDown = false;
var slider = $('#slider');

slider.on('mousedown touchstart', function(event){
  mouseIsDown = true;
  slideMovementTotal = $('#button-background').width() - $(this).width() + 10;
  initialMouse = event.clientX || event.originalEvent.touches[0].pageX;
});

$(document.body, '#slider').on('mouseup touchend', function (event) {
  if (!mouseIsDown)
    return;
  mouseIsDown = false;
  var currentMouse = event.clientX || event.changedTouches[0].pageX;
  var relativeMouse = currentMouse - initialMouse;

  if (relativeMouse < slideMovementTotal) {
    $('.slide-text').fadeTo(300, 1);
    slider.animate({
      left: "-10px"
    }, 300);
    return;
  }
  slider.addClass('unlocked');
  $('#locker').text('lock_outline');
  setTimeout(function(){
    slider.on('click tap', function(event){
      if (!slider.hasClass('unlocked'))
        return;
      slider.removeClass('unlocked');
      $('#locker').text('lock_open');
      slider.off('click tap');
    });
  }, 0);
});

$(document.body).on('mousemove touchmove', function(event){
  if (!mouseIsDown)
    return;

  var currentMouse = event.clientX || event.originalEvent.touches[0].pageX;
  var relativeMouse = currentMouse - initialMouse;
  var slidePercent = 1 - (relativeMouse / slideMovementTotal);
  
  $('.slide-text').fadeTo(0, slidePercent);

  if (relativeMouse <= 0) {
    slider.css({'left': '-10px'});
    return;
  }
  if (relativeMouse >= slideMovementTotal + 10) {
    slider.css({'left': slideMovementTotal + 'px'});
    return;
  }
  slider.css({'left': relativeMouse - 10});
});
</script>




@endsection
