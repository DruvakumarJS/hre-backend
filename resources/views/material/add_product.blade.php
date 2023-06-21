@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Add Material</label>
           <div id="div2">
            <a  class="btn btn-light btn-outline-secondary" href="{{route('materials')}}"></i> View Material</a>
           
          </div>
          <div id="div2" style="margin-right: 30px">
             <a  class="btn btn-light btn-outline-secondary" href="{{route('materials_master')}}"></i> View Category</a>
          </div>
       
        </div>

        <div >
         <div>
           
         </div> 
        	<label class="label-bold">Category  : {{$categoryData->category}}</label>

          <div>
             <label class="label-bold">Category Code: {{$categoryData->material_category}}</label>

          </div>
             
               </div>

                    <div class="div-margin">
                      
                     <form  method="post" action="{{route('create_material')}}">
                      @csrf
                      <div class="row">
                        <div class="col-md-4">
                          <label>Material Name *</label>
                          <input class="form-control" type="input" name="name" placeholder="Enter Material Name" required="">
                          
                        </div>

                        <div class="col-md-4">
                          <label>Brand *</label>
                          <input class="form-control" type="input" name="brand" placeholder="Enter Material Brand" required="">
                          
                        </div>

                        <div class="col-md-4">
                          <label>UoM *</label>
                          <!-- <input class="typeahead form-control" id="uom" type="input" name="uom" placeholder="Enter Units of Measurement" required=""> -->
                          <input name="uom" id="uom" type="text" class="typeahead form-control" required="required" placeholder="Enter Units of Measurement">
                        <!--  <select class="form-control" name="uom" >
                           
                            @foreach ($unitmaster as $key => $value)
                                <option value="{{ $value->unit }}"> 
                                    {{ $value->unit }} 
                                </option>
                            @endforeach    
                        </select>  -->
                          
                        </div>
                         <input type="hidden" name="code" value="{{$categoryData->code}}">
                         <input type="hidden" name="category_id" value="{{$categoryData->material_category}}">
                        
                      </div>

                      <div class="div-margin">
                        <h5>Additional Specification ( Optional )</h5>
                        
                    <table id="dynamicAddRemove">
            
                        <tr>
                            <td><input type="text" name="specifications[0][spec]" placeholder="Enter param Name" class="form-control" />
                            </td>

                            <td><input type="text" name="specifications[0][value]" placeholder="Enter param Value" class="form-control" />
                            </td>

                           <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td>
                        </tr>

                    </table>
                    <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-danger div-margin">Add </button>
                  </div>
               <div class="div-margin">
                <button type="submit" class="btn btn-danger btn-sm mt-auto ">Add Material</button>
              </div>
                   
                       
                     </form>

                  
                        
                </div>
                    
                    </div>  

                        
                      </div>

                 </div>
           </div>
        </div>	
    </div>
</div>

<script type="text/javascript">

$( document ).ready(function() {

  var path = "{{ route('uoms') }}";
   let text = '<?php echo $categoryData->material_category  ?>';
  
    $( "#uom" ).autocomplete({

        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: text
            },
            success: function( data ) {
               response( data );
              
            }
          });
        },
        select: function (event, ui) {
           $('#uom').val(ui.item.label);
            
        }
     
});

  
});

</script>

<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td> <input type="text" name="specifications[' + i +
            '][spec]" placeholder="Enter param Name" class="form-control" /></td>  <td> <input type="text" name="specifications[' + i +
            '][value]" placeholder="Enter param Value" class="form-control" /></td>   <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        var del=confirm("Are you sure to delete ?");
          if (del==true){
              $(this).parents('tr').remove();
          }
    }); 

</script>




@endsection