@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
     <div class="container-header">
        <label class="label-bold" id="div1">Petty Cash Expenses</label>

        <div id="div2" style="margin-right: 30px">
            <a class="btn btn-light btn-outline-secondary" href="{{route('pettycash')}}"> View PettyCash List</a>
        </div>

    </div>

    <div class="form-build">
     	<div class="row">
     			<div class="col-6">
     				<form method="post" action="{{route('upload_bills')}}" enctype="multipart/form-data">
     					@csrf
     					
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Amount (in rupees)*</label>
                            <div class="col-7">
                                <input name="amount" id="amount" type="number" class="form-control" required="required" placeholder="Enter Amount">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Date of Bill*</label>
                            <div class="col-7">
                                <input name="bill_date" id="bill_date" type="date" class="form-control" required="required" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Bill number*</label>
                            <div class="col-7">
                                <input name="bill_number" id="bill_number" type="text" class="form-control" required="required" placeholder="Enter Bill Number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-5 col-form-label">Purpose*</label>
                            <div class="col-7">
                                <select name="purpose" class="form-control" required="required">
                                    <option value="">Select purpose</option>
                                    <option value="Personal">Personal</option>
                                    <option value="Purchase">Purchase</option>
                                </select>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="" class="col-5 col-form-label" id="pcn_lable" style="display: none">PCN*</label>
                            <div class="col-7">
                                <input name="pcn" id="pcn" type="text" class="form-control" placeholder="Enter PCN" style="display: none" >
                                <span class="label-bold" id="pcn_detail"></span>
                            </div>
                               
                        </div>


                         <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Description* </label>
                            <div class="col-7">
                                <input name="comment" id="comment" type="text" class="form-control" placeholder="Enter description" required="required" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Upload bill</label>
                            <div class="col-7">
                               <!--  <input type="file" class="form-control form-control-sm" name="bill" id="imgInp" required> -->
                               <input class="form-control form-control-sm" type="file" id="upload-btn" name="image[]" accept="image/* , application/pdf" multiple />

                              
                
                            </div>

                        </div>

                         <div class="form-group row">
                              <output id="result" />
                               
                        </div>



                         <div class="form-group row">
                            <div class="offset-5 col-7">
                                <button  type="submit" class="btn btn-danger" id="btn_submit">Submit</button>
                                
                            </div>
                        </div>

                    	
     				</form>
     				
     			</div>

               
     		
     		
     	</div>
     	
     </div>



  </div>   
</div>

<script type="text/javascript">
    $('select').on('change', function() {

         if(this.value == "Purchase"){
            document.getElementById("pcn_lable").style.display= "block" ;
            document.getElementById("pcn").style.display= "block" ;
            document.getElementById("pcn").required = true;

         }
         else {
            document.getElementById("pcn_lable").style.display= "none" ;
            document.getElementById("pcn").style.display= "none" ;
            document.getElementById("pcn").required = false;
             document.getElementById("btn_submit").style.display= "block" ;
             document.getElementById("pcn_detail").style.display= "none" ;
         }
   
     });
</script>

<script type="text/javascript">
  $( document ).ready(function() {
    var btn = document.getElementById("btn_submit");
    

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
             // console.log(data);
            document.getElementById("pcn_detail").innerHTML="";
            document.getElementById("btn_submit").style.display= "none" ;
            

             if(data.length==0){
               document.getElementById("pcn_detail").innerHTML="PCN doesn't exists";
               var getValue=document.getElementById("pcn");
              
             }
             else {
            
                 response( data );
             }
             
            }
          });
        },
        select: function (event, ui) {
           $('#pcn').val(ui.item.label);
           $('#pcns').val(ui.item.label);

          
           var address = ui.item.client_name +' , '+  ui.item.brand  +' ,  '+  ui.item.location  +' ,'+  ui.item.area  +' , '+  ui.item.city +' , '+ ui.item.state;
          
          
          // $('#pcn_detail').val(address);
           document.getElementById("btn_submit").style.display= "block" ;
           document.getElementById("pcn_detail").innerHTML=address;
        
        }
      });
 
});
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
      //  if (!currFile.type.match('image')) continue; // Skip non-images.
      
        
        var imgReader = new FileReader();
        imgReader.fileName = currFile.name;
        imgReader.addEventListener('load', function(e1) {
          var img = e1.target;
         // var src = img.result;
          
          var div = document.createElement('div');
          div.className = 'thumbnail';
           if (currFile.name.match(/\.(jpg|jpeg|png|gif)$/i))
             {
              div.innerHTML = [
                  '<img class="thumb" src="' + img.result + '"' + 'title="' + img.fileName + '"/>',
                  '<label class="caption">' + img.fileName + '</label>'
                ].join('');
           }
        else {

           div.innerHTML = [
                  '<img class="thumb" src="' + "images/pdf.png" + '"' + 'title="' + img.fileName + '"/>',
                  '<label class="caption">' + img.fileName + '</label>'
                ].join('');
       
        }

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