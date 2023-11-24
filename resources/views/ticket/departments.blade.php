@extends('layouts.app')

@section('content')
<style type="text/css">
  thead th {
 
  height: 50px;
}
</style>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
  
     
   
<div class="container">
    <div class="row justify-content-center">
   <div class="container-header">
            <label class="label-bold" id="div1">Departments</label>
             @if(auth::user()->role_id == 1)
               <div id="div2">
                <a data-bs-toggle="modal" data-bs-target="#exampleModal" href="" class="btn btn-light btn-outline-secondary" >
                 <label id="modal">Create Department </label> </a>
              </div>
             @endif
       </div>
      
      <div class="page-container div-margin">
        <div class="card border-white scroll tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">
          <table class="table">
            <thead>
              <tr>
                <th>Created Date</th>
                <th>Department Name</th>
                <th>Responsible Roles</th>
                <th>Description</th>
                <th></th>
                
              </tr>
            </thead>

            <tbody>
              @foreach($data as $key=>$value)
              <tr>
                <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                <td>{{$value->department}}</td>
                <td width="400px">{{$value->role_alias}}</td>
                <td width="300px">{{$value->description}}</td>
                <td>
                   @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2)
                  <a id="mymodal_{{$key}}" href="#"><button class="btn btn-sm btn-outline-success">Edit</button></a>
                  @endif

                   @if(auth::user()->role_id == 1)
                  <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_department', $value->id)}}"><button class="btn btn-sm btn-outline-danger">Delete</button></a>
                  @endif

                </td>
              </tr>

              <!-- Modal -->
                    <div class="modal fade" id="editmodal_{{$key}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">

                            
                            <form method="post" action="{{route('update_department',$value->id)}}" enctype="multipart/form-data">
                              @method('PUT')
                              @csrf
                              <div class="mb-3">
                                <label class="col-form-label">Department Name </label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Department Name" value="{{$value->department}}" required>
                              </div>

                              <div class="mb-3">
                                <label class="col-form-label">Responsible Roles </label>
                                <input type="text" class="form-control" id="roles" name="roles" value="{{$value->role_alias}}" disabled>
                              </div>
                             
                              <div class="mb-3" style="height: 100%">
                                <label  ><strong >Select Category :</strong></label><br/>

                                <select class="selectpicker form-control form-select" multiple data-live-search="true" name="cat[]">
                                  
                                   @foreach($roles as $role)
                                       @php
                                        $array = explode(',' , $value->role_alias);
                                       @endphp
                                        <option value="{{$role->id}}" <?php echo (in_array($role->alias,$array, TRUE))?'selected':''  ?>>{{$role->alias}}</option>

                                   @endforeach     
                                </select>
                            </div>

                            

                          
                              <div class="mb-3">
                                <label class="col-form-label">Description (optional)</label>
                                <textarea class="form-control" id="desc" name="desc" >{{$value->description}}</textarea>
                              </div>

                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">SAVE</button>
                              </div>
                            </form>
                          </div>
                          
                        </div>
                      </div>
                    </div>
            <!-- Modal --> 

             <script>
              $(document).ready(function(){
                $('#mymodal_{{$key}}').click(function(){
                  $('#editmodal_{{$key}}').modal('show');
                });
              });  
              </script>

              <script type="text/javascript">
                $(document).ready(function() {
                    $('select').selectpicker();
                   
                });
            </script>
            


              @endforeach
            </tbody>
            
          </table>
        
       </div>

        
      </div>
       
  
        

   </div>
  </div>

  <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{route('create_department')}}">
                  @csrf
                  <div class="mb-3">
                    <label class="col-form-label">Department Name </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Department Name" required>
                  </div>
                  
                  <label>Select Responsible Roles</label>
                  <div class="mb-3"> 
                    <div class="dropdown">
                      <input class="form-control dropdown-toggle"
                              type="text" 
                              id="multiSelectDropdown"
                              name="roles"
                              data-bs-toggle="dropdown" 
                              aria-expanded="false" value="select">
                          

                      <ul class="dropdown-menu" 
                          aria-labelledby="multiSelectDropdown">
                           @foreach($roles as $role)
                          <li>
                            <label>
                              <input type="checkbox" 
                                     value="{{$role->id}}">
                                  {{$role->alias}}
                              </label>
                          </li>
                          @endforeach
                      </ul>
                  </div>
                  </div>
                  <input type="hidden" name="roleids" id="roleids">

                  <div class="mb-3">
                    <label class="col-form-label">Description (optional)</label>
                    <textarea class="form-control" id="desc" name="desc" ></textarea>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">SAVE</button>
                  </div>
                </form>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal --> 

<script>
require(['bootstrap-multiselect'], function(purchase){
$('#mySelect').multiselect();
});
</script>

<script>
        const chBoxes =
            document.querySelectorAll('.dropdown-menu input[type="checkbox"]');
        const dpBtn = 
            document.getElementById('multiSelectDropdown');
        const roleids = 
            document.getElementById('roleids');
        let mySelectedListItems = [];
  
        function handleCB() {
            mySelectedListItems = [];
            let mySelectedListItemsText = '';
            let mySelectedListItemsid = '';
  
            chBoxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    mySelectedListItems.push(checkbox.value);
                    mySelectedListItemsText += checkbox.value + ', ';
                 
                    roleids.value = mySelectedListItemsText;
                }
            });
  
            /*dpBtn.innerText =
                mySelectedListItems.length > 0
                    ? mySelectedListItemsText.slice(0, -2) : 'Select';*/
        }
  
        chBoxes.forEach((checkbox) => {
            checkbox.addEventListener('change', handleCB);
        });
    </script>

    

    
@endsection