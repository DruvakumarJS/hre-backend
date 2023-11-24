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
  margin: 10px;
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
       @foreach($data as $key=>$value)
       <label class="label-bold div-margin">{{$value['name']}}</label>
        <div class="row">
        	@foreach($value['roles'] as $key2=>$value2)

        	<div class="col-sm-3">
                <div class="card2 border-white card_shadow" style="padding: 20px 20px 20px 20px">
                  <div class="card-body">
                    <h3 class="card-title">{{$value2['alias']}}</h3>
                   <a href="{{ route('view_users',$value2['id'])}}" class="btn btn-light btn-outline-secondary" style="color: black">View more</a>
                    <div id="div2">
                      <label style="font-weight: bolder;font-size: 25px">{{$value2['count']}}</label>
                    </div>
                  
                  </div>
                </div>
              </div>
        	@endforeach
        </div>
       @endforeach 
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
