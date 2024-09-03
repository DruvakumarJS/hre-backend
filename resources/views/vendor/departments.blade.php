@extends('layouts.app')

@section('content')
<style type="text/css">
  thead th {
 
  height: 50px;
}
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container-header">
           @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2 )
           <div id="div2">
            <a  data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-light btn-outline-secondary" >Create Vendor Department</a>
            
          </div>
        @endif

         <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('search_vendor_headings')}}">
            @csrf
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search here" value="{{$search}}">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>
         
            
        </div>

<!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New vendor Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{route('create_headings')}}">
                  @csrf
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Department Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>

                
                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Description (optional)</label>
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



 @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
        @endif       
       
        <div>
        	<label class="label-bold" style="margin-left: 20px" >Vendor Departments </label>

        	<div class="card border-white table-wrapper-scroll-y tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

                        <table class="table">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th scope="col">Category</th>
                              <th scope="col">Description</th>
                              <th >Action</th>
                            
                             
                            </tr>
                          </thead>
                          <tbody>
                          
                            @foreach($data as $key => $value)
                              <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                              <td>{{$value->headings}}</td>
                              <td width="300px">{{$value->description}}</td>
                              
                               <td class="openModal" >
                                <!-- <a href="" data-bs-toggle="modal"  data-bs-target="#myModal" ><i class='fa fa-edit' style='font-size:24px;'></i></a> -->
                               @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2)
                                <a id="MybtnModal_{{$key}}" data-id="{{$value->category}}"> <button class="btn btn-light curved-text-button btn-sm">Edit</button></i></a>
                                @endif

                                @if(auth::user()->role_id == 1)
                                  <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_heading',$value->id)}}" > <button class="btn btn-light btn-outline-danger btn-sm">Delete</button></a>
                                @endif
                                   
                              </td>
                              <td>
                                 
        
                              </td>
                            </tr>

                            <!-- Modal -->

                              <div class="modal" id="modal_{{$key}}" >
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Edit Vendor Department</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="post" action="{{route('update_heading')}}">
                                        @csrf
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">Department Name</label>
                                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category name" value="{{$value->headings}}" required>
                                        </div>

                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Description (optional)</label>
                                          <textarea class="form-control" id="desc" name="desc" >{{$value->description}}</textarea>
                                        </div>

                                        <input type="hidden" name="id" value="{{$value->id}}">

                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                          <button type="submit" class="btn btn-danger">Update</button>
                                        </div>
                                      </form>
                                    </div>
                    </div>
                  </div>
                </div>

<!--  end Modal -->

 <script>
$(document).ready(function(){
  $('#MybtnModal_{{$key}}').click(function(){
    $('#modal_{{$key}}').modal('show');
  });
});  
</script>

                           
                            <!-- The Modal -->
                                <div class="modal" id="myModal">
                                  <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Edit Material Category</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="post" action="{{route('create-category')}}">
                                        @csrf
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">Category Name:</label>
                                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category name" required>
                                        </div>

                                         <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Material Category</label>
                                           <input type="text" class="form-control" id="material_category" name="material_category" placeholder="Enter Material Category" required>
                                        </div>

                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Unit</label>
                                           <input type="text" class="form-control" id="unit" name="unit" placeholder="Enter unit" required>
                                        </div>

                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Description (optional)</label>
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
          <!-- End edit Modal -->

                     
                            @endforeach
     
                             
                          </tbody>
                        </table>

                         <label>Showing {{ $data->firstItem() }} to {{ $data->lastItem() }}
                                    of {{$data->total()}} results</label>

                                <div class="float">{!! $data->links('pagination::bootstrap-4') !!}</div>
                        
                    </div>
                    <!--</div>-->
                 </div>
        </div>	
    </div>

   
</div>




 <script type="text/javascript">
                setTimeout(function () {
                 //  $("#mydiv").fadeOut().empty();
                 $('#mydiv').delay(10000).hide(0); 

                }, 10000);
</script>








@endsection