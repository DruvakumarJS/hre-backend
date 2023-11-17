@extends('layouts.app')

@section('content')

<style type="text/css">

@import url('https://fonts.googleapis.com/css?family=Nunito:400,700');

h3 {
  color: #262626;
  font-size: 17px;
  line-height: 24px;
  font-weight: 700;
  margin-bottom: 4px;
}

p {
  font-size: 17px;
  font-weight: 400;
  line-height: 20px;
  color: #666666;

  &.small {
    font-size: 14px;
  }
}


.card2 {
  display: block;
  top: 0px;
  position: relative;
  max-width: 262px;
  background-color: #f2f8f9;
  border-radius: 4px;
  padding: 32px 24px;
  margin: {{ $counts['r1'] }}px;
  text-decoration: none;
  z-index: 0;
  overflow: hidden;
  border: 1px solid #f2f8f9;

  &:hover {
    transition: all 0.2s ease-out;
    box-shadow: 0px 4px 8px rgba(38, 38, 38, 0.2);
    top: -4px;
    border: 1px solid #cccccc;
    background-color: #cccccc;
  }

  &:hover:before {
    transform: scale(2.15);
  }
}



}

</style>


<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Role Master</label>
         
           <div id="div3" style="margin-right: 30px">
           <a href="{{route('export-users','All_users')}}"> <button class="btn btn-light btn-outline-secondary" > Download CSV</button> </a>
             
          </div>

         <div id="div2" style="margin-right: 30px" >
            <a data-bs-toggle="modal" data-bs-target="#importModal"  class="btn btn-light btn-outline-secondary" href=""><label id="modal">Import</label></a>
        </div>


    </div>
    <div class="page-container">
       
        <div class="top-counter div-margin">
          <label class="label-bold">Super Admins</label>
            <div class="row">
              <div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">Super Admin</h3>
                   <a href="{{ route('view_users','1')}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{ $counts['r1'] }}</label>
                    </div>
                  
                  </div>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">Admin</h3>
                    
                   <a href="{{ route('view_users','6')}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{ $counts['r6'] }}</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="top-counter div-margin">
          <label class="label-bold">Project Managers</label>
            <div class="row">
              <div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">Manager</h3>
                    
                   <a href="{{ route('view_users','2')}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{ $counts['r2'] }}</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">Executive</h3>
                    
                   <a href="{{ route('view_users','7')}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{ $counts['r7'] }}</label>
                    </div>
                  </div>
                </div>
              </div>

               <div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">Assistant</h3>
                    
                   <a href="{{ route('view_users','11')}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{ $counts['r11'] }}</label>
                    </div>
                  </div>
                </div>
              </div>


            </div>
        </div>

        <div class="top-counter div-margin">
          <label class="label-bold">Procurement</label>
            <div class="row">
              <div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">Manager</h3>
                    
                   <a href="{{ route('view_users','3')}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{ $counts['r3'] }}</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">Executive</h3>
                    
                   <a href="{{ route('view_users','8')}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{ $counts['r8'] }}</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">Assistant</h3>
                    
                   <a href="{{ route('view_users','12')}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{ $counts['r12'] }}</label>
                    </div>
                  </div>
                </div>
              </div>


            </div>
        </div>
        

        <div class="top-counter div-margin">
          <label class="label-bold">Supervisors</label>
            <div class="row">
              <div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">Supervisor</h3>
                    
                   <a href="{{ route('view_users','4')}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{ $counts['r4'] }}</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">Trainee</h3>
                    
                   <a href="{{ route('view_users','9')}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{ $counts['r9'] }}</label>
                    </div>
                  </div>
                </div>
              </div>

            </div>
        </div>

        <div class="top-counter div-margin">
          <label class="label-bold">Finance</label>
            <div class="row">
              <div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">Manager</h3>
                    
                   <a href="{{ route('view_users','5')}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{ $counts['r5'] }}</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">Account Manager</h3>
                    
                   <a href="{{ route('view_users','10')}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{ $counts['r10'] }}</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">Accountant</h3>
                    
                   <a href="{{ route('view_users','13')}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{ $counts['r13'] }}</label>
                    </div>
                  </div>
                </div>
              </div>

            </div>
        </div>

        <div class="top-counter div-margin">
          <label class="label-bold">Human Resource</label>
            <div class="row">
              <div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">Manager</h3>
                    
                   <a href="{{ route('view_users','14')}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{ $counts['r14'] }}</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">Executive</h3>
                    
                   <a href="{{ route('view_users','15')}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{ $counts['r15'] }}</label>
                    </div>
                  </div>
                </div>
              </div>

            </div>
        </div>

    </div>
</div>



<!-- Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Import Users from Excel sheet</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('import_user') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <div class="custom-file text-left">
                            <input type="file" name="file" class="custom-file-input" id="customFile"> 
                        </div>
                    </div>
                    <button class="btn btn-danger">Import</button>
                    
                </form>

                    <div id="div2">
                       <a target="_blank" href="{{ URL::to('/') }}/templates/HRE_User_Template.xlsx" ><button class="btn btn-sm btn-light">Download Template</button></a>
                    </div>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->

<!-- Modal -->
        <div class="modal fade" id="addrolesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel"> New Role and Responsibility</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('import_user') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <div class="custom-file text-left">
                          <label class="label-bold">Role Name</label>
                            <input type="text" name="role" class="form-control" placeholder="Enter Role Name" > 
                        </div>

                        <div class="custom-file text-left div-margin">
                          <label class="label-bold">Role Description</label>
                            <input type="text" name="role_desc" class="form-control" placeholder="Enter Role Description" > 
                        </div>
                    </div>
                    <button class="btn btn-danger">Sumbit</button>
                    
                </form>

              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->
@endsection
