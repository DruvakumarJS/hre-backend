@extends('layouts.app')

@section('content')

<style type="text/css">
   .highlighted {
      background-color: yellow;
      font-weight: bold;
  }

</style>

<div class="container">
	<div class="justify-content-centre">
		<div class="container-header">
            <label class="label-bold" id="div1">Create Indent</label>
                 
     </div>

        <!-- <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('filter_materials')}}" >
            @csrf
             <div class="input-group mb-3">
             
                <input class="form-control" type="text" name="search" placeholder="Search ticket">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div> -->

     @if(Session::has('message'))
            <p id="mydiv" class="text-danger text-center">{{ Session::get('message') }}</p>
     @endif 

     @if(session()->has('Indent'))
       <script>
        $(document).ready(function(){
            $('#modal').modal('show');
          });
        
        </script>

        <!--  Modal -->
          <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Indent Created Succesfully</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   @php
                  $data= Session::get('Indent');

                  @endphp
                  
                  <div>
                     <label>Indent No : </label> <label class="label-bold">{{$data['indent_no']}}</label>
                  </div>
                   <div>
                     <label>PCN : </label> <label class="label-bold">{{$data['pcn']}}</label>
                  </div>
                   
                   <div>
                     <label class="label-bold">{{$data['detail']}}</label>
                  </div>

                  <div id="div2">
                    <a href="{{route('intends')}}"><button class="btn btn-success">OK , GOT IT</button></a>
                    
                  </div>
                  
                </div>
                
              </div>
            </div>
          </div>
  <!-- Modal -->
    @endif


    <div class="div-margin">
      
   
     <div class="row">
      <div class="col-md-3 div-margin">
        <label>Project Code Number</label>
        <input name="pcn" id="pcn" type="text" class="typeahead form-control" required="required" placeholder="Search PCN " value="{{old('pcn')}}">
        <span class="label-bold" id="pcn_detail"></span>

      </div>

      <div class="col-md-3 div-margin" >
       
        <label>Search Item Code</label>
         <div class="input-group mb-3">
            <input class="form-control" type="text" id="code" name="search" placeholder="Ex : CVL001" >
            <div class="input-group-prepend">
               <button class="btn btn-outline-secondary rounded-0" type="submit" id="call-api-btn">Add Item</button>
            </div>
          </div>
       
      </div>

     	<div class="col-md-4 div-margin">
     		 <label>Search Materials (Material Name,Brand,param1,param2...)</label>
     		<input class="typeahead form-control form-select" type="text" name="product" id="product" placeholder=" Material name,Brand,param1,param2..." >

     	</div>

      <div class="col-md-1 div-margin">
        <label></label>
        <input class="btn btn-outline-secondary form-control" type= "button" value= "Clear" onclick= "clearInput()">
        
      </div>
     	
     	
     </div>


     
     </div> 
  
     <div >
    
      <div id = "dynamic_form" style="display: none">

        <form id="form" method="post" action="{{route('save_indent')}}" onsubmit="return confirmSubmit()">
          @csrf
           <label class="div-margin label-bold">Selected Items</label>
         
           <div id="container"></div>
           <input type="hidden" name="pcn" id="pcns" required>
           <button class="btn btn-danger div-margin" id="btn_submit" type="submit" style="display: none" >Submit</button>
          
        </form>
        
      </div>

     </div>
		
	</div>
	

</div>	

