@extends('layouts.app')

@section('content')

<div class="container" >
    <div class="row ">
        <div >
            <!-- <div class="c ard">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div> -->

        <div class="container-header">
            <label class="label-bold" id="div1">Dashboard</label>

            <div id="div2">
             <div class="badge badge-danger border border-secondary label-bold" style="margin-right: 30px">
             <span style="color: black;">{{date('d M Y')}}</span>
           <span id="current-time-now" data-start="<?php echo time() ?>" style="color: black;"></span>
           </div>
          </div> 
             
        </div>
   
       <div class="row">
                <div class="col-sm-6 col-md-4 " onclick="indents();">
                    <div class="card border-white">
                        <div class="card-body">
                            <img src="{{ asset('images/indent.png') }}" alt="intend" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="float:right;font-weight: bolder; font-size: 40px ; ">{{$todaysIndent}}</h2>
                        </div>
                       <div>
                            <h4 class="card-text-black" style="float:left;font-size: 25px; font-weight: bolder;">Indents</h4>
                           
                        </div>
                         <label class="card-text-label ">Today's Indent</label>

                    </div>
                    <!--</div>-->
                </div>



                 <div class="col-sm-6 col-md-4"  onclick="indents();">
                    <div class="card border-black" style="background-color: #5A5A5A">
                        <div class="card-body" >
                            <img src="{{ asset('images/indent.png') }}" alt="attendance" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="color:#fff;float:right;font-weight: bolder; font-size: 40px ; ">{{$compltedCount}}</h2>
                        </div>
                       <div>
                            <h4 class="card-text-black" style="float:left;font-size: 25px; font-weight: bolder;color: #fff">Completed Indents</h4>
                           
                        </div>
                         <label class="card-text-label" style="color: #fff">Today's Completed Indent</label>
                        
                    </div>
                    <!--</div>-->
                </div>


                 <div class="col-sm-6 col-md-4 "  onclick="grn();">
                    <div class="card border-white">
                        <div class="card-body">
                            <img src="{{ asset('images/indent.png') }}" alt="ticket" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="float:right;font-weight: bolder; font-size: 40px ; ">{{$grn}}</h2>
                        </div>
                        <div>
                           <h4 class="card-text-black" style="float:left;font-size: 25px; font-weight: bolder;">GRNs</h4>
                            
                        </div>
                         <label class="card-text-label ">Today's Dispatches </label>
                       
                    </div>
                   
                </div>


              
            </div>

 <!-- PCN & Pie chart -->
 @if(sizeof($result)>0)  
      <div class="row justify-content-between">
        <div class="col-md-6 col-sm-6">

          <div class="card border-white scroll tableFixHead" style="height: 350px; padding: 0px 5px 20px 20px">

                        <table class="table" >
                          <thead >
                            <tr >
                              <th scope="col">Billing Name</th>
                              <th scope="col">PCN</th>
                              <th scope="col">Pending Indent</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($result as $key =>$value)
                              @php
                                 
                                  $sum = 0;
                              @endphp
                           
                            <tr>  
                              <td>{{$key}}</td>
                            
                            <td>
                              <table>
                              @foreach($value as $kk => $val)
                              <tr> 
                                  <td>  {{ $kk }} </td>
                              </tr>
                              @endforeach
                            </table>
                             </td>
                             <td>
                              <table>
                              @foreach($value as $kk => $val)
                              @php 
                                 $sum += $val['0'];
                              @endphp
                              <tr> 
                                  <td>  {{ $val['0'] }} </td>
                              </tr>
                              @endforeach
                              @php 
                                if($sum > 0){
                                 $xvalue[] = $key;
                                 $yvalue[] = $sum;
                                }
                              @endphp
                            </table>
                             </td>
                            
                           @endforeach 

                          </tbody>
                        </table>
                    </div>
          
        </div>

        <div class="col-md-6 col-sm-6">
          <div class="card border-white" style="height: 350px">
               <label class="label-bold">Pending Intends</label>
                         
               <div>
                 <canvas id="myChart" ></canvas>
               </div>
                   
          </div>
          
        </div>
        
      </div>

       <script>
 
var xValues = <?php echo json_encode($xvalue); ?>;
var yValues = <?php echo json_encode($yvalue); ?>;
Chart.defaults.global.defaultFontStyle = 'bold';
var barColors = [
  "#2C2C2C",
  "#FDF2DF",
  "#E31E24"
 
];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: getRandomColor(),
      borderWidth: 0, 
      data: yValues
    }]
  },
  options: {
     legend: {
        position: 'right',
        labels: {
              fontSize: 8
        },
      },
    title: {
      display: true
     
    }
  }
});

function getRandomColor() { //generates random colours and puts them in string
  var colors = [];
  var size = <?php echo sizeof($yvalue); ?> ;
  for (var i = 0; i < size; i++) {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var x = 0; x < 6; x++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    colors.push(color);
  }
  return colors;
}

</script>
 @endif  

            <div>
                <label>Recent Indent</label>

                <div class="row">
                  <div class="col-sm-6 col-md-12">
                    <div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Date</th>
                              <th scope="col">Indend Number</th>
                              <th scope="col">PCN</th>
                              <th scope="col">Indent Owner</th>
                              <th scope="col">Status</th>
                             
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($indents as $key =>$value)
                            <tr>  
                                <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                                <td>{{$value->indent_no}}</td> 
                                <td>{{$value->pcn}}</td>  
                                <td>{{$value->user->name}}</td>  
                                <td>{{$value->status}}</td>
                                
                            </tr>
                            @endforeach
     
                          </tbody>
                        </table>
                        
                    </div>
                   
                 </div>

                
                    
                </div>
            </div>



    </div>
</div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var freshTime = new Date(parseInt($("#current-time-now").attr("data-start"))*1000);
    //loop to tick clock every second
    var func = function myFunc() {
        //set text of clock to show current time
        $("#current-time-now").text(freshTime.toLocaleTimeString());
        //add a second to freshtime var
        freshTime.setSeconds(freshTime.getSeconds() + 1);
        //wait for 1 second and go again
        setTimeout(myFunc, 1000);
    };
    func();
});


</script>

<!-- PIE CHART -->

<script type="text/javascript">
  
  function indents(){
    document.location.href="indents";
  }

  
   function grn(){
    document.location.href="grn";
  }
</script>



@endsection
