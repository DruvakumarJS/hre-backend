@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Add Products</label>
           <div id="div2">
            <button class="btn btn-light">View Material</button>
            
          </div>
          <div id="div2" style="margin-right: 30px">
             <button class="btn btn-light" ><i class="fa fa-plus"></i> Create Material</button>
          </div>
       
        </div>

        <div style="margin-top: 50px">
        
        	<label class="label-bold">Material id : {{$id}}</label>
          <div>
             <label class="label-bold">Material Name : House Keeping / Cleaning Material</label>

          </div>
         
                 <div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Material Name</th>
                              <th scope="col">Brand Name</th>
                              <th scope="col">Unit</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            <tr>  
                              <td>Telescopic Draw Channel</td>
                              <td>EBCo</td>
                              <td>Sheet</td>
                            </tr>

                             <tr>  
                              <td>Telescopic Draw Channel</td>
                              <td>EBCo</td>
                              <td>Sheet</td>
                            </tr>

                             <tr>  
                              <td>Telescopic Draw Channel</td>
                              <td>EBCo</td>
                              <td>Sheet</td>
                            </tr>
                             
                          </tbody>
                        </table>
                        
                    </div>
               

                    </div>

                      <div class="row">

                        <div class="col-md-2">
                          <label>Brand Name</label>
                        
                        </div>

                        <div class="col-md-2">
                          <label>Material Name</label>
                          
                        </div>

                         <div class="col-md-2">
                          <label>Unit</label>
                         
                        </div>

                        <div class="col-md-2" style="margin-top: 20px">
                          
                        
                        </div>
                      </div>


                      <div class="row">

                        <div class="col-md-2">
                         
                          <input type="text" name="brand" placeholder="Name">
                        </div>

                        <div class="col-md-2">
                          
                          <input type="text" name="brand" placeholder="Name">
                        </div>

                         <div class="col-md-2">
                          
                          <input type="text" name="brand" placeholder="Name">
                        </div>

                        <div class="col-md-2" >
                          
                         <button class="btn btn-danger btn-sm mt-auto">Add Material</button>
                        </div>
                      </div>


                      

                        
                      </div>

                 </div>
           </div>
        </div>	
    </div>
</div>
@endsection