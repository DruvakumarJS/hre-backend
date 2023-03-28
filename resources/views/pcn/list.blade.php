@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">PCN</label>
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

        <div style="margin-top: 50px">
        	<label style="margin-left: 20px">Customers</label>

        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">PCN</th>
                              <th scope="col">Customer Name</th>
                              <th scope="col">Customer Email</th>
                              <th scope="col">Address</th>
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            <tr>  
                              <td>PCN885</td>
                              <td>Prestige Apartment</td>
                              <td>prestige@prestige.com</td>
                              <td>Bangalore</td>
                              <td ><a href=""><label class="curved-text">View/Edit</label></a></td>
                            </tr>

                             <tr>  
                              <td>PCN885</td>
                              <td>Prestige Apartment</td>
                              <td>prestige@prestige.com</td>
                              <td>Bangalore</td>
                              <td ><a href=""><label class="curved-text">View/Edit</label></a></td>
                            </tr>

                             <tr>  
                              <td>PCN885</td>
                              <td>Prestige Apartment</td>
                              <td>prestige@prestige.com</td>
                              <td>Bangalore</td>
                              <td ><a href=""><label class="curved-text">View/Edit</label></a></td>
                            </tr>

                             <tr>  
                              <td>PCN885</td>
                              <td>Prestige Apartment</td>
                              <td>prestige@prestige.com</td>
                              <td>Bangalore</td>
                              <td ><a href=""><label class="curved-text">View/Edit</label></a></td>
                            </tr>

                             <tr>  
                              <td>PCN885</td>
                              <td>Prestige Apartment</td>
                              <td>prestige@prestige.com</td>
                              <td>Bangalore</td>
                              <td ><a href=""><label class="curved-text">View/Edit</label></a></td>
                            </tr>

                             <tr>  
                              <td>PCN885</td>
                              <td>Prestige Apartment</td>
                              <td>prestige@prestige.com</td>
                              <td>Bangalore</td>
                              <td ><a href=""><label class="curved-text">View/Edit</label></a></td>
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