<script type="text/javascript">
  var i = 0;

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
            
            success: function (data) {
               // console.log(data);
               //var mm=data.replace('/\s+/','');
              // alert(data);
                response(data);
            }
        });
    },
    open: function(event, ui) {
         // var terms = $("#product").val().toLowerCase().split(/\s+/); // Split search terms by whitespace
           var terms = $("#product").val().toLowerCase().split(/\s*,\s*/);
          $(".ui-menu-item").each(function() {
              var itemText = $(this).text();
              var highlightedText = itemText;
              terms.forEach(function(term) {
                  if ( (term.trim() !== "" && isNaN(term) && term.length > 1) || (!isNaN(term) && term.trim() !== "" ) ){
                      highlightedText = highlightedText.replace(new RegExp($.ui.autocomplete.escapeRegex(term), "gi"), function(matched) {
                          return "<span class='ui-autocomplete-highlight'>" + matched + "</span>";
                      });
                  }
              });
              $(this).html(highlightedText);
          });
           // Scroll the list to show the highlighted item if it's out of view
            var $menu = $(".ui-autocomplete");
            var $highlightedItem = $menu.find(".ui-state-highlight");
            if ($highlightedItem.length > 0) {
                var menuHeight = $menu.height();
                var itemTop = $highlightedItem.position().top;
                var itemHeight = $highlightedItem.outerHeight(true);
                if (itemTop < 0) {
                    $menu.scrollTop($menu.scrollTop() + itemTop); // Scroll up
                } else if (itemTop + itemHeight > menuHeight) {
                    $menu.scrollTop($menu.scrollTop() + itemTop + itemHeight - menuHeight); // Scroll down
                }
            }
      },

        select: function (event, ui) {

          $('#product').val(ui.item.value);
           var item_code = ui.item.item_code;
           var name = ui.item.name;
           var brand = ui.item.brand;
           var info = ui.item.information;
           var uom = ui.item.uom;

           populateinputs(item_code , name , brand , info , uom);
           
         setTimeout(function() {
           $('#product').val('');
         }, 100);
         
        }
      }).on("keydown", function(event) {
        // Highlight the focused item when arrow keys are pressed
        var $menu = $(".ui-autocomplete");
        var $items = $menu.find(".ui-menu-item");
        var currentIndex = $items.index($menu.find(".ui-state-highlight"));

        if ($items.length > 0 && (event.which === 38 || event.which === 40)) {
            $items.removeClass("ui-state-highlight");
            if (event.which === 38 && currentIndex > 0) {
                $items.eq(currentIndex - 1).addClass("ui-state-highlight");
            } else if (event.which === 40 && currentIndex < $items.length - 1) {
                $items.eq(currentIndex + 1).addClass("ui-state-highlight");
            }
        }
    });
  // Highlight item when mouseover
    $(document).on("mouseover", ".ui-menu-item", function() {
        $(this).addClass("ui-state-highlight").siblings().removeClass("ui-state-highlight");
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

function populateinputs(item_code , name ,  brand , info , uom){
   var x = document.getElementById("dynamic_form");
   var isDecimal =false;
   if (x.style.display === "none") {
    x.style.display = "block";
  } 
 const JSONobject = JSON.parse(info); 
 
  const res_array = []; 
   for(let i in JSONobject) { 
      res_array.push([i,JSONobject[i]]); 
   };
var inform ="";
   Object.entries(JSONobject).forEach(([key, value]) => {
  //  console.log(`${key} = ${value}`);
     inform = inform +'\n'+ `${key} = ${value}` ;
});
   if(uom == 'Units' || uom == 'Cbm' || uom == 'Cft' || uom == 'Tonne' || uom =='Ltr' || uom =='Ltrs' || uom == 'Kgs'){
    isDecimal = true;
    
   }
  
  var inputType = isDecimal ? "number" : "number";
  var additionalAttributes = '';
  if (isDecimal) {
      additionalAttributes = 'step="0.01"'; // Allows decimal input with two decimal places
  } else {
      additionalAttributes = 'pattern="[0-9]*" min="1"'; // Allows only integer input
  }

  
   console.log('INOF==',inform);

  $('#container').prepend('<tr><td><div class="row" id="row"> <div class="col-md-2"><label>Item Code</label><input class="form-control scrollable-cell" type="text" name="indent[' + i + '][item_code]"  value="'+ item_code +'" data-toggle="tooltip" data-placement="top" title="'+ item_code +'"readonly></div><div class="col-md-2"><label>Product Name</label><input class="form-control scrollable-cell" type="text" name="indent[' + i + '][name]" value="'+ name +'" data-toggle="tooltip" data-placement="top" title="'+ name +'" readonly></div><div class="col-md-1"><label>Brand</label><input class="form-control scrollable-cell" type="text" name="indent[' + i + '][brand]"  value="'+ brand +'" data-toggle="tooltip" data-placement="top" title="'+ brand +'" readonly></div>  <div class="col-md-2"><label>Features</label>  <textarea class="form-control" onclick="adjustHeight(this)" readonly>'+ inform +'</textarea>     </div>  <div class="col-md-2"><label>Description</label><input class="form-control scrollable-cell" type="text" name="indent[' + i + '][desc]" placeholder="Add additional comments" ></div><div class="col-md-1"><label>Quantity*</label><input class="form-control scrollable-cell" type='+ inputType + ' name="indent[' + i + '][quantity]" id="quantity"  ' + additionalAttributes + ' required></div>  <div class="col-md-1"><label>UOM*</label><input class="form-control scrollable-cell"  name="indent[' + i + '][uom]" value="'+ uom +'" required data-toggle="tooltip" data-placement="top" title="'+ uom +'" readonly></div>  <div class="col-md-1"><i class="fa fa-close remove-input-field"></i></div> </div></td></tr>');

  if (!isDecimal) {
    $('#quantity').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, ''); // Allow only digits
    });
}


  setTimeout(function(){
  adjustHeight(this);       
},1000)
 
    ++i;
  


        }

 function adjustHeight(el){
    el.style.height = (el.scrollHeight > el.clientHeight) ? (el.scrollHeight)+"px" : "60px";
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
           $('#pcns').val(ui.item.pcn);

           var address = ui.item.brand  +' ,  '+  ui.item.location  +' ,'+  ui.item.area  +' , '+  ui.item.city +' , '+ ui.item.state +' , '+ ui.item.pincode;
          
          // $('#pcn_detail').val(address);
          setTimeout(function(){
          $('#pcn').val(ui.item.pcn);
          },500)

          if(ui.item.status == 'Completed'){
            document.getElementById("pcn_detail").innerHTML="Selected Project is Completed, Please contact super Admin for more information";
            $('#pcn_detail').css('color', 'red');
            document.getElementById("btn_submit").style.display= "none" ;
          }
          else if(ui.item.status == 'Cancelled'){
            document.getElementById("pcn_detail").innerHTML="Selected Project is Cancelled, Please contact super Admin for more information";
            $('#pcn_detail').css('color', 'red');
            document.getElementById("btn_submit").style.display= "none" ;
          }
          else {
            document.getElementById("btn_submit").style.display= "block" ;

           document.getElementById("pcn_detail").innerHTML=address;
           $('#pcn_detail').css('color', 'black');
          }
          
           
        
        }
      });
 
});
</script>

