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
                          <input class="form-control" type="input" name="unit" placeholder="Enter Units of Measurement" required="">
                          
                        </div>
                        
                      </div>

                      <div class="div-margin">
                        
                        <div class="RegSpLeft" id="phone">
                               
                            </div>

                            <div class="RegSpRight">
                               
                                 <a  class="div-margin pl btn btn-light" href="#"></i class="fa fa-plus"> </a>
                                 <a class="div-margin pl btn btn-light" href=""><i class="fa fa-plus"></i> 
                                   <label id="modal">Add </label>
                                 </a>

                            </div>

                             <button type="submit" class="btn btn-danger btn-sm mt-auto">Add Material</button>

                   
                       
                     </form>

                  
                        
                </div>
                    
                    </div>  

                        
                      </div>

                 </div>
           </div>
        </div>  
    </div>
</div>

<script type="text/javascript"></script>
    <script type="text/javascript">
    $(function() {
        $('a.pl').click(function(e) {
            e.preventDefault();
            $('#phone').append('<input class="div-margin " type="text" name="i1" placeholder="key"> <input class="div-margin " type="text" name="i2" placeholder="value"></br>');
        });
        $('a.mi').click(function (e) {
            e.preventDefault();
            if ($('#phone input').length > 1) {
                $('#phone').children().last().remove();
            }
        });
    });
    </script>


@endsection