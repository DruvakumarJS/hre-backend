@extends('layouts.app')

@section('content')
<div class="container">
	<div class="justify-content-centre">
		<div class="container-header">
            <label class="label-bold" id="div1">Create Indent</label>
                 
     </div>

     <div class="row">
     	<div class="col-md-4">
     		
     		<input class="typeahead form-control" type="text" name="product" id="product" placeholder="Enter product code / product name">
     		
     	</div>
     	
     	
     </div>
   <label class="div-margin label-bold">Selected Items</label>
     <div >
     	<div class="row">
	     	<div class="col-md-2">
	     		<label>Product Code</label>
	     		<input class="form-control" type="text" name="item_code" id="item_code" readonly>
	     		
	     	</div>

	     	<div class="col-md-2">
	     		<label>Product Name</label>
	     		<input class="form-control" type="text" name="name" id="name" readonly>
	     		
	     	</div>

	     	<div class="col-md-2">
	     		<label>Brand</label>
	     		<input class="form-control" type="text" name="brand" id="brand" readonly>
	     		
	     	</div>

	     	<div class="col-md-3">
	     		<label>Description</label>
	     		<input class="form-control" type="text" name="desc" id="desc" readonly>
	     		
	     	</div>

	     	<div class="col-md-2">
	     		<label>Quantity</label>
	     		<input class="form-control" type="text" name="quantity" id="quantity" required>
	     		
	     	</div>
	     	<div class="col-md-1">
	     		<i class="fa fa-close"></i>
	     		
	     	</div>
        </div>

     	
     </div>
		
	</div>
	

</div>	

<script type="text/javascript">

$( document ).ready(function() {
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
               
          
        }
      });

    
});

</script>


@endsection