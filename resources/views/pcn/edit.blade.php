@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  
<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label" id="div1">Edit PCN : </label>
             <label class="label-bold" id="div1"> {{$id}}</label>
           
       </div>
                  

         @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
          @endif 

        </div>
        <div class="form-build">
            <div class="row">
                <div class="col-6">
                    <form method="Post" action="{{route('update_pcn')}}">
                        @csrf
                        <h3>Project Details</h3>
                        <div class="form-group row">
                            <label for="text" class="col-5 col-form-label">Project Code</label>
                            <div class="col-7">
                                <input id="text" name="pcn" type="text" class="form-control" required="required" value="{{$pcn_data->pcn}}" readonly="readonly">
                                     @error('pcn')
                                   <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                 @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Client Name / Billing Name</label>
                            <div class="col-7">
                                <input name="client_name" id="client_name" type="text" class="typeahead form-control" required="required" value="{{$pcn_data->client_name}}" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Brand Name</label>
                            <div class="col-7">
                                <input id="brand" name="brand" type="text" class="form-control" readonly="readonly" required="required" value="{{$pcn_data->brand}}" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Type of Work</label>
                            <div class="col-7">
                               <!--  <select id="" name="work" class="custom-select form-control form-select" required="required">
                                    <option value="">Select type of work</option>
                                    <option value="Re-furbishment">Re-furbishment</option>
                                    <option value="Furniture Supply">Furniture Supply</option>
                                    <option value="New Project">New Project</option>
                                </select> -->
                                <input class="form-control" type="text" name="work" value="{{$pcn_data->work}}" readonly="readonly">
                            </div>
                        </div>

                        <hr/>
                        <h3>Location Details</h3>

                      <!--   <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Location</label>
                            <div class="col-7">
                                <input id="location" name="location" type="text" class="form-control">
                            </div>
                            <div id="location"></div>
                        </div>

 -->
                        <div class="form-group row">
                             <label for="" class="col-5 col-form-label">Location</label>
                             <div class="col-7 " id="location" >
                                 <input  class="form-control" type="text" name="area" required="required" value="{{$pcn_data->area}}" readonly="readonly">
                             </div>
                        </div>
                       
                    
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">City</label>
                            <div class="col-7">
                                <input id="city" class="form-control" type="text" name="city" value="{{$pcn_data->city}}" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">State</label>
                            <div class="col-7">
                               <input id="state" class="form-control" type="text" name="state" value="{{$pcn_data->state}}" readonly="readonly">
                            </div>
                        </div>

                        <hr/>
                        <h3>Completion Details</h3>
                        <input type="hidden" name="created_date" id="created_date" value="{{$pcn_data->created_at->toDateString()}}">
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Proposed Project Start Date</label>
                            <div class="col-7">
                                <input id="start_date" name="start_date" type="text" class="form-control" value="{{$pcn_data->proposed_start_date}}" placeholder="YYYY-MM-DD" >
                                <script language="javascript">
                                   $( function() {
                                      $( "#start_date" ).datepicker({
                                       minDate:document.getElementById('created_date').value,
                                        dateFormat: 'yy-mm-dd'
                                      });
                                    });

                                </script>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Proposed Project End Date</label>
                            <div class="col-7"  >
                                <input id="end_date" name="end_date" type="text" class="form-control" value="{{$pcn_data->proposed_end_date}}" placeholder="YYYY-MM-DD" onclick="getstartdate()">
                                
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Provide Holiday</label>
                            <div class="col-7">
                                <select class="form-control form-select" required="required" name="holiday">
                                  <option value="">Select </option>
                                  <option value="Yes" <?php echo ($pcn_data->approve_holidays == 'Yes') ? 'selected' : ''; ?> >Yes</option>
                                  <option value="No" <?php echo ($pcn_data->approve_holidays == 'No') ? 'selected' : ''; ?> >No</option>
                                  
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Target Days</label>
                            <div class="col-7">
                                <input id="" name="target_date" type="text" class="form-control" value="{{$pcn_data->targeted_days}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text1" class="col-5 col-form-label">Actual Start Date</label>
                            <div class="col-7">
                                <input id="actual_start_date" name="actual_start_date" type="text" class="form-control" value="{{$pcn_data->actual_start_date}}" placeholder="YYYY-MM-DD">
                                 <script language="javascript">
                                   $( function() {
                                      $( "#actual_start_date" ).datepicker({
                                       minDate:document.getElementById('created_date').value,
                                        dateFormat: 'yy-mm-dd'
                                      });
                                    });

                                </script>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Actual Completed Date</label>
                            <div class="col-7">
                                <input id="actual_end_date" name="actual_end_date" type="text" class="form-control" value="{{$pcn_data->actual_completed_date}}" placeholder="YYYY-MM-DD" onclick="getActualstartdate()">
                                 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Project Hold Days</label>
                            <div class="col-7">
                                <input id="" name="hold_days" type="text" class="form-control" value="{{$pcn_data->hold_days}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text2" class="col-5 col-form-label">Actual Days Achived</label>
                            <div class="col-7">
                                <input id="text2" name="days_achieved" type="text" class="form-control" value="{{$pcn_data->days_acheived}}">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="text2" class="col-5 col-form-label">Status</label>
                            <div class="col-7">
                                <select class="form-control form-select" required="required" name="status">
                                  <option value="">Select Status</option>
                                   <option value="Active"  <?php echo ($pcn_data->status == 'Active') ? 'selected' : ''; ?> >Active</option>
                                  <option value="Pending"  <?php echo ($pcn_data->status == 'Pending') ? 'selected' : ''; ?> >Pending</option>
                                  <option value="Completed"  <?php echo ($pcn_data->status == 'Completed') ? 'selected' : ''; ?> >Completed</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="customer_id" id="customer_id" value="{{$pcn_data->customer_id}}">
                        <div class="form-group row">
                            <div class="offset-5 col-7">
                                <button name="submit" type="submit" class="btn btn-success">Update</button>
                               <a href="{{route('PCN')}}"><button name="submit" type="submit" class="btn btn-light">Cancel</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">

