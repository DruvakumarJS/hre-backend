@extends('layouts.app')

@section('content')
<style type="text/css">
  div.click-to-top span {
  display: none;
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: #333;
  color: #fff;
}

div.click-to-top:hover span {
  display: block;
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Vault 3</label>
          @if(Auth::user()->role_id == '1' OR Auth::user()->role_id == '2' OR Auth::user()->role_id == '3' OR Auth::user()->role_id == '6' OR Auth::user()->role_id == '9' OR Auth::user()->role_id == '10')
         <div id="div2">
          <button  data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-outline-secondary">Add </button>
        </div>
         <div id="div2" style="margin-right: 30px;">
               <i class="fa fa-th" onclick="grid()"></i><i class="fa fa-list" onclick="list()" style="margin-left: 10px"></i> 
          </div>

        @endif
        </div>

        
    </div>

     @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
     @endif       


    <div class="page-container">

      <div class="div-margin">
      
        <div class="row">
        @foreach($folderarray as $folders)
        <div class="col-md-1">
          <div style="align-items: center;text-align: center;">
            <a href="{{route('level4',[$f1,$f2,$f3,$folders])}}" style="color: white">
              <i class="fa fa-folder" style="font-size:100px;color:#f0c507"></i>
             <span style="color: black">{{$folders}}</span>
            </a>
            
          </div>
         
          
        </div>

        @endforeach   
        </div>
      </div>
       
      <div class="div-margin" >
        <div class="row" style="margin-top: 30px" style="margin-top: 30px" id="gridview">
          @foreach($data as $key=>$value)
          @php
             $images = $value->filename;
             $imagearray= explode(',' ,$images );
          @endphp
 
          @foreach($imagearray as $image)
         

          <div class="col-md-1" style="align-items: center;text-align: center;">
            @if($value->type == 'png' or $value->type == 'jpg') 

             
              <a target="_blank" href="{{ URL::to('/') }}/vault/{{$f1}}/{{$f2}}/{{$f3}}/{{$image}}">
                 <img src="{{ URL::to('/') }}/vault/{{$f1}}/{{$f2}}/{{$f3}}/{{$image}}" title="{{$value->name}}.{{$value->type}} , {{date('d-m-Y H:i', strtotime($value->updated_at))}}" style="height: 100px;width: 100px"> 
              </a>
              <label>{{$value->name}} </label>

            @elseif($value->type == 'pdf')
              
               <a target="_blank" href="{{ URL::to('/') }}/vault/{{$f1}}/{{$f2}}/{{$f3}}/{{$image}}">
                 <i class="fa fa-file-pdf-o" title="{{$value->name}}.{{$value->type}} , {{date('d-m-Y H:i', strtotime($value->updated_at))}}" style="font-size:100px;width: 100px; color: "></i>
              </a>
              <label>{{$value->name}} </label>

            @else
            
              <a target="_blank" href="{{ URL::to('/') }}/vault/{{$f1}}/{{$f2}}/{{$f3}}/{{$image}}">
                 <i class="fa fa-file" title="{{$value->name}}.{{$value->type}} , {{date('d-m-Y H:i', strtotime($value->updated_at))}}" style="font-size:100px;width: 100px; color: "></i>
              </a>
              <label>{{$value->name}}  </label>

            @endif
          </div>
           @endforeach

          @endforeach
          
        </div>

      <div id="listview" style="display: none">
        <table class="table">
          <tr>
              <th scope="col">Name</th>
              <th scope="col">Date Modified</th>
              <th scope="col">Type</th>
              <th scope="col"></th>
          </tr>

          <tbody>
           
              @foreach($data as $key=>$value)
               @php
                 $images = $value->filename;
                 $imagearray= explode(',' ,$images );
              @endphp
     
              @foreach($imagearray as $key2=>$image)
              <tr>
                <td width="200px">{{$value->name}} <?php echo ($key2 == '0') ?'':'('.$key2 .')'?></td>
                <td width="200px">{{date('d-m-Y H:i', strtotime($value->updated_at))}}</td>
                <td width="100px">{{$value->type}}</td>
                <td>
                  <a target="_blank" href="{{ URL::to('/') }}/vault/{{$f1}}/{{$f2}}/{{$f3}}/{{$image}}"><button class="btn btn-sm btn-outline-secondary">View</button></a>
                  @if(Auth::user()->role_id == '1' OR Auth::user()->role_id == '2' OR Auth::user()->role_id == '3' OR Auth::user()->role_id == '6' OR Auth::user()->role_id == '9' OR Auth::user()->role_id == '10')
                  <a id="MybtnModal_{{$key}}" style="margin-left: 20px" > <button class="btn btn-outline-success btn-sm">Rename</button></a>
                  @endif

                  @if(auth::user()->role_id == '1' OR Auth::user()->role_id == '2')
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
                <h5 class="modal-title" id="exampleModalLabel">Add New Document to Vault</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                 <form action="{{ route('save_level3_files') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                      <label for="recipient" class="col-form-label">Select Folder</label>
                      <select class="form-control form-select" name="directory">
                        <option value="">Select</option>
                        @foreach($folderarray as $folders)
                         <option value="{{$folders}}">{{$folders}}</option>
                        @endforeach
                      </select>
                    </div>

                    <label>OR</label>

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Enter New Folder</label>
                      <input type="text" class="form-control" id="folder_name" name="folder_name" placeholder="Enter New Folder Name">
                    </div>
                    
                    <label>Note : If dropdown is selected ,Files will be saved into selected folder or if folder name is entered, it will be saved into Newly entered folder or it will be saved outside </label>
                   <!--  <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Document Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name of the document" required>
                    </div> -->

                    <div class="form-group mb-4" style="margin-top: 20px">
                        <div class="custom-file text-left">
                            <input type="file" name="file[]" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" class="custom-file-input" id="customFile" required multiple="">
                           
                        </div>
                    </div>
                    <input type="hidden" name="f1" value="{{$f1}}">
                    <input type="hidden" name="f2" value="{{$f2}}">
                    <input type="hidden" name="f3" value="{{$f3}}">
                    <button class="btn btn-danger">Upload</button>
                    
                </form>
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->

<script type="text/javascript">
  
  function grid(){
    location.reload();
  }

  function list(){
    document.getElementById('listview').style.display="block";
    document.getElementById('gridview').style.display="none";
  }
</script>


@endsection
