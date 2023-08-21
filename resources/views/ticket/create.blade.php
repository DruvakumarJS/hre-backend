@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">Generate Tickets</label>
           <div id="div2">
            <a class="btn btn-light btn-outline-secondary" href="{{route('tickets')}}">
             <label>View Tickets </label> </a>
          
          </div>

     </div>

     <!--  Modal -->
          <div class="modal fade" data-bs-backdrop="static"  id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ticket Created Succesfully</h5>
                 <!--  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                 
                  <div>
                     <label>Ticket No. : </label> <label id="modal_body" class="label-bold"></label>
                  </div>
                  
                  <div id="div2">
                    <a href="{{route('tickets')}}"><button class="btn btn-success">OK , GOT IT</button></a>
                    
                  </div>
                  
                </div>
                
              </div>
            </div>
          </div>
  <!-- Modal -->

     <div class="form-build">
        <div class="row">
                <div class="col-6">
                    <form name="myForm">
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
                                <select class="form-control form-select" id="category" name="category"required="required">
                                    <option value="">Select Department</option>
                                    @foreach($category as $key=>$value)
                                    <option value="{{$value->department}}">{{$value->department}}</option>
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
                            <label for="" class="col-5 col-form-label">Attach image* </label>
                            <div class="col-7">
                               <!--  <input type="file" class="form-control form-control-sm" name="image" id="imgInp" accept="image/*"> -->

                               <input type='file' id="file" name='file' multiple class="form-control">
                               <!-- Error -->
                               <div class='alert alert-danger mt-2 d-none text-danger' id="err_file"></div>
                                 
                
                            </div>
                        </div>

                        <input type="hidden" name="owner" id="owner" value="{{Auth::user()->id}}">

                         <div class="form-group row">
                            <div class="offset-5 col-7">
                                <button name="submit" type="button" class="btn btn-danger" id="submit">Generate Ticket</button>
                                
                            </div>
                        </div>
                       <div class="form-group row">
                            <output id="result" />
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
            document.getElementById("submit").style.display= "none" ;
            

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
           var address = ui.item.brand  +' ,  '+  ui.item.location  +' ,'+  ui.item.area  +' , '+  ui.item.city +' , '+ ui.item.state;
          
           //document.getElementById("pcn").value=ui.item.pcn;
          
          setTimeout(function(){
          $('#pcn').val(ui.item.pcn);
          },500)
         // document.getElementById("pcn_detail").innerHTML= ui.item.pcn;

         if(ui.item.status == 'Completed'){
            document.getElementById("pcn_detail").innerHTML="This PCN is Completed , Please contact your Super Admin for more information";
            document.getElementById("submit").style.display= "none" ;
          }
          else {
            document.getElementById("submit").style.display= "block" ;
           document.getElementById("pcn_detail").innerHTML=address;
          }
          
        
        }
      });
 
});

</script>

<script type="text/javascript">
   var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
   var imagesArray = [];
   var filesInput = document.getElementById('file');
    
    filesInput.addEventListener('change', function(e) {
      var output = document.getElementById('result');
      var files = e.target.files; //FileList object

       if(files.length > 4 || imagesArray.length >=4){
        document.getElementById('file').value= null;
        alert("You can only upload a maximum of 4 files");

        
      }
      else {
      
      for (var i = 0; i < files.length; i++) {
       // alert('ll');
        var currFile = files[i];
     
       imagesArray.push(files[i]);

        displayImages();

      
      }

       function displayImages() {

        let images = ""
        imagesArray.forEach((image, index) => {
     
          images += `<div class="image">
                <img  src="${URL.createObjectURL(image)}" alt="image">
                '<span data-indx="`+index+`" class="img-delete"><b class="remove_icon">X</b></span>'
              </div>` 
           })
        
         
        output.innerHTML = images

       }


       $(".img-delete").click(function(){
            //alert("kkk");
          //  alert(imagesArray.length);
                   var imgInd = $(this).attr('data-indx');
                  // alert(imgInd);
                   imagesArray.splice(imgInd,1);
                   $(this).parent(".image").remove();

                   
                   

                });

    
    }

    });

   $(document).ready(function(){

         $('#submit').click(function(){
              
             var pcn = $('#pcn').val();
             var category = $('#category').val();
             var issue = $('#issue').val();
             var priority = $('#priority').val();
             var creator = $('#owner').val();
            

            if(pcn == ''){
              alert("Please Select PCN");
              return;
             }
             if(category == ''){
              alert("Please Select Department");
              return;
             }
             if(issue == ''){
              alert("Please Enter Ticket Description");
              return;
             }
             if(priority == ''){
              alert("Please Select Priority");
              return;
             }
             
             if(imagesArray.length == 0){
              alert("Please attach image(s) ");
              return;
             }

              
                     var fd = new FormData();

                      imagesArray.forEach(function(image, i) {
                         fd.append('file[]',image);
                      });

                     // Append data 
                    // fd.append('file',imagesArray);
                     fd.append('_token',CSRF_TOKEN);
                     fd.append('pcn',pcn);
                     fd.append('category',category);
                     fd.append('issue',issue);
                     fd.append('priority',priority);
                     fd.append('owner',creator);
                     // Hide alert 
                     $('#responseMsg').hide();
                    

                     // AJAX request 
                     $.ajax({
                          url: "{{ route('save-ticket') }}",
                          method: 'post',
                          data: fd,
                          contentType: false,
                          processData: false,
                          dataType: 'json',
                          success: function(response){
                             // console.log(response);
                            
                             // alert("Ticket Created Succesfully");
                              // window.location.href = "{{ route('tickets')}}";
                            // document.getElementById("myForm").reset();
                            //$('#myForm').trigger("reset");
                            jQuery("#submit input[type=text]").val('');
                             var data = response;
                              $("#modal_body").html(data);
                             $("#modal").modal('show');


                          },
                          error: function(response){
                                console.log("error : " + JSON.stringify(response) );
                          }
                     });
               

         });
    });
</script>

<style type="text/css">
  output{
  width: 100%;
  min-height: 150px;
  display: flex;
  justify-content: flex-start;
  flex-wrap: wrap;
  gap: 15px;
  position: relative;
  border-radius: 5px;
}

output .image{
  height: 150px;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
  overflow: hidden;
  position: relative;
}

output .image img{
  height: 100%;
  width: 100%;
}

output .image span {
  position: absolute;
  top: -4px;
  right: 4px;
  cursor: pointer;
  font-size: 22px;
  color: white;
}

output .image span:hover {
  opacity: 0.8;
}

output .span--hidden{
  visibility: hidden;
}


</style>



@endsection