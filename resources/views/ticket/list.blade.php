<!DOCTYPE html>
<html>
<head>
    <title>Laravel JQuery UI Autocomplete Search Example - ItSolutionStuff.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
     
<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">Create PCN</label>
           <div id="div2">
            <button class="btn btn-light" >View PCN</button>

          </div>
          <div id="div2" style="margin-right: 30px">
             <button class="btn btn-light" ><i class="fa fa-plus"></i>  Create PCN</button>
          </div>

           <div id="div3" style="margin-right: 30px">
             <button class="btn btn-light" > Download CSV</button>
          </div>


        </div>
        <div class="form-build">
            <div class="row">
                <div class="col-6">
                    <form>
                        <h3>Project Details</h3>
                        <div class="form-group row">
                            <label for="text" class="col-5 col-form-label">Project Code</label>
                            <div class="col-7">
                                <input id="text" name="text" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Client Name / Billing Name</label>
                            <div class="col-7">
                                <input name="client_name" id="client_name" type="text" class="typeahead form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Brand Name</label>
                            <div class="col-7">
                                <input id="brand" name="brand" type="text" class="form-control" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Type of Work</label>
                            <div class="col-7">
                                <select id="" name="" class="custom-select form-control">
                                    <option value="">Re-furbishment</option>
                                    <option value="">Furniture Supply</option>
                                    <option value="">New Project</option>
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
                             <label for="" class="col-5 col-form-label">Location</label>
                             <div class="col-7 " id="location">
                                 <input  class="form-control" type="text" name="" >
                             </div>
                        </div>
                       
                    
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">City</label>
                            <div class="col-7">
                                <input id="city" class="form-control" type="text" name="city">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">State</label>
                            <div class="col-7">
                               <input id="state" class="form-control" type="text" name="state">
                            </div>
                        </div>

                        <hr/>
                        <h3>Completion Details</h3>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Proposed Project Start Date</label>
                            <div class="col-7">
                                <input id="" name="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Proposed Project End Date</label>
                            <div class="col-7">
                                <input id="" name="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Target Date</label>
                            <div class="col-7">
                                <input id="" name="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text1" class="col-5 col-form-label">Actual Start Date</label>
                            <div class="col-7">
                                <input id="text1" name="text1" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Actual Completed Date</label>
                            <div class="col-7">
                                <input id="" name="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Project Hold Days</label>
                            <div class="col-7">
                                <input id="" name="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text2" class="col-5 col-form-label">Actual Days Achived</label>
                            <div class="col-7">
                                <input id="text2" name="text2" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-5 col-7">
                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                <button name="submit" type="submit" class="btn btn-link">Cancel</button>
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
           var address = ui.item.address ;
           console.log(address); 

          // address.forEach(myFunction);
          //  $('#address').val(ui.item.address);
          // console.log(ui.item); 
 
     var location = '<select   class="form-control">'
          address.forEach(function(item) {
               // console.log('III==',item);
               var name = item.area;
               location +=" <option data-city="+item.city+" data-state="+item.state+" value="+name+">"+ name +" </option>";

               /*$('#city').val(item.city);
               $('#state').val(item.state);*/
          });
          location += '</select>'; 
        
        $('#location').html(location);
      
           /*return false;*/
        }
      });

       /* $('#location select').on('change',function() {
             console.log('KUBLULJLJLJL');
          });*/
        $(document).on('change','#location select',function(){
    //alert('Change Happened');
    //alert($(this).find(':selected').attr('data-city'));
    $('#city').val($(this).find(':selected').attr('data-city'));
               $('#state').val($(this).find(':selected').attr('data-state'));

});

        
        
            

        // $('#loc_select').on('change', function(){

        //    alert( $(this).data('city'));
        // });
});

    function myFunction(){
        // alert('dkldk');
    }
     function setCity(){
        alert('dkldk');
         alert($(this).find(':selected').attr('data-city'));
    }
  
</script>
     
</body>
</html>