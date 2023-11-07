@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Vault</label>
         @if(Auth::user()->role_id == '1')
         <div id="div2">
          <button  data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-outline-secondary">Add New </button>
        </div>
        @endif
        </div>

        
    </div>

    <div class="page-container">
       <div class="row div-margin">
        <table class="table">
          <tr>
              <th scope="col">Name</th>
              <th scope="col">Date Modified</th>
              <th scope="col">Type</th>
              <th scope="col"></th>
          </tr>

          <tbody>
           
              @foreach($vault as $key=>$value)
              <tr>
                <td width="200px">{{$value->name}}</td>
                <td width="200px">{{date('d-m-Y H:i', strtotime($value->updated_at))}}</td>
                <td width="100px">{{$value->type}}</td>
                <td>
                  <a target="_blank" href="{{ URL::to('/') }}/vault/{{$value->filename}}"><button class="btn btn-sm btn-outline-secondary">View</button></a>
                  @if(Auth::user()->role_id == '1')
                  <a id="MybtnModal_{{$key}}" style="margin-left: 20px" > <button class="btn btn-outline-success btn-sm">Rename</button></a>
                  <a onclick="return confirm('Are you sure to delete?')" href="{{route('delete_doc',$value->id)}}" style="margin-left: 20px"><button class="btn btn-sm btn-outline-danger">Delete</button></a>
                  @endif
                </td>
              </tr>

              <!-- Modal -->

                              <div class="modal" id="modal_{{$key}}" >
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Rename File</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="post" action="{{route('update-doc')}}">
                                        @csrf
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label"> Name:</label>
                                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category name" value="{{$value->name}}" required>
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
              @endforeach
           
          </tbody>
        </table>
           
       </div>
    </div>
    </div>


<!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Document to Vault</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                 <form action="{{ route('save_document') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name of the document" required>
                  </div>

                    <div class="form-group mb-4">
                        <div class="custom-file text-left">
                            <input type="file" name="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" class="custom-file-input" id="customFile">
                           
                        </div>
                    </div>
                    <button class="btn btn-danger">Upload</button>
                    
                </form>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->


@endsection
