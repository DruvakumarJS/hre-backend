@extends('layouts.app')

@section('content')

@php
$date = date('dd-mm-yyyy');
@endphp
    
<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold " id="div1">Create PCN</label>
           <div id="div2">
            <a href="{{route('PCN')}}"><button class="btn btn-light btn-outline-secondary" >View PCN</button></a>
            

          </div>
         
         
        </div>

        @if(Session()->has('PCN'))
       <script>
        $(document).ready(function(){
            $('#modal').modal('show');
          });
        
        </script>

        <!--  Modal -->
          <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">PCN Created Succesfully</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  @php
                  $data= Session::get('PCN');

                  @endphp
                  <div>
                     <label>PCN : </label> <label class="label-bold">{{$data->pcn}}</label>
                  </div>
                   <div>
                     <label>Brand : </label> <label class="label-bold">{{$data->brand}}</label>
                  </div>
                   <div>
                     <label>Location : </label> <label class="label-bold">{{$data->location}}</label>
                  </div>
                   <div>
                     <label>Area : </label> <label class="label-bold">{{$data->area}}</label>
                  </div>
                   <div>
                     <label>City : </label> <label class="label-bold">{{$data->city}}</label>
                  </div>
                   <div>
                     <label>State : </label> <label class="label-bold">{{$data->state}}</label>
                  </div>
                  <div>
                     <label>PINCODE : </label> <label class="label-bold">{{$data->pincode}}</label>
                  </div>
                  
                   <div>
                     <label>Proposed Start Date : </label> <label class="label-bold">{{date("d-m-Y", strtotime($data->proposed_start_date))}}</label>
                  </div>
                  @if($data->proposed_end_date != "")
                   <div>
                     <label>Proposed End Date : </label> <label class="label-bold">{{date("d-m-Y", strtotime($data->proposed_end_date))}}</label>
                  </div>
                  @endif
                 

                  <div id="div2">
                    <a href="{{route('view_pcn')}}"><button class="btn btn-success">OK , GOT IT</button></a>
                    
                  </div>
                  
                </div>
                
              </div>
            </div>
          </div>
  <!-- Modal -->
    @endif
        <div class="form-build">
            <div class="row">
                <div class="col-6">
                    <form method="Post" action="{{route('save_pcn')}}">
                        @csrf
                        <h3>Project Details</h3>
                        <div class="form-group row">
                            <label for="text" class="col-5 col-form-label">Project Code *</label>
                            <div class="col-7">
                                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">PCN_</span>
                                    </div>
                                    <input id="text" name="pcn" type="number" class="form-control" required="required" placeholder="Enter PCN" value="{{old('pcn')}}">
                                   
                                  </div>
                                  @if(Session::has('message'))
                                   <div class="alert alert-danger mt-1 mb-1">{{ Session::get('message') }}</div>
                                 @endif

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">P.O Number *</label>
                            <div class="col-7">
                                <input name="po_number" id="po_number" type="text" class="typeahead form-control" required="required" value="{{old('po_number')}}" placeholder="Enter P.O Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Billing Name *</label>
                            <div class="col-7">
                                <input name="client_name" id="client_name" type="text" class="typeahead form-control" required="required" value="{{old('client_name')}}" placeholder="Search by Billing name">
                            </div>
                        </div>
                       <!--  <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Brand Name *</label>
                            <div class="col-7">
                                <input id="brand" name="brand" type="text" class="form-control" readonly="readonly" required="required">
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Type of Work *</label>

                            <div class="col-7">
                              <input  class="form-control" type="text" value="{{old('work')}}" name="work" 
                              placeholder="Enter type of work" required>
                               <!--  <select id="" name="work" class="custom-select form-control form-select" required="required">
                                    <option value="">Select type of work</option>
                                    <option value="Re-furbishment">Re-furbishment</option>
                                    <option value="Furniture Supply">Furniture Supply</option>
                                    <option value="New Project">New Project</option>
                                </select> -->
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
                                 <input  class="form-control" type="text" name="brand" required="required" value="{{old('brand')}}" readonly="readonly" placeholder="Brand Name">
                             </div>
                        </div>
                       
                       <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Location *</label>
                            <div class="col-7">
                                <input  class="form-control" type="text" name="loc" value="{{old('loc')}}" placeholder="Enter project location" required >
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Building / Area *</label>
                            <div class="col-7">
                                <input  class="form-control" type="text" name="building" value="{{old('building')}}" placeholder="Enter building / Area name" required >
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">City *</label>
                            <div class="col-7">
                                <input  class="form-control" type="text" name="city" value="{{old('city')}}" placeholder="Enter city name" required >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">PINCODE *</label>
                            <div class="col-7">
                                <input  class="form-control" type="number" name="pincode" value="{{old('pincode')}}" placeholder="Enter area PINCODE" required >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">State *</label>
                            <div class="col-7">
                               <input id="state" class="form-control" type="text" name="state" value="{{old('state')}}"  placeholder="State">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">GST No.*</label>
                            <div class="col-7">
                               <input id="gst" class="form-control" type="text" name="gst" value="{{old('gst')}}" readonly="readonly" placeholder="GST No.">
                            </div>
                        </div>

                        <hr/>
                        <h3>Completion Details</h3>
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Proposed Project Start Date</label>
                            <div class="col-7">
                                <input id="start_date" name="start_date" type="text" class="form-control" placeholder="Select Proposed Start Date" autocomplete="off" value="{{old('start_date')}}">
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Proposed Project End Date</label>
                            <div class="col-7">
                                <input id="end_date" name="end_date" type="text" class="form-control"placeholder="Select Proposed End Date" autocomplete="off" value="{{old('end_date')}}">
                               
                        </div>
                         </div>
                       <!--  <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Targeted Days</label>
                            <div class="col-7">
                                <input id="" name="target_date" type="text" class="form-control">
                            </div>
                        </div> -->

                         <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Provide Holiday ?</label>
                            <div class="col-7">
                                <select class="form-control form-select" id="holiday" name="holiday" value="{{old('holiday')}}" >
                                  <option value="">Select </option>
                                  <option value="Yes" {{(old('holiday')=='Yes')? 'selected':''}}>Yes</option>
                                  <option value="No" {{(old('holiday')=='No')? 'selected':''}}>No</option>
                                  
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label id="lbl_approve" for="" class="col-5 col-form-label" style="display: none">Approved Holidays</label>
                            <div class="col-7" id="">
                                <input id="inp_approve" name="approved_holidays" type="number" class="form-control" value="{{old('approved_holidays')}}"  min="0" style="display: none">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="text1" class="col-5 col-form-label">Actual Start Date</label>
                            <div class="col-7">
                                <input id="actual_start_date" name="actual_start_date" type="text" class="form-control" placeholder="Select Actual Start Date" autocomplete="off" value="{{old('actual_start_date')}}">
                               
                            </div>
                             
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Actual Completed Date</label>
                            <div class="col-7">
                                <input id="actual_end_date" name="actual_end_date" type="text" class="form-control" placeholder="Select Actual End Date" autocomplete="off" value="{{old('actual_end_date')}}">
                               
                        </div>
                         </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Actual Hold Days/Holidays</label>
                            <div class="col-7">
                                <input id="" name="hold_days" type="number" class="form-control"  value="{{old('hold_days')}}" placeholder="Enter Hold Days">
                            </div>
                        </div>

                        <div class="form-group row" >
                            <label for="" class="col-5 col-form-label" id="dlp_label"  style="display: none">DLP Applicable ?</label>
                            <div class="col-7" id="dlp_div"  style="display: none">
                                <select class="form-control form-select" id="dlp_applicable" name="dlp_applicable" value="{{old('dlp_applicable')}}" >
                                  <option value="">Select </option>
                                  <option value="1" {{(old('dlp_applicable')=='Yes')? 'selected':''}}>Yes</option>
                                  <option value="0" {{(old('dlp_applicable')=='No')? 'selected':''}}>No</option>
                                  
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label id="lbl_dlp_days" for="" class="col-5 col-form-label" style="display: none">DLP Days</label>
                            <div class="col-7" id="">
                                <input id="in_dlp_days" name="dlp_days" type="number" class="form-control" value="{{old('approved_holidays')}}"  min="0" style="display: none">
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="" class="col-5 col-form-label">DLP Date</label>
                            <div class="col-7">
                                <input id="dlp_date" name="dlp_date" type="text" class="form-control"  value="{{old('dlp_date')}}" placeholder="Select DLP Date">
                            </div>
                        </div> -->
                        
                        <input type="hidden" name="customer_id" id="customer_id" value="{{old('customer_id')}}">
                        <div class="form-group row">
                            <div class="offset-5 col-7">
                                <button name="submit" type="submit" class="btn btn-danger">Submit</button>
                                <a href="{{route('create_pcn')}}"><button name="submit" type="submit" class="btn btn-light">Cancel</button></a>
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

     var location = '<select class="form-control form-select" name="brand" value="{{old('brand')}}" required="required"> <option value=""> Select Brand</option>'
          address.forEach(function(item) {
               // console.log('III==',item)A

               var name = item.brand + " , " + item.state;
               var brand = encodeURIComponent(item.brand) ;   //item.brand ;
               /*location +=" <option data-gst="+item.gst+" data-state="+item.state+" value='"+brand+"'>"+ name +" </option>";*/
               location +=" <option data-gst="+item.gst+" data-state='"+item.state+"' value="+brand+">"+ name +" </option>";
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

      var ActualEndDate = document.getElementById('actual_end_date').value;
     // alert(ActualEndDate);

      if(ActualEndDate != ''){
        document.getElementById('dlp_label').style.display="block";
        document.getElementById('dlp_div').style.display="block";
      }


      var mode = document.getElementById("holiday").value;

      if(mode == "Yes"){
            document.getElementById("lbl_approve").style.display= "block" ;
            document.getElementById("inp_approve").style.display= "block" ;
            document.getElementById("inp_approve").required = true;

         }
         else {
            document.getElementById('inp_approve').value='';
            document.getElementById("lbl_approve").style.display= "none" ;
            document.getElementById("inp_approve").style.display= "none" ;
            document.getElementById("inp_approve").required = false;
         }


      var dlp = document.getElementById("dlp_applicable").value;

      if(dlp == "1"){
            document.getElementById("lbl_dlp_days").style.display= "block" ;
            document.getElementById("in_dlp_days").style.display= "block" ;
            document.getElementById("in_dlp_days").required = true;

         }
         else {
            document.getElementById('in_dlp_days').value='';
            document.getElementById("lbl_dlp_days").style.display= "none" ;
            document.getElementById("in_dlp_days").style.display= "none" ;
            document.getElementById("in_dlp_days").required = false;

         }   
   

     $('select').on('change', function() {
     // alert(this.value);

        if(this.value == "Yes"){
            document.getElementById("lbl_approve").style.display= "block" ;
            document.getElementById("inp_approve").style.display= "block" ;
            document.getElementById("inp_approve").required = true;

         }
        if(this.value == "No") {
            document.getElementById('inp_approve').value='';
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

<script language="javascript">
   $( function() {
      $( "#start_date" ).datepicker({
        //minDate:0,
        dateFormat: 'dd-mm-yy',
        onSelect: function(dateText, $el) {
         // alert(dateText);
          setenddate(dateText);
          
        }
      });
    });

     function setenddate(dateText){
         $("#end_date" ).datepicker({
         // minDate:dateText,
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
            dateFormat: 'dd-mm-yy',
            onSelect: function(dateText, $el) {
        // alert(dateText);
         document.getElementById('dlp_label').style.display="block";
         document.getElementById('dlp_div').style.display="block";


        }
          });
         
      
     }

  </script>

@endsection
