@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Add Material</label>
           <div id="div2">
            <a  class="btn btn-light" href="{{route('materials')}}"></i> View Material</a>
           
          </div>
          <div id="div2" style="margin-right: 30px">
             <a  class="btn btn-light" href="{{route('materials_master')}}"></i> View Category</a>
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
                          <input class="form-control" type="input" name="uom" placeholder="Enter Units of Measurement" required="">
                          
                        </div>
                         <input type="hidden" name="code" value="{{$categoryData->code}}">
                        
                      </div>

                      <div class="div-margin">
                        <h5>Additional Specification ( Optional )</h5>
                        
                         <table id="dynamicAddRemove">
                <!-- <tr>
                    <th>Subject</th>
                    <th>marks</th>
                    <th>Action</th>
                </tr> -->
                        <tr>
                            <td><input type="text" name="specifications[0][spec]" placeholder="Enter param Name" class="form-control" />
                            </td>

                            <td><input type="text" name="specifications[0][value]" placeholder="Enter param Value" class="form-control" />
                            </td>

                            <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Subject</button></td>
                        </tr>
                    </table>
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
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td> <input type="text" name="specifications[' + i +
            '][spec]" placeholder="Enter param Name" class="form-control" /></td>  <td> <input type="text" name="specifications[' + i +
            '][value]" placeholder="Enter param Value" class="form-control" /></td>   <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>


@endsection