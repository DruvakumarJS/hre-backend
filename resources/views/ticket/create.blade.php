@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">Generate Tickets</label>
           <div id="div2">
            <a class="btn btn-light btn-outline-secondary" href="{{route('tickets')}}">
             <label id="modal">View Tickets </label> </a>
          
          </div>

     </div>

     <div class="form-build">
        <div class="row">
                <div class="col-6">
                    <form method="post" action="{{route('save-ticket')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Project Code Number*</label>
                            <div class="col-7">
                                <input name="pcn" id="pcn" type="text" class="typeahead form-control" required="required" placeholder="Enter PCN">
                                 <span class="label-bold" id="pcn_detail"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Department*</label>
                            <div class="col-7">
                                <select class="form-control form-select" name="category"required="required">
                                    <option value="">Select Department</option>
                                    @foreach($category as $key=>$value)
                                    <option value="{{$value->category}}">{{$value->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Subject *</label>
                            <div class="col-7">
                                <input name="subject" id="subject" type="text" class="typeahead form-control" placeholder="Enter Subject for Conversation" value="{{old('subject')}}" required="required">
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Ticket Description *</label>
                            <div class="col-7">
                                <textarea  name="issue" id="issue" type="text" class="form-control" required="required" placeholder="Enter Ticket details here" >{{old('issue')}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Priority*</label>
                            <div class="col-7">
                               
                                <select class="form-control form-select" name="priority" id='priority' required="required" >
                                   <option value="">Select Priority</option>
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                    
                                </select>
                               
                            </div>
   
                        </div>

                       
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Attach image </label>
                            <div class="col-7">
                               <!--  <input type="file" class="form-control form-control-sm" name="image" id="imgInp" accept="image/*"> -->

                                <input class="form-control form-control-sm" type="file" id="upload-btn" name="image[]" accept="image/*" multiple />
                                 
                
                            </div>
                        </div>

                        <div class="form-group row">
                              <output id="result" />
                        </div>

                        <input type="hidden" name="owner" value="{{Auth::user()->id}}">

                         <div class="form-group row">
                            <div class="offset-5 col-7">
                                <button name="submit" type="submit" class="btn btn-danger" id="btn_submit">Generate Ticket</button>
                                
                            </div>
                        </div>

                        
                    </form>
                    
                </div>

                
            
            
        </div>
        
     </div>

    </div>
</div>


<script type="text/javascript">

$( document ).ready(function() {
  var path = "{{ route('autocomplete_pcn') }}";
   let text = "";
    $( "#pcn" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
               
            document.getElementById("pcn_detail").innerHTML="";
            document.getElementById("btn_submit").style.display= "none" ;
            

             if(data.length==0){
               document.getElementById("pcn_detail").innerHTML="PCN doesn't exists";
               var getValue=document.getElementById("pcn");
              
             }
             else {
                // console.log(data);
                 response( data );
             }
              
            }
          });
        },
        select: function (event, ui) {
          // $('#pcn').val(ui.item.pcn);
           var address = ui.item.pcn +' , '+ui.item.client_name +' , '+  ui.item.brand  +' ,  '+  ui.item.location  +' ,'+  ui.item.area  +' , '+  ui.item.city +' , '+ ui.item.state;
          
           //document.getElementById("pcn").value=ui.item.pcn;
           document.getElementById("btn_submit").style.display= "block" ;
          document.getElementById("pcn_detail").innerHTML=address;
          setTimeout(function(){
          $('#pcn').val(ui.item.pcn);
          },500)
         // document.getElementById("pcn_detail").innerHTML= ui.item.pcn;
        
        }
      });
 
});

</script>

<script type="text/javascript">
    imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
    $(".imagen").show();
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