<style type="text/css">
  textarea {
min-height: 60px;
overflow-y: auto;
word-wrap:break-word
}

.highlight
    {
        background-color: #FFFFAF;
        color: Red;
        font-weight: bold;
    }

</style>


  <script type="text/javascript">
    $(function () {
        $("#rerer").autocomplete({
            source: function (request, response) {
                $.ajax({
                  url: "{{ route('products') }}",
                  type: 'GET',
                  dataType: "json",
                  data: {
                     search: request.term
                  },
                    success: function (data) {
                      console.log(data);
                         response($.map(data, function (item) {
                                return {
                                    label: item.split('-')[0],
                                    val: item.split('-')[1]
                                }
                            }))

                    },
                    error: function (response) {
                        alert(response.responseText);
                    },
                    failure: function (response) {
                        alert(response.responseText);
                    }
                });
            },
            select: function (e, i) {
                if (i.item.val == -1) {
                    $('[id$=txtSearch]').val("");
                    return false;
                } else {
                    $("[id$=hfCustomerId]").val(i.item.val);
                }
            },
            minLength: 1
        })
    });
</script>

<!-- <script>
$(document).ready(function() {
    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');
    });
});
</script>
 -->

<script>

    $(document).ready(function(){
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        // Bind event handler for dropdown change
       
        $("#call-api-btn").click(function(){
            var code = $('#code').val();
            var name = $('#name').val();
            var brand = $('#brand').val();
            var feature = $('#feature').val();
            var path = "{{ route('get_products') }}";

            if(code){
                $.ajax({
                    url: path,
                    type: 'GET',
                    data: {
                        'code': code,
                        'name': name,
                        'brand': brand,
                        'feature': feature,
                        '_token': CSRF_TOKEN
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        if(data.input == 'code'){
                            if(data.item.length == 0){
                                alert('Invalid Item Code')
                                $('#code').val('');
                            } else {
                                var item_code = data.item.item_code;
                                var name = data.item.name;
                                var brand = data.item.brand;
                                var info = data.item.information;
                                var uom = data.item.uom;

                                $('#code').val('');
                                populateinputs(item_code , name , brand , info , uom);
                            }
                        } 
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                        alert('Error occurred while calling the API.');
                    }


                });

            } else {
                alert('Please Enter the Item Code . Ex: CVL001')
            }
        });



        
    });

     function confirmSubmit() {
      // Show confirmation dialog
     let userConfirmed = confirm("Are you sure you want to submit the form?");
            
            // Display message based on user's choice
            if (userConfirmed) {
                $('button').attr('disabled', 'disabled');
                return true; // Proceed with form submission
            } else {
                alert("Form submission canceled.");
                return false; // Cancel form submission
            }
    }
</script>







@endsection