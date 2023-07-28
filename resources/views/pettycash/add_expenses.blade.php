@extends('layouts.app')

@section('content')

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
            <form name="myForm">
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
                                <select name="purpose" id="purpose" class="form-control" required="required">
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
                              
                              <input type='file' id="file" name='file' multiple class="form-control">
                               <!-- Error -->
                               <div class='alert alert-danger mt-2 d-none text-danger' id="err_file"></div>

                            </div>

                        </div>

                         <div class="form-group row">
                            <div class="offset-5 col-7">
                                <button  type="button" class="btn btn-danger" id="submit" >Submit</button>
                                
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
    var btn = document.getElementById("submit");
    

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
            document.getElementById("submit").style.display= "none" ;
            

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
          
           setTimeout(function(){
          $('#pcn').val(ui.item.pcn);
          },500)
          // $('#pcn_detail').val(address);
           document.getElementById("submit").style.display= "block" ;
           document.getElementById("pcn_detail").innerHTML=address;
        
        }
      });
 
});
</script>

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
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
              
             var amount = $('#amount').val();
             var date = $('#bill_date').val();
             var bill_number = $('#bill_number').val();
             var purpose = $('#purpose').val();
             var pcn = $('#pcn').val();
             var comments = $('#comment').val();

             if(amount == ''){
              alert("Enter Amount");
              return;
             }
             if(date == ''){
              alert("Please Select Bill Date");
              return;
             }
             if(bill_number == ''){
              alert("Please Enter Bill number");
              return;
             }
             if(purpose == ''){
              alert("Please Select purpose");
              return;
             }
             if(purpose == 'Purchase' && pcn == ''){
              alert("Please Select PCN");
              return;
             }
             if(comments == ''){
              alert("Please Enter Descriptions");
              return;
             }

             if(imagesArray.length == 0){
              alert("Please Upload your Bill ");
              return;
             }

              
                     var fd = new FormData();

                      imagesArray.forEach(function(image, i) {
                         fd.append('file[]',image);
                      });

                     // Append data 
                    // fd.append('file',imagesArray);
                     fd.append('_token',CSRF_TOKEN);
                     fd.append('bill_date',date);
                     fd.append('bill_number',bill_number);
                     fd.append('amount',amount);
                     fd.append('purpose',purpose);
                     fd.append('pcn',pcn);
                     fd.append('comment',comments);   

                     // Hide alert 
                     $('#responseMsg').hide();

                     // AJAX request 
                     $.ajax({
                          url: "{{ route('upload_bills') }}",
                          method: 'post',
                          data: fd,
                          contentType: false,
                          processData: false,
                          dataType: 'json',
                          success: function(response){
                             // console.log(response);
                             // window.location.href = "{{ route('details_pettycash',1)}}";
                             alert("Bill Uploaded successfully");
                               window.location.href = location.reload();

                          },
                          error: function(response){
                                console.log("error : " + JSON.stringify(response) );
                          }
                     });
               

         });
    });
</script>





@endsection