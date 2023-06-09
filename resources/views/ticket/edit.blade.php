@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">Edit Tickets</label>
           <div id="div2">
            <a class="btn btn-light btn-outline-secondary" href="{{route('tickets')}}">
             <label id="modal">View Tickets </label> </a>
          
          </div>

     </div>

     <div class="form-build">
     	<div class="row">
     			<div class="col-6">
     				<form method="post" action="{{route('update-ticket')}}" enctype="multipart/form-data">
     					@csrf
     					<div class="form-group row">
                            <label for="" class="col-5 col-form-label">Project Code Number </label>
                            <div class="col-7">
                                <input name="pcn" id="pcn" type="text" class="typeahead form-control" required="required" placeholder="Enter PCN" value="{{$tickets->pcn}}" readonly="readonly">
                               
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Department </label>
                            <div class="col-7">
                                <input name="pcn" id="subject" type="subject" class="typeahead form-control" required="required" value="{{$tickets->category}}" readonly="readonly">
                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Description *</label>
                            <div class="col-7">
                                <textarea  name="issue" id="issue" type="text" class="typeahead form-control" required="required" placeholder="Enter Customer issue here" >{{$tickets->issue}}</textarea>
                            </div>
                        </div>

                       
                       <div id="n_manadatory"> 
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Assign to </label>
                            <div class="col-7">

                               
                                <select class="form-control form-select" name="user_id" id="user_id" >
                                   <option value=''>Select </option>
                                    @foreach($supervisor as $key => $value)
                                    
                                    <option value="{{$value->id}}" <?php echo ($value->id == $tickets->assigned_to) ? 'selected' : ''; ?>> {{$value->name}} - {{$value->roles->alias}}</option>

                                    @endforeach

                                </select>
                               
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Priority</label>
                            <div class="col-7">
                               
                                <select class="form-control form-select" name="priority" id='priority' >
                                   <option value="">Select Priority</option>
                                    <option value="High" <?php echo ($tickets->priority == 'High') ? 'selected' : ''; ?>  >High</option>
                                    <option value="Medium" <?php echo ($tickets->priority == 'Medium') ? 'selected' : ''; ?> >Medium</option>
                                    <option value="Low" <?php echo ($tickets->priority == 'Low') ? 'selected' : ''; ?> >Low</option>
                                    
                                </select>
                               
                            </div>
   
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">TAT</label>
                            <div class="col-7">
                                <input name="tat" id="tat" type="date" class="form-control" placeholder="Enter TAT here" value="{{$tickets->tat}}" > 
                            </div>
                        </div>
                      </div>

                      
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Status</label>
                            <div class="col-7">
                               
                                <select class="form-control form-select" name="status" id='status' required="required"  onchange="run()" >
                                @if((Auth::user()->role_id != '1') and (Auth::user()->role_id != '2') and (Auth::user()->role_id != '5'))
                                 <option value="Created" <?php echo ($tickets->status == 'Created') ? 'selected' : ''; ?>  >Created</option>

                                @else

                                     @if($tickets->status == 'Created')
                                   <option value="Created" <?php echo ($tickets->status == 'Created') ? 'selected' : ''; ?>  >Created</option>
                                   <option value="Rejected" <?php echo ($tickets->status == 'Reject') ? 'selected' : ''; ?> >Reject</option>
                                   <option value="Pending" <?php echo ($tickets->status == 'Pending') ? 'selected' : ''; ?>  >Pending</option>

                                   @elseif($tickets->status == 'Rejected')
                                  
                                   <option value="Rejected" <?php echo ($tickets->status == 'Reject') ? 'selected' : ''; ?> >Reject</option>
                                    <option value="Re-Opened" <?php echo ($tickets->status == 'Reopen') ? 'selected' : ''; ?> >Reopen</option>

                                    @elseif($tickets->status == 'Completed')
                                    <option value="Completed" <?php echo ($tickets->status == 'Completed') ? 'selected' : ''; ?> >Completed</option>
                                    <option value="Re-Opened" <?php echo ($tickets->status == 'Reopen') ? 'selected' : ''; ?> >Reopen</option>

                                    @elseif($tickets->status == 'Pending')
                                     <option value="Pending" <?php echo ($tickets->status == 'Pending') ? 'selected' : ''; ?>  >Pending</option>
                                     <option value="Completed" <?php echo ($tickets->status == 'Completed') ? 'selected' : ''; ?> >Completed</option>


                                   @endif

                                   @endif

   
                                   
                                </select>
                               
                            </div>
   
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Comments</label>
                            <div class="col-7">
                                <textarea  name="comment" id="comment" type="text" class="typeahead form-control"  placeholder="Enter comments here" >{{$tickets->comments}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row" >
                            <label for="" class="col-5 col-form-label"></label>
                             <div class="col-7">
                                 <div class="form-check" style="display: none" id="download">
                                      <input class="form-check-input" type="checkbox" id="check1" name="checkbox" value="1" >
                                      <label class="form-check-label">Download Invoice</label>
                                    </div>
                            
                             </div>
                               
                        
                        </div>

                      
                       <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Attach image </label>
                            <div class="col-7">
                                 <input class="form-control form-control-sm" type="file" id="upload-btn" name="image[]" accept="image/*" multiple />
                
                            </div>
                        </div>

                         <div class="form-group row">
                              <output id="result" />
                        </div>

                        <input type="hidden" name="assigner" value="{{Auth::user()->id}}">
                        <input type="hidden" name="id" value="{{$tickets->id}}">
                        
                         <div class="form-group row">
                            <div class="offset-5 col-7">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#importModal" ><button  class="btn btn-light">View Images</button></a>

                                <button name="submit" type="submit" class="btn btn-danger">Update Ticket</button>
                                
                            </div>
                        </div>

     					
     				</form>
                    
                    <!-- Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ticket Images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
               <div class="modal-body">
                @php
                $revertNames = explode(',', $tickets->filename);
                @endphp

              @foreach($revertNames as $key=>$value)
               <img class="imagen" id="blah" src="{{ URL::to('/') }}/ticketimages/{{$value}}" alt="ticketimage" style="width: 400px;height: 250px" />

             
               @endforeach
              
            </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->


     				
     			</div>

     		
     		
     	</div>
     	
     </div>

    </div>

   
</div>

<script type="text/javascript">

    var y = document.getElementById("n_manadatory");
     var status = document.getElementById("status").value;
    
         if(status == 'Created'){
             y.style.display='none';
            document.getElementById("user_id").required = false;
            document.getElementById("priority").required = false;
            document.getElementById("tat").required = false;
         }
         else if(status == 'Rejected'){
            y.style.display='none';
            document.getElementById("user_id").required = false;
            document.getElementById("priority").required = false;
            document.getElementById("tat").required = false;
        }
         else{
          
            y.style.display='block';
            document.getElementById("user_id").required = true;
            document.getElementById("priority").required = true;
            document.getElementById("tat").required = true;
         }


    function run(){
        var status = document.getElementById("status").value;
         var x = document.getElementById("download");
         
          if(status == 'Created'){
             y.style.display='none';
            document.getElementById("user_id").required = false;
            document.getElementById("priority").required = false;
            document.getElementById("tat").required = false;
         }
         else if(status == 'Rejected'){
            y.style.display='none';
            document.getElementById("user_id").required = false;
            document.getElementById("priority").required = false;
            document.getElementById("tat").required = false;
        }
         else{
          
            y.style.display='block';
            document.getElementById("user_id").required = true;
            document.getElementById("priority").required = true;
            document.getElementById("tat").required = true;
         }

       
        if(status == 'Re-Opened'){

             x.style.display='none';
           // alert('Since you are reopening the ticket,You will be the owner of the ticket');

          // document.getElementById('user_id').value = <?php echo Auth::user()->id ?>;
          // document.getElementById("user_id").disabled=true;
        }
        else if (status == 'Completed') {
                x.style.display='block';
           
        }
        else {
            x.style.display='none';

        }

    }


    
</script>

<script type="text/javascript">
    window.onload = function() {
  // Check for File API support.
  if (window.File && window.FileList && window.FileReader) {
    var filesInput = document.getElementById('upload-btn');
    filesInput.addEventListener('change', function(e) {
      var output = document.getElementById('result');
      var files = e.target.files; //FileList object
      
      output.innerHTML = ''; // Clear (previous) results.

      if(files.length > 4){
        document.getElementById('upload-btn').value= null;
        alert("You can only upload a maximum of 4 files");

        
      }
      else {
      
      for (var i = 0; i < files.length; i++) {
        var currFile = files[i];
        if (!currFile.type.match('image')) continue; // Skip non-images.
        
        var imgReader = new FileReader();
        imgReader.fileName = currFile.name;
        imgReader.addEventListener('load', function(e1) {
          var img = e1.target;
          var div = document.createElement('div');
          div.className = 'thumbnail';
          div.innerHTML = [
            '<img class="thumb" src="' + img.result + '"' + 'title="' + img.fileName + '"/>',
            '<label class="caption">' + img.fileName + '</label>'
          ].join('');
          output.appendChild(div);
        });

        // Read image.
        imgReader.readAsDataURL(currFile);
      }
      }
    });
  } else {
    console.log('Your browser does not support File API!');
  }
}
</script>




@endsection