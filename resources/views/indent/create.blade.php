@extends('layouts.app')

@section('content')
<div class="container">
	<div class="justify-content-centre">
		<div class="container-header">
            <label class="label-bold" id="div1">Create Indent</label>
                 
     </div>

     @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
        @endif 


    <div class="div-margin">
      
   
     <div class="row">
      <div class="col-md-4 div-margin">
        <label>Project Code Number</label>
        <input name="pcn" id="pcn" type="text" class="typeahead form-control" required="required" placeholder="Search PCN " value="{{old('pcn')}}">
        <span class="label-bold" id="pcn_detail"></span>

      </div>

     	<div class="col-md-4 div-margin">
     		 <label>Search Materials</label>
     		<input class="typeahead form-control" type="text" name="product" id="product" placeholder="Search product code / product name / brand name" >

     	</div>

      <div class="col-md-1 div-margin">
        <label></label>
        <input class="btn btn-outline-secondary form-control" type= "button" value= "Add" onclick= "clearInput()">
        
      </div>
     	
     	
     </div>

     
     </div> 
  
     <div >
    
      <div id = "dynamic_form" style="display: none">

        <form method="post" action="{{route('save_indent')}}">
          @csrf
           <label class="div-margin label-bold">Selected Items</label>
         
           <div id="container"></div>
           <input type="hidden" name="pcn" id="pcns" required>
           <button class="btn btn-danger div-margin">Submit</button>
          
        </form>
        
      </div>
        

       

     	
     </div>
		
	</div>
	

</div>	

<script type="text/javascript">
  var i = 0;

$( document ).ready(function() {
//product
  var path = "{{ route('products') }}";
   let text = "";
    $( "#product" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
              
              console.log(data);
               response( data );
               
              
            }
          });
        },
        select: function (event, ui) {

          $('#product').val(ui.item.value);
           var item_code = ui.item.item_code;
           var name = ui.item.name;
           var brand = ui.item.brand;
           var desc = ui.item.information;
           var uom = ui.item.uom;

           populateinputs(item_code , name , brand , desc , uom);
           
         
        }
      });
    
});

 $(document).on('click', '.remove-input-field', function () {
//  alert(i);
  //document.getElementById("row").remove();
  Swal.fire({
  title: 'Are you sure to remove this material?',
 // text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, remove it!'
}).then((result) => {
  if (result.isConfirmed) {
   // document.getElementById("row").remove();
   $(this).parents('tr').remove();
   // clearInput();
   /* Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )*/
  }
})
  
    });

function populateinputs(item_code , name ,  brand , desc , uom){
   var x = document.getElementById("dynamic_form");
   if (x.style.display === "none") {
    x.style.display = "block";
  } 

   var description = desc ;
  // alert(description);

  $('#container').append('<tr><td><div class="row" id="row"> <div class="col-md-2"><label>Product Code</label><input class="form-control" type="text" name="indent[' + i + '][item_code]"  value="'+ item_code +'" readonly></div><div class="col-md-2"><label>Product Name</label><input class="form-control" type="text" name="indent[' + i + '][name]" value="'+ name +'" readonly></div><div class="col-md-2"><label>Brand</label><input class="form-control" type="text" name="indent[' + i + '][brand]"  value="'+ brand +'" readonly></div><div class="col-md-3"><label>Description</label><input class="form-control" type="text" name="indent[' + i + '][desc]" placeholder="Add additional comments" ></div><div class="col-md-1"><label>Quantity*</label><input class="form-control" type="number" name="indent[' + i + '][quantity]" id="quantity" min="1" required></div>  <div class="col-md-1"><label>UOM*</label><input class="form-control"  name="indent[' + i + '][uom]" value="'+ uom +'" required></div>  <div class="col-md-1"><i class="fa fa-close remove-input-field"></i></div> </div></td></tr>');    
    ++i;
  

        }

 
</script>
<script type="text/javascript">
  function clearInput(){
    //alert("ll");
      var getValue= document.getElementById("product");
        if (getValue.value !="") {
            getValue.value = "";
        }
 }
</script>
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
             // console.log(data);
               response( data );
              
            }
          });
        },
        select: function (event, ui) {
           $('#pcn').val(ui.item.label);
           $('#pcns').val(ui.item.label);

           var address = ui.item.client_name +' , '+  ui.item.brand  +' ,  '+  ui.item.location  +' ,'+  ui.item.area  +' , '+  ui.item.city +' , '+ ui.item.state;
          
          // $('#pcn_detail').val(address);
           document.getElementById("pcn_detail").innerHTML=address;
        
        }
      });
 
});
</script>


@endsection