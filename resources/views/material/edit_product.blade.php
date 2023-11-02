@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Edit Material</label>
          
          
       
        </div>

        <div>
         <div class="div-margin">
           <label class="label-bold">Material ID  : {{$material_data->item_code}}</label>
         </div> 
        	

         
               </div>

                    <div class="div-margin">
                      
                     <form  method="post" action="{{route('update_product')}}">
                      @csrf
                      <div class="row">
                        <div class="col-md-4">
                          <label>Material Name *</label>
                          <input class="form-control" type="input" name="name" placeholder="Enter Material Name" required="" value="{{$material_data->name}}">
                          
                        </div>

                        <div class="col-md-4">
                          <label>Brand *</label>
                          <input class="form-control" type="input" name="brand" placeholder="Enter Material Brand" required=""  value="{{$material_data->brand}}">
                          
                        </div>

                        <div class="col-md-4">
                          <label>UoM *</label>
                          <input class="form-control" type="input" name="uom" placeholder="Enter Units of Measurement" required=""  value="{{$material_data->uom}}">
                      
                          
                        </div>
                         <input type="hidden" name="id" value="{{$material_data->item_code}}">
                        
                      </div>

                      <div class="div-margin">
                        
 <h5>Additional Specification ( Optional )</h5>
                        <table id="dynamicAddRemove">

                         @php
                         $information = json_decode($material_data->information , true);
                        
                         $i=1;

                         @endphp 

                         <input type="hidden" name="length" id="length" value="{{count($information)}}">

                         @foreach($information as $key => $value)
                         <label>{{$value}}</label>

                          <tr>
                            <td><input type="text" name="specifications[{{$i}}][spec]" placeholder="Enter param Name" class="form-control" value="{{$key}}" />
                            </td>

                            <td><input type="input" name="specifications[{{$i}}][value]" placeholder="Enter param Value" class="form-control" value="{{$value}}" />
                            </td>

                            <td>
                            <button type="button" class="btn btn-outline-danger remove-input-field">Delete</button>
                          </td>


                        </tr>
            
                       <!--  <tr>
                            <td><input type="text" name="{{$key}}" placeholder="Enter param Name" class="form-control" value="{{$key}}" />
                            </td>

                            <td><input type="text" name="{{$key}}" placeholder="Enter param Value" class="form-control" value="{{$value}}"/>
                            </td>

                          
                        </tr> -->
                        @php
                           $i++;
                        @endphp

                        @endforeach

                    </table>

                 <h5></h5>

                        
                    <table id="dynamicAddRemove">
            
                        <tr>
                           <!--  <td><input type="text" name="specifications[0][spec]" placeholder="Enter param Name" class="form-control" />
                            </td>

                            <td><input type="text" name="specifications[0][value]" placeholder="Enter param Value" class="form-control" />
                            </td> -->

                            <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-danger">Add </button></td>
                        </tr>
                    </table>
                  </div>
               <div class="div-margin">
                <button type="submit" class="btn btn-danger btn-sm mt-auto ">Update Material</button>
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
   // var i = 4;
    var i = $("#length").val();
  //  alert(i);
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td> <input type="text" name="specifications[' + i +
            '][spec]" placeholder="Enter param Name" class="form-control" /></td>  <td> <input type="text" name="specifications[' + i +
            '][value]" placeholder="Enter param Value" class="form-control" /></td>  <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></td></tr>'
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