@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  
<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">Edit PCN  </label>
             
           
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
                            <label for="" class="col-5 col-form-label">P.O Number *</label>
                            <div class="col-7">
                                <input name="po_number" id="po_number" type="text" class="typeahead form-control" required="required" value="{{$pcn_data->po}}" placeholder="Enter P.O Number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Client Name / Billing Name</label>
                            <div class="col-7">
                                <input name="client_name" id="client_name" type="text" class="typeahead form-control" required="required" value="{{$pcn_data->client_name}}" >
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
                                <input class="form-control" type="text" name="work" value="{{$pcn_data->work}}" >
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
                             <label for="" class="col-5 col-form-label">Brand *</label>
                             <div class="col-7 " id="location" >
                                 <input  class="form-control" type="text" name="brand" required="required" value="{{$pcn_data->brand}}" readonly="readonly">
                             </div>
                        </div>

                         <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Location *</label>
                            <div class="col-7">
                                <input  class="form-control" type="text" name="loc" value="{{$pcn_data->location}}" required >
                            </div>
                        </div>

                        <div class="form-group row">
                             <label for="" class="col-5 col-form-label">Building / Area *</label>
                             <div class="col-7 " >
                                 <input  class="form-control" type="text" name="area" required="required" value="{{$pcn_data->area}}" >
                             </div>
                        </div>
                       
                    
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">City *</label>
                            <div class="col-7">
                                <input id="city" class="form-control" type="text" name="city" value="{{$pcn_data->city}}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">PINCODE *</label>
                            <div class="col-7">
                                <input id="city" class="form-control" type="text" name="pincode" value="{{$pcn_data->pincode}}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">State *</label>
                            <div class="col-7">
                               <input id="state" class="form-control" type="text" name="state" value="{{$pcn_data->state}}" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">GST No. *</label>
                            <div class="col-7">
                               <input id="gst" class="form-control" type="text" name="gst" value="{{$pcn_data->gst}}" readonly="readonly">
                            </div>
                        </div>

                        <hr/>
                        <h3>Completion Details</h3>
                        <input type="hidden" name="created_date" id="created_date" value="{{$pcn_data->created_at->toDateString()}}">
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Proposed Project Start Date</label>
                            <div class="col-7">
                                <input id="start_date" name="start_date" type="text" class="form-control" value="<?php  echo ($pcn_data->proposed_start_date !='')? date('d-m-Y', strtotime($pcn_data->proposed_start_date)) : ''?>" placeholder="Select Proposed Start Date" autocomplete="off">
                                
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Proposed Project End Date</label>
                            <div class="col-7"  >
                                <input id="end_date" name="end_date" type="text" class="form-control" value="<?php  echo ($pcn_data->proposed_end_date !='')? date('d-m-Y', strtotime($pcn_data->proposed_end_date)) : ''?>" placeholder="Select Proposed End Date" onclick="set_enddate()" autocomplete="off">
                                
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Provide Holiday</label>
                            <div class="col-7">
                                <select class="form-control form-select"  name="holiday">
                                  <option value="">Select </option>
                                  <option value="Yes" <?php echo ($pcn_data->approve_holidays == 'Yes') ? 'selected' : ''; ?> >Yes</option>
                                  <option value="No" <?php echo ($pcn_data->approve_holidays == 'No') ? 'selected' : ''; ?> >No</option>
                                  
                                </select>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label id="lbl_approve" for="" class="col-5 col-form-label" style="display: <?php echo ($pcn_data->approve_holidays == 'Yes') ? 'block' : 'none'; ?>">Approved Holidays</label>
                            <div class="col-7" id="">
                                <input id="inp_approve" name="approved_holidays" type="number" class="form-control" value ="{{$pcn_data->approved_days}}" min="0" style="display: <?php echo ($pcn_data->approve_holidays == 'Yes') ? 'block' : 'none'; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="text1" class="col-5 col-form-label">Actual Start Date</label>
                            <div class="col-7">
                                <input id="actual_start_date" name="actual_start_date" type="text" class="form-control" value="<?php  echo ($pcn_data->actual_start_date !='')? date('d-m-Y', strtotime($pcn_data->actual_start_date)) : ''?>" placeholder="Select Actual Start Date" autocomplete="off">
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Actual Completed Date</label>
                            <div class="col-7">
                                <input id="actual_end_date" name="actual_end_date" type="text" class="form-control" value="<?php  echo ($pcn_data->actual_completed_date !='')? date('d-m-Y', strtotime($pcn_data->actual_completed_date)) : ''?>" placeholder="Select Actual End Date" onclick="set_actual_enddate()" autocomplete="off">
                                 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Actual Hold Days / Holidays</label>
                            <div class="col-7">
                                <input id="" name="hold_days" type="number" class="form-control" value="{{$pcn_data->hold_days}}" placeholder="Enter Hold Days">
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label for="text2" class="col-5 col-form-label">Actual Days Achived</label>
                            <div class="col-7">
                                <input id="text2" name="days_achieved" type="text" class="form-control" value="{{$pcn_data->days_acheived}}">
                            </div>
                        </div> -->

                        <!--  <div class="form-group row">
                            <label for="" class="col-5 col-form-label">DLP Date</label>
                            <div class="col-7">
                                <input id="dlp_date" name="dlp_date" type="text" class="form-control"  value="{{$pcn_data->dlp_date}}" placeholder="Select DLP Date">
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label"  id="dlp_label"  style="display: none">DLP Applicable ?</label>
                            <div class="col-7"  id="dlp_div"  style="display: none">
                                <select class="form-control form-select"  name="dlp_applicable">
                                  <option value="">Select </option>
                                  <option value="1" <?php echo ($pcn_data->dlp_applicable == '1') ? 'selected' : ''; ?> >Yes</option>
                                  <option value="0" <?php echo ($pcn_data->dlp_applicable == '0') ? 'selected' : ''; ?> >No</option>
                                  
                                </select>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label id="lbl_dlp_days" for="" class="col-5 col-form-label" style="display: <?php echo ($pcn_data->dlp_applicable == '1') ? 'block' : 'none'; ?>">DLP Days</label>
                            <div class="col-7" id="">
                                <input id="in_dlp_days" name="dlp_days" type="number" class="form-control" value ="{{$pcn_data->dlp_days}}" min="0" style="display: <?php echo ($pcn_data->dlp_applicable == '1') ? 'block' : 'none'; ?>">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="text2" class="col-5 col-form-label">Status</label>
                            <div class="col-7">
                                <select class="form-control form-select" required="required" name="status">
                                  <option value="">Select Status</option>
                                   <option value="Active"  <?php echo ($pcn_data->status == 'Active') ? 'selected' : ''; ?> >Active</option>
                                  
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
            //$('#brand').val(ui.item.brand);
            $('#customer_id').val(ui.item.id);

           var address = ui.item.address ;
           console.log(address); 

     var location = '<select class="form-control form-select" name="brand" required="required"> <option value=""> Select Brand</option>'
          address.forEach(function(item) {
               // console.log('III==',item)A
               var name = item.brand + " , " + item.state;
               var brand = item.brand ;
               location +=" <option data-gst="+item.gst+" data-state="+item.state+" value='"+brand+"'>"+ name +" </option>";
       });
          location += '</select>'; 
        
        $('#location').html(location);
      
           /*return false;*/
        }
      });

    
        $(document).on('change','#location select',function(){
  
              // $('#city').val($(this).find(':selected').attr('data-city'));
               $('#state').val($(this).find(':selected').attr('data-state'));
               $('#gst').val($(this).find(':selected').attr('data-gst'));

});

    
        $(document).on('change','#location select',function(){
  
                $('#state').val($(this).find(':selected').attr('data-state'));
               $('#gst').val($(this).find(':selected').attr('data-gst'));

});

        var s_date = document.getElementById('start_date').value;
        if(s_date!=''){

           $("#end_date" ).datepicker({
         //  minDate:document.getElementById('start_date').value,
            dateFormat: 'dd-mm-yy'
          });
        }


         var s_date = document.getElementById('start_date').value;
        if(s_date!=''){
           $("#actual_end_date" ).datepicker({
          // minDate:document.getElementById('actual_start_date').value,
            dateFormat: 'dd-mm-yy',
            onSelect: function(dateText, $el) {
        // alert(dateText);
         document.getElementById('dlp_label').style.display="block";
         document.getElementById('dlp_div').style.display="block";
         }

          });
        }

        var end_date = document.getElementById('end_date').value;
        if(s_date!=''){
           $("#dlp_date" ).datepicker({
           minDate:document.getElementById('end_date').value,
            dateFormat: 'dd-mm-yy'
          });
        }

       var ActualEndDate = document.getElementById('actual_end_date').value;
     // alert(ActualEndDate);

      if(ActualEndDate != ''){
        document.getElementById('dlp_label').style.display="block";
        document.getElementById('dlp_div').style.display="block";
      }

        

     $('select').on('change', function() {

         if(this.value == "Yes"){
            document.getElementById("lbl_approve").style.display= "block" ;
            document.getElementById("inp_approve").style.display= "block" ;
            document.getElementById("inp_approve").required = true;

         }
         if(this.value == "No") {
            document.getElementById("lbl_approve").style.display= "none" ;
            document.getElementById("inp_approve").style.display= "none" ;
            document.getElementById("inp_approve").required = false;
         }
         if(this.value == "1"){
            document.getElementById("lbl_dlp_days").style.display= "block" ;
            document.getElementById("in_dlp_days").style.display= "block" ;
            document.getElementById("in_dlp_days").required = true;

         }
        if(this.value == "0"){
             document.getElementById('in_dlp_days').value='';
            document.getElementById("lbl_dlp_days").style.display= "none" ;
            document.getElementById("in_dlp_days").style.display= "none" ;
            document.getElementById("in_dlp_days").required = false;

         }
   
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

 
  <!-- <script type="text/javascript">
  
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

     $( function() {
      $( "#actual_start_date" ).datepicker({
       minDate:0,
        dateFormat: 'yy-mm-dd',
        onSelect: function(dateText, $el) {
        //  alert(dateText);
          setactualenddate(dateText);


        }
      });
    });


     function setactualenddate(dateText){
         $("#actual_end_date" ).datepicker({
           minDate:dateText,
            dateFormat: 'yy-mm-dd'
          });
      
     }

   
  </script> -->

  <script language="javascript">

    $( function() {
      $("#start_date").datepicker({
      // minDate:0,
        dateFormat: 'dd-mm-yy',
        onSelect: function(dateText, $el) {
         
          setenddate(dateText);
          
        }
      });
    });

    function setenddate(dateText){
     
         $("#end_date").datepicker({
         //  minDate:'2023-06-30',
            dateFormat: 'dd-mm-yy',
             onSelect: function(dateText, $el) {
         // alert(dateText);
              setDLPdate(dateText);
              
            }
          });
      
     }

      function setDLPdate(dateText){
         $("#dlp_date" ).datepicker({
           minDate:dateText,
            dateFormat: 'dd-mm-yy' 
          });
      
     }

  
 $( function() {
      $( "#actual_start_date" ).datepicker({
      // minDate:0,
        dateFormat: 'dd-mm-yy',
        onSelect: function(dateText, $el) {
        //  alert(dateText);
          setactualenddate(dateText);


        }
      });
    });

 function setactualenddate(dateText){
         $("#actual_end_date" ).datepicker({
          // minDate:dateText,
            dateFormat: 'dd-mm-yy'
          });
      
     }


  
     function set_enddate(){

         $("#end_date" ).datepicker({
         // minDate:document.getElementById('start_date').value,
            dateFormat: 'dd-mm-yy'
          });
       
          
     }

      function set_actual_enddate(){
      
         $("#actual_end_date" ).datepicker({
          // minDate:document.getElementById('actual_start_date').value,
            dateFormat: 'dd-mm-yy',
            onSelect: function(dateText, $el) {
        // alert(dateText);
         document.getElementById('dlp_label').style.display="block";
         document.getElementById('dlp_div').style.display="block";


        }
            
          });
       
          
     }
  </script>
  <script type="text/javascript">
    
    
  </script>



@endsection
