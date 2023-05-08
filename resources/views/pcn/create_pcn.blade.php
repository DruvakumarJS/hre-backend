@extends('layouts.app')

@section('content')

@php
$date = date('dd-mm-yyyy');
@endphp
    
<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">Create PCN</label>
           <div id="div2">
            <a href="{{route('PCN')}}"><button class="btn btn-light" >View PCN</button></a>
            

          </div>
         
         @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
          @endif 

        </div>
        <div class="form-build">
            <div class="row">
                <div class="col-6">
                    <form method="Post" action="{{route('save_pcn')}}">
                        @csrf
                        <h3>Project Details</h3>
                        <div class="form-group row">
                            <label for="text" class="col-5 col-form-label">Project Code *</label>
                            <div class="col-7">
                                <input id="text" name="pcn" type="text" class="form-control" required="required" value="{{old('pcn')}}" placeholder="Enter PCN">
                                     @error('pcn')
                                   <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                 @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Client Name / Billing Name *</label>
                            <div class="col-7">
                                <input name="client_name" id="client_name" type="text" class="typeahead form-control" required="required" placeholder="Search by Client name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Brand Name *</label>
                            <div class="col-7">
                                <input id="brand" name="brand" type="text" class="form-control" readonly="readonly" required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Type of Work *</label>
                            <div class="col-7">
                                <select id="" name="work" class="custom-select form-control form-select" required="required">
                                    <option value="">Select type of work</option>
                                    <option value="Re-furbishment">Re-furbishment</option>
                                    <option value="Furniture Supply">Furniture Supply</option>
                                    <option value="New Project">New Project</option>
                                </select>
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
                             <label for="" class="col-5 col-form-label">Location *</label>
                             <div class="col-7 " id="location" >
                                 <input  class="form-control" type="text" required="required" readonly="readonly">
                             </div>
                        </div>
                       
                    
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">City *</label>
                            <div class="col-7">
                                <input id="city" class="form-control" type="text" name="city" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">State *</label>
                            <div class="col-7">
                               <input id="state" class="form-control" type="text" name="state" readonly="readonly">
                            </div>
                        </div>

                        <hr/>
                        <h3>Completion Details</h3>
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Proposed Project Start Date</label>
                            <div class="col-7">
                                <input id="start_date" name="start_date" type="text" class="form-control" placeholder="YYYY-MM-DD">
                                <script language="javascript">
                                   $( function() {
                                      $( "#start_date" ).datepicker({
                                       minDate:0,
                                        dateFormat: 'yy-mm-dd'
                                      });
                                    });

                                </script>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Proposed Project End Date</label>
                            <div class="col-7">
                                <input id="end_date" name="end_date" type="text" class="form-control"placeholder="YYYY-MM-DD"  onclick="getstartdate()">
                               
                        </div>
                         </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Targeted Days</label>
                            <div class="col-7">
                                <input id="" name="target_date" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text1" class="col-5 col-form-label">Actual Start Date</label>
                            <div class="col-7">
                                <input id="actual_start_date" name="actual_start_date" type="text" class="form-control" placeholder="YYYY-MM-DD">
                                <script language="javascript">
                                   $( function() {
                                      $( "#actual_start_date" ).datepicker({
                                       minDate:0,
                                        dateFormat: 'yy-mm-dd'
                                      });
                                    });

                                </script>
                            </div>
                             
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Actual Completed Date</label>
                            <div class="col-7">
                                <input id="actual_end_date" name="actual_end_date" type="text" class="form-control" placeholder="YYYY-MM-DD" onclick="getActualstartdate()">
                               
                        </div>
                         </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Project Hold Days</label>
                            <div class="col-7">
                                <input id="" name="hold_days" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text2" class="col-5 col-form-label">Actual Days Achived</label>
                            <div class="col-7">
                                <input id="text2" name="days_achieved" type="text" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="customer_id" id="customer_id">
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