$( document ).ready(function() {
    var path = "{{ route('autocomplete') }}";
   let text = "";
    $( "#client_name" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
               response( data );
              
            }
          });
        },
        select: function (event, ui) {
           $('#client_name').val(ui.item.label);
            $('#brand').val(ui.item.brand);
            $('#customer_id').val(ui.item.id);

           var address = ui.item.address ;
           console.log(address); 

     var location = '<select class="form-control form-select" name="area" required="required"> <option value=""> Select Area</option>'
          address.forEach(function(item) {
               // console.log('III==',item)A
               var name = item.area;
               location +=" <option data-city="+item.city+" data-state="+item.state+" value='"+name+"'>"+ name +" </option>";
       });
          location += '</select>'; 
        
        $('#location').html(location);
      
           /*return false;*/
        }
      });

    
        $(document).on('change','#location select',function(){
  
               $('#city').val($(this).find(':selected').attr('data-city'));
               $('#state').val($(this).find(':selected').attr('data-state'));

});

  
});

</script>


<script type="text/javascript">
  $(function(){
      
      var minDate = document.getElementById('created_date').value;
      var dtToday = minDate;

      var month = dtToday.getMonth() + 1;
      alert(month)
      var day = dtToday.getDate();
      var year = dtToday.getFullYear();
      if(month < 10)
          month = '0' + month.toString();
      if(day < 10)
       day = '0' + day.toString();
      var maxDate = year + '-' + month + '-' + day;
      // var maxDate = document.getElementById('created_date').value;
      $('#start_date').attr('min', maxDate);
  });
  </script>

 
  <script type="text/javascript">
  
     function getstartdate(){
         $("#end_date" ).datepicker({
           minDate:document.getElementById('start_date').value,
            dateFormat: 'yy-mm-dd'
          });
       
          
     }

     function getActualstartdate(){
         $("#actual_end_date" ).datepicker({
           minDate:document.getElementById('actual_start_date').value,
            dateFormat: 'yy-mm-dd'
          });
       

     }
   
  </script>



@endsection
