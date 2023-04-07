@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Material Category</label>
           <div id="div2">
            <a  class="btn btn-light" href="{{route('materials')}}"></i> View Materials</a>
            
          </div>
        
           <div id="div2" style="margin-right: 30px" >
            <a data-bs-toggle="modal" data-bs-target="#exampleModal"  class="btn btn-light" href=""><i class="fa fa-plus"></i> 
             <label id="modal">Create Category</label>
           </a>

    
          </div>

           <div id="div3" style="margin-right: 30px">
             <button class="btn btn-light" > Download CSV</button>
          </div>

            
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
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category name" required>
                  </div>

                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Category Code</label>
                     <input type="text" class="form-control" id="material_category" name="material_category" placeholder="Enter Category code" required>
                  </div>

          
                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Description (optional)</label>
                    <textarea class="form-control" id="desc" name="desc" ></textarea>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">SAVE</button>
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
        	<label style="margin-left: 20px">Material Category</label>

        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Category</th>
                              <th scope="col">Category Code</th>
                              <th scope="col">Action</th>
                              <th ></th>
                              <th ></th>
                             
                            </tr>
                          </thead>
                          <tbody>
                          
                            @foreach($categories as $key => $value)
                              <td>{{$value->category}}</td>
                              <td>{{$value->material_category}}</td>
                              
                              <td>
                                <a href="{{route('add_product',$value->code)}}"><label class="curved-text">Add Product</label></a>
                                <a href="{{route('view_products',$value->code)}}"><label class="curved-text">View Product</label></a>   
                              </td>
                               <td class="openModal" >
                                <!-- <a href="" data-bs-toggle="modal"  data-bs-target="#myModal" ><i class='fa fa-edit' style='font-size:24px;'></i></a> -->

                                <a id="MybtnModal_{{$key}}" data-id="{{$value->category}}"> <i class='fa fa-edit' style='font-size:24px;color:blue;'></i></a>
                                
                                 </td>
                               <td >
                                  <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_category',$value->code)}}" > <i class='fa fa-trash' style='font-size:24px;color:red;'></i></a>

                                   
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
                                          <textarea class="form-control" id="desc" name="desc" ></textarea>
                                        </div>
                                        <input type="hidden" name="id" value="{{$value->id}}">

                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                          <button type="submit" class="btn btn-primary">Update</button>
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
                                          <button type="submit" class="btn btn-primary">SAVE</button>
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

                                {!! $categories->links() !!}
                        
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