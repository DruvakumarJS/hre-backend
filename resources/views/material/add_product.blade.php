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

        <div style="margin-top: 50px">
        
        	<label class="label-bold">Category  : {{$categoryData->category}}</label>
          <div>
             <label class="label-bold">Material Category : {{$categoryData->material_category}}</label>

          </div>
         
                <!--  <div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Material Id</th>
                              <th scope="col">Material Name</th>
                              <th scope="col">Make / Brand</th>
                              <th scope="col">Size</th>
                              <th scope="col">Thickness</th>
                              <th scope="col">Grade</th>
                              <th scope="col">Shade No</th>
                              <th scope="col">Unit</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            <tr>  
                              <td>Telescopic Draw Channel</td>
                              <td>EBCo</td>
                              <td>Sheet</td>
                              <td>EBCo</td>
                              <td>Sheet</td>
                              <td>EBCo</td>
                              <td>Sheet</td>
                              <td>EBCo</td>
                              
                            </tr>

                             
                             
                          </tbody>
                        </table>
                        
                    </div> -->
               

                    </div>

                    <div class="div-margin">
                      
                    

                     <form method="post" action="{{route('create_material')}}">

                      @csrf

                      <div class="row">

                        <div class="col-md-2">
                          <label>Material Name</label>
                        
                        </div>

                        <div class="col-md-2">
                          <label>Make / Brand</label>
                          
                        </div>

                         <div class="col-md-2">
                          <label>Size</label>    
                         </div>

                         <div class="col-md-2">
                          <label>Thickness</label>    
                         </div>

                         

                        <div class="col-md-2" style="margin-top: 20px">
                          
                        
                        </div>
                      </div>

                 
                      <div class="row">

                        <div class="col-md-2">
                         
                          <input type="text" name="name" placeholder="Enter Material Name">
                        </div>

                        <div class="col-md-2">
                          
                          <input type="text" name="brand" placeholder="Enter Make / Brand">
                        </div>

                         <div class="col-md-2"> 
                          <input type="text" name="size" placeholder="Enter Size">
                        </div>


                        <div class="col-md-2"> 
                          <input type="text" name="thickness" placeholder="Enter Thickness">
                        </div>
                         
                      </div>

                     <!--  2nd row -->

                     <div class="row" style="margin-top: 20px">

                      <div class="col-md-2">
                          <label>Grade</label>    
                         </div>

                         <div class="col-md-2">
                          <label>Shade No</label>    
                         </div>

                         <div class="col-md-2">
                          <label>Unit</label>    
                         </div>


                      </div>

                      <div class="row">

                        <div class="col-md-2"> 
                          <input type="text" name="grade" placeholder="Enter Grade">
                        </div>
                        <div class="col-md-2"> 
                          <input type="text" name="shade" placeholder="Enter Shade No">
                        </div>
                        <div class="col-md-2"> 
                          <input type="text" name="unit" placeholder="Enter Unit">
                        </div>
                        <input type="hidden" name="code" value="{{$categoryData->code}}">
                        
                        <div class="col-md-2" >
                          
                         <button type="submit" class="btn btn-danger btn-sm mt-auto">Add Material</button>
                        </div>

                      </div>


                      <!--  2nd row -->

                    </form> 
                    
                    </div>  

                        
                      </div>

                 </div>
           </div>
        </div>	
    </div>
</div>
@endsection