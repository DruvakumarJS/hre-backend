@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Material Category</label>
           <div id="div2">
            <a  class="btn btn-light" href=""></i> View Material</a>
            
          </div>
         <!--  <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light" href=""><i class="fa fa-plus"></i> Create Material</a>
            
          </div> -->

           <div id="div2" style="margin-right: 30px" >
            <a data-bs-toggle="modal" data-bs-target="#exampleModal"  class="btn btn-light" href=""><i class="fa fa-plus"></i> 
             <label id="modal">Create Category</label>
           </a>

         <!--   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Open modal for @mdo</button> -->

    
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
            <p id="errormessage" class="text-danger text-center">{{ Session::get('message') }}</p>
        @endif       

        <div style="margin-top: 50px">
        	<label style="margin-left: 20px">Material Category</label>

        	<div class="card border-white">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Category id</th>
                              <th scope="col">Category Name</th>
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                           <!--  <tr>  
                              <td>M00001</td>
                              <td>Civil</td>
                              <td>
                              	<a href="{{route('add_product','M0001')}}"><label class="curved-text">Add Product</label></a>
                              	<a href="{{route('add_product','M0001')}}"><label class="curved-text">View Product</label></a>
                              </td>
                            </tr>
 -->
                            @foreach($categories as $key => $value)

                            <td>{{$value-> code}}</td>
                              <td>{{$value->name}}</td>
                              <td>
                                <a href="{{route('add_product','M0001')}}"><label class="curved-text">Add Product</label></a>
                                <a href="{{route('add_product','M0001')}}"><label class="curved-text">View Product</label></a>   
                              </td>
                              <td>
                                 <a href=""  ><i class='fa fa-edit' style='font-size:24px;'></i></a>
                              </td>
                               <td class="openModal">   
                                  <a > <i class='fa fa-trash' style='font-size:24px;color:red;'></i></a>
                              </td>
                              <td >
                                 
        
                              </td>
                            </tr>

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
                    $("errormessage").fadeOut().empty();
                }, 3000);
            </script>
<script type="text/javascript">

  $('.openModal').on('click',function(){
  
    $("#editModal").modal("show");
    $("#id").val($(this).closest('tr').children()[0].textContent);

});
</script>
@endsection