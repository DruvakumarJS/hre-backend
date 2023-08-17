@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Materials</label>
           
          <div id="div2" >
            <a class="btn btn-light btn-outline-secondary" href="{{route('materials_master')}}"> View Category</a>
            
          </div>

           <div id="div2" style="margin-right: 30px" >
            <a data-bs-toggle="modal" data-bs-target="#importModal"  class="btn btn-light btn-outline-secondary" href=""><label id="modal">Import</label></a>
          </div>
          
         
          <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('search_material')}}">
            @csrf
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search here" value="{{$search}}">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>

           <div id="div3" style="margin-right: 30px">
            <div class="mb-3 d">
             
                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar" max="<?php echo date('Y-m-d');  ?>"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                </div>
            </div>
        </div>


          
           <div id="div3" style="margin-right: 30px">
             <a href=""></a>
             <form method="post" action="{{route('export-materials')}}">
              @csrf
              <input type="hidden" name="search" value="{{$search}}">
              <input type="hidden" name="start_date" id="start_date" >
              <input type="hidden" name="end_date" id="end_date" >
               <button class="btn btn-light btn-outline-secondary" > Download CSV</button>
             </form>
          </div>




            
        </div>

        
            @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
        @endif


        <div>
        

        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th scope="col">Material Id</th>
                              <th scope="col">Material Name</th>
                              <th scope="col">Make / Brand</th>
                              <th scope="col">UoM</th>
                              <th scope="col">Specifications</th>
                              
                              <th >Action</th>
                             
                             
                            </tr>
                          </thead>
                          <tbody>

                          @foreach($MaterialList as $key=>$value)
                            <tr>
                            <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>  
                              <td>{{$value->item_code}}</td>
                              <td>{{$value->name}}</td>
                              <td>{{$value->brand}}</td>
                              <td>{{$value->uom}}</td>
                              <td> <table>
                                <tbody>
                                  @php
                                   $info = json_decode($value->information);
                                  @endphp

                                  @foreach($info as $key => $val)
                                    
                                          <tr>
                                              <td>{{$key}} = {{$val}}</td>
                                          </tr>
                                     
                                  @endforeach
                                </tbody>
                              </table>
                            </td>
                              
                              <td>
                                  <a href="{{route('edit_product',$value->item_code)}}" > <button class="btn btn-light curved-text-button btn-sm">Edit</button></i></a>   
                             
                                  <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_product',$value->id)}}" > <button class="btn btn-light btn-outline-danger btn-sm">Delete</button></a>   
                              </td>
                              
                            </tr>
                          
                          @endforeach   
                             
                          </tbody>
                        </table>
                         <label>Showing {{ $MaterialList->firstItem() }} to {{ $MaterialList->lastItem() }} of {{$MaterialList->total()}} results</label>

                                {!! $MaterialList->links('pagination::bootstrap-4') !!}
                                       
                    </div>
                    <!--</div>-->
                 </div>
        </div>	
    </div>

   
</div>


<!-- Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Materials from Excel sheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('import_material') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <div class="custom-file text-left">
                            <input type="file" name="file" class="custom-file-input" id="customFile">
                           
                        </div>
                    </div>
                    <button class="btn btn-danger">Import</button>
                    
                </form>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->

<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
   // alert(start);
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>

<script type="text/javascript">
$(function() {
    
    var today = <?php echo date('d');  ?>;
    var dd= today-1;
    var start = moment().subtract(dd, 'days');
    var end = moment();

 /**/

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        
        var from_date = start.format('YYYY-MM-DD');
        var to_date = end.format('YYYY-MM-DD');
       // alert(from_date);

       document.getElementById('start_date').value=from_date
       document.getElementById('end_date').value=to_date;
        var id = document.getElementById('id').value;

        var _token = $('input[name="_token"]').val();
     
 }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);


    cb(start, end);
    
});

 
</script>

@endsection