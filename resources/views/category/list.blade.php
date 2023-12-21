@extends('layouts.app')

@section('content')
<style type="text/css">
  thead th {
 
  height: 50px;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
          
           <div id="div2">
             <a  class="btn btn-light btn-outline-secondary" href="{{route('materials')}}"> View All Products</a>
           </div>
          
        
          @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2 OR auth::user()->role_id == 10)
           <div id="div2" style="margin-right: 30px" >
            <a data-bs-toggle="modal" data-bs-target="#exampleModal"  class="btn btn-light btn-outline-secondary" href=""><i class="fa fa-plus"></i> 
             <label id="modal">Create Category</label>
           </a>
          </div>
          @endif

          <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('search_category')}}">
            @csrf
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search here" >
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>
          
          @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2 OR auth::user()->role_id == 10 )
          <div id="div2" style="margin-right: 30px" >
            <a data-bs-toggle="modal" data-bs-target="#importModal"  class="btn btn-light btn-outline-secondary" href=""><label id="modal">Import Categories</label></a>
          </div>
         

           <div id="div3" style="margin-right: 30px">
             <a href="{{route('export-categories')}}"><button class="btn btn-light btn-outline-secondary" > Download CSV</button></a>
          </div>
          
           @endif
          

            
        </div>

<!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Material Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{route('create-category')}}">
                  @csrf
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Category Name:</label>
                    <input type="text" class="form-control" id="name" name="name" style="text-transform:uppercase;" required>
                  </div>

                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Category Code</label>
                     <input type="text" class="form-control" id="material_category" name="material_category"  style="text-transform:uppercase;" required>
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


<!-- Import Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Categories from Excel Sheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('import_category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <div class="custom-file text-left">
                            <input type="file" name="file" class="custom-file-input" id="customFile">
                           
                        </div>
                    </div>
                    <button class="btn btn-danger">Import</button>
                    
                </form>

                <div id="div2">
                       <a target="_blank" href="{{ URL::to('/') }}/templates/HRE_Category_template.xlsx" ><button class="btn btn-sm btn-light">Download Template</button></a>
                    </div>
              </div>
              
            </div>
          </div>
        </div>
<!--Import Modal -->

 @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
        @endif       
       
        <div>
        	<label class="label-bold" style="margin-left: 20px" >Material Master</label>

        	<div class="card border-white scroll tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

                        <table class="table">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th scope="col">Category</th>
                              <th scope="col">Category Code</th>
                              <th scope="col">Description</th>
                              <th scope="col">Products</th>
                              <th >Action</th>
                            
                             
                            </tr>
                          </thead>
                          <tbody>
                          
                            @foreach($categories as $key => $value)
                              <td>{{date("d-m-Y", strtotime($value->created_at))}}</td>
                              <td>{{$value->category}}</td>
                              <td>{{$value->material_category}}</td>
                              <td width="300px">{{$value->description}}</td>
                              <td>
                                 @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2 OR auth::user()->role_id == 10 OR auth::user()->role_id == 11)
                                <a href="{{route('add_product',$value->code)}}"><label class="btn btn-light btn-outline-secondary  btn-sm">Add Product</label></a>
                                @endif
                                <a href="{{route('view_products',$value->code)}}"><label class="btn btn-light btn-outline-secondary btn-sm">View Product</label></a>   
                              </td>
                               <td class="openModal" >
                                <!-- <a href="" data-bs-toggle="modal"  data-bs-target="#myModal" ><i class='fa fa-edit' style='font-size:24px;'></i></a> -->
                               @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2)
                                <a id="MybtnModal_{{$key}}" data-id="{{$value->category}}"> <button class="btn btn-light curved-text-button btn-sm">Edit</button></i></a>
                                @endif

                                @if(auth::user()->role_id == 1)
                                  <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_category',$value->code)}}" > <button class="btn btn-light btn-outline-danger btn-sm">Delete</button></a>
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
                                      <h5 class="modal-title" id="exampleModalLabel">Edit Material Category</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="post" action="{{route('update-category')}}">
                                        @csrf
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">Category Name:</label>
                                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category name" value="{{$value->category}}" required>
                                        </div>

                                         <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Category Code</label>
                                           <input type="text" class="form-control" id="material_category" name="material_category" placeholder="Category Code" value="{{$value->material_category}}" required>
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

                         <label>Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }}
                                    of {{$categories->total()}} results</label>

                                {!! $categories->links('pagination::bootstrap-4') !!}
                        
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