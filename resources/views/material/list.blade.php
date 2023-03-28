@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Material Category</label>
           <div id="div2">
            <button class="btn btn-light" >View Material</button>
            
          </div>
          <div id="div2" style="margin-right: 30px">
             <button class="btn btn-light" ><i class="fa fa-plus"></i> Create Material</button>
          </div>

           <div id="div3" style="margin-right: 30px">
             <button class="btn btn-light" > Download CSV</button>
          </div>

            
        </div>

        <div style="margin-top: 50px">
        	<label style="margin-left: 20px">Material Category</label>

        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Material id</th>
                              <th scope="col">Material Category</th>
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            <tr>  
                              <td>M00001</td>
                              <td>Civil</td>
                              <td>
                              	<a href="{{route('add_product','M0001')}}"><label class="curved-text">Add Product</label></a>
                              	<a href="{{route('add_product','M0001')}}"><label class="curved-text">View Product</label></a>
                              </td>
                            </tr>

                             <tr>  
                              <td>M00001</td>
                              <td>Civil</td>
                              <td>
                              	<a href="{{route('add_product','M0001')}}"><label class="curved-text">Add Product</label></a>
                                <a href="{{route('add_product','M0001')}}"><label class="curved-text">View Product</label></a>
                              </td>
                            </tr>
                            
                             <tr>  
                              <td>M00001</td>
                              <td>Civil</td>
                              <td>
                              	<a href="{{route('add_product','M0001')}}"><label class="curved-text">Add Product</label></a>
                                <a href="{{route('add_product','M0001')}}"><label class="curved-text">View Product</label></a>
                              </td>
                            </tr>

                             <tr>  
                              <td>M00001</td>
                              <td>Civil</td>
                              <td>
                              	<a href="{{route('add_product','M0001')}}"><label class="curved-text">Add Product</label></a>
                                <a href="{{route('add_product','M0001')}}"><label class="curved-text">View Product</label></a>
                              </td>
                            </tr>

                             <tr>  
                              <td>M00001</td>
                              <td>Civil</td>
                              <td>
                              	<a href="{{route('add_product','M0001')}}"><label class="curved-text">Add Product</label></a>
                                <a href="{{route('add_product','M0001')}}"><label class="curved-text">View Product</label></a>
                              </td>
                            </tr>
                             
                          </tbody>
                        </table>
                        
                    </div>
                    <!--</div>-->
                 </div>
        </div>	
    </div>
</div>
@endsection