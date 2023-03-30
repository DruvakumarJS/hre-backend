@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Indent</label>

            <label style="margin-left: 50px" class="label-medium" id="div1">pending(23)</label>

            <label  style="margin-left: 20px" class="label-medium" id="div1">|</label>
          
            <label  style="margin-left: 20px" class="label-medium" id="div1">Completed(488)</label>
          
          <div id="div2" style="margin-right: 30px">
             <button class="btn btn-light" > View All Tickets</button>
          </div>

           <div id="div3" style="margin-right: 30px">
             <button class="btn btn-light" > View All Intends</button>
          </div>

            
        </div>

        <div style="margin-top: 50px">
        	<label style="margin-left: 20px">Recent Indents</label>

        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Intend Number</th>
                              <th scope="col">Employee Id</th>
                              <th scope="col">Material Category</th>
                              <th scope="col">Material Name</th>
                              <th scope="col">Received</th>
                              <th scope="col">Pending</th>
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            <tr>  
                              <td>M001</td>
                              <td>EMP001</td>
                              <td>Hardware</td>
                              <td>Telephonic Draw Channel</td>
                              <td>20</td>
                              <td>15</td>
                              @if(Auth::user()->role_id == 2)
                              <td> <a href="{{route('indent_details','M001')}}"><label class="curved-text-button">View/Edit</label></a></td>
                              @elseif(Auth::user()->role_id == 3)
                              <td> <a href="{{route('update_intends','M001')}}"><label class="curved-text-button">View/Edit</label></a></td>
                              @endif
                            </tr>

                             <tr>  
                              <td>M001</td>
                              <td>EMP001</td>
                              <td>Hardware</td>
                              <td>Telephonic Draw Channel</td>
                              <td>20</td>
                              <td>15</td>
                              <td> <a href=""><label class="curved-text-button">View/Edit</label></a></td>
                            </tr>

                             <tr>  
                              <td>M001</td>
                              <td>EMP001</td>
                              <td>Hardware</td>
                              <td>Telephonic Draw Channel</td>
                              <td>20</td>
                              <td>15</td>
                              <td> <a href=""><label class="curved-text-button">View/Edit</label></a></td>
                            </tr>

                             <tr>  
                              <td>M001</td>
                              <td>EMP001</td>
                              <td>Hardware</td>
                              <td>Telephonic Draw Channel</td>
                              <td>20</td>
                              <td>15</td>
                              <td> <a href=""><label class="curved-text-button">View/Edit</label></a></td>
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