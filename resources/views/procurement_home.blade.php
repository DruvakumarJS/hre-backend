@extends('layouts.app')

@section('content')

<div class="container" >
    <div class="row ">
        <div >
            <!-- <div class="c ard">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div> -->

        <div class="container-header">
            <label class="label-bold" id="div1">Dashboard</label>
           <div id="div2">
            <button class="btn btn-light" ><i class="fa fa-plus"></i>  Create User</button>
            
          </div>
          <div id="div2" style="margin-right: 30px">
             <button class="btn btn-light" ><i class="fa fa-plus"></i>  Create Customer</button>
          </div>

            
        </div>
   
       <div class="row">
                <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body">
                            <img src="{{ asset('images/indent.svg') }}" alt="intend" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="float:right;font-weight: bolder; font-size: 40px ; ">34</h2>
                        </div>
                       <div>
                            <h4 class="card-text-black" style="float:left;font-size: 25px; font-weight: bolder;">Intends</h4>
                            <a style="float: right;" href=""><label class="curved-text-button">View</label></a>
                        </div>
                        <label class="card-text-label ">No. of intend received today</label>
                    </div>
                    <!--</div>-->
                </div>



                 <div class="col-sm-6 col-md-4" >
                    <div class="card border-black" style="background-color: #242424">
                        <div class="card-body" >
                            <img src="{{ asset('images/attendance.svg') }}" alt="attendance" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="color:#fff;float:right;font-weight: bolder; font-size: 40px ; ">54</h2>
                        </div>
                       <div>
                            <h4 class="card-text-black" style="float:left;font-size: 25px; font-weight: bolder;color: #fff">Completed Intends</h4>
                            <a style="float: right;" href=""><label class="curved-text-button">View</label></a>
                        </div>
                        <label class="card-text-label" style="color:#fff">Today working</label>
                    </div>
                    <!--</div>-->
                </div>


                 <div class="col-sm-6 col-md-4 ">
                    <div class="card border-white">
                        <div class="card-body">
                            <img src="{{ asset('images/tickets.svg') }}" alt="ticket" style="width:30px;height: 30px;">
                            <h2 class="card-text" style="float:right;font-weight: bolder; font-size: 40px ; ">12</h2>
                        </div>
                        <div>
                           <h4 class="card-text-black" style="float:left;font-size: 25px; font-weight: bolder;">Tickets</h4>
                             <a style="float: right;margin-top: 10px" href=""><label class="curved-text-button">View</label></a>
                        </div>
                        <label class="card-text-label ">Pending Tickets</label>
                    </div>
                   
                </div>


              
            </div>

            <div>
                <label>Recent Intend</label>

                <div class="row">
                  <div class="col-sm-6 col-md-12">
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
                              <td> <a href="{{route('update_intends','M001')}}"><label class="curved-text-button">View/Edit</label></a></td>
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
                   
                 </div>

                
                    
                </div>
            </div>



    </div>
</div>
</div>
@endsection
