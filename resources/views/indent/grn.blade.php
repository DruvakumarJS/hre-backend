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
            <label class="label-bold" id="div1">GRNs</label>

            <div id="div2" style="margin-left: 30px">
              <a href="{{route('intends')}}"><button class="btn btn-light btn-outline-secondary" > View Indents </button></a>
            </div>

            <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('search_grn')}}">
            @csrf
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search GRN here">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>
      
    </div>

    <div class="page-container">
        <div class="div-margin">
            
            <div class="card border-white scroll tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Date</th>  
                              <th scope="col">GRN</th>
                              <th scope="col">PCN</th>
                              <th scope="col">Indent No</th>
                              <th scope="col">Material Name</th>
                              <th scope="col">Brand</th>
                              <th scope="col">Information</th>
                              <th scope="col">Dispatched No</th>
                              <th scope="col">Comments</th>
                              <th scope="col">Status</th>
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          @foreach($grn_array as $key=>$value)

                          @php
                           if($value['status'] == 'Awaiting Confirmation'){
                           $color = 'blue';

                           }
                           else if($value['status'] == 'Received'){
                           $color = 'green';
                           }
                           else{
                            $color = 'black';
                          }
                             
                            foreach($value['indent_details'] as $key2=>$value2)
                          @endphp

                          <tr>
                              <td>{{date("d-m-Y", strtotime($value['date']))}}</td>
                               <td>{{$value['grn']}}</td>     
                              <td>{{$value['pcn']}}</td>
                              <td>{{$value['indent_no']}}</td>
                              <td>{{$value2['material_name']}}</td>
                              <td>{{$value2['brand']}}</td>
                              <td>
                                <table>
                                <tbody>
                                  @php
                                   $info = $value2['information'];
                                  @endphp

                                  @foreach($info as $key3 => $val)
                                    
                                          <tr>
                                              <td>{{$key3}} = {{$val}}</td>
                                          </tr>
                                     
                                  @endforeach
                                </tbody>
                              </table>
                              </td>
                              <td>{{$value['dispatched']}}</td>
                              <td>{{$value['comment']}}</td>
                              <td style="color: <?php echo $color; ?>">{{$value['status']}}</td>
                              @if($value['status']=='Received')
                              <td>
                                  <a ><button class="btn btn-sm btn-outline-secondary" disabled="" >Update</button></a>
                              </td>
                              @else
                              <td>
                                  <a id="MybtnModal_{{$key}}" data-id="{{$value['grn']}}" ><button class="btn btn-sm btn-outline-success" <?php echo ($value['status']=='Received') ? 'disabled':'' ; ?> >Update</button></a>
                              </td>
                              @endif
                          </tr>

                          <!-- Modal -->

                              <div class="modal" id="modal_{{$key}}" >
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Update GRN</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="post" id="form" action="{{route('update-grn')}}">
                                        @csrf
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">GRN</label>
                                          <input type="text" class="form-control" id="grn" name="grn" placeholder="Enter Category name" value="{{$value['grn']}}" readonly required>
                                        </div>

                                         <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Dispatched Quantity</label>
                                           <input type="number" class="form-control" name="dispatched"  value="{{$value['dispatched']}}"placeholder="Dispatched quantity"  required readonly>
                                        </div>

                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Accepted Quantity</label>
                                           <input type="number" max="{{$value['dispatched']}}" class="form-control" id="approved" name="approved" placeholder="Enter Quantity" max="{{$value['dispatched']}}" required>
                                        </div>

                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Comment</label>
                                           <input type="text" class="form-control" id="comment" name="comment" placeholder="Enter Comments here" >
                                        </div>
                                       

                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                          <button type="submit" class="btn btn-danger" id="submit">Update</button>
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
                            
                         
                        </table>

                        
                        
                        
                    </div>
                    <!--</div>-->
                 </div>
        </div>
    </div> 
</div>	

<script>
$(document).ready(function() {
    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');
    });
});
</script>

@endsection