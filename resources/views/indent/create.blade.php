@extends('layouts.app')

@section('content')
<style type="text/css">
    .highlight
    {
        background-color: #FFFFAF;
        color: Red;
        font-weight: bold;
    }
</style>


<div class="container">
	<div class="justify-content-centre">
		<div class="container-header">
            <label class="label-bold" id="div1">Create Indent</label>
                 
     </div>

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
      <div class="col-md-4 div-margin">
        <label>Project Code Number</label>
        <input name="pcn" id="pcn" type="text" class="typeahead form-control" required="required" placeholder="Search PCN " value="{{old('pcn')}}">
        <span class="label-bold" id="pcn_detail"></span>

      </div>

     	<div class="col-md-6 div-margin">
     		 <label>Search Materials</label>
     		<input class="typeahead form-control" type="text" name="product" id="product" placeholder="Search product code / product name / brand name" >

     	</div>

      <div class="col-md-1 div-margin">
        <label></label>
        <input class="btn btn-outline-secondary form-control" type= "button" value= "Add Item" onclick= "clearInput()">
        
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
           <button class="btn btn-danger div-margin" id="btn_submit">Submit</button>
          
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
              
                response(data)
            }
        });
    },
        select: function (event, ui) {

          $('#product').val(ui.item.value);
           var item_code = ui.item.item_code;
           var name = ui.item.name;
           var brand = ui.item.brand;
           var info = ui.item.information;
           var uom = ui.item.uom;

           populateinputs(item_code , name , brand , info , uom);
           
         
        }
      }).data("ui-autocomplete")._renderItem = function (ul, item) {
            var regx = new RegExp('(' + this.term + ')', 'ig');
           // var label = item.value.replace(regx, "<span class='highlight'>" + this.term + "</span>");
             var label = item.value.replace(regx, "<span class='highlight'>" + this.term + "</span>");
            return $("<li/>").data("ui-autocomplete-item", item).append($("<a>").html(label)).appendTo(ul);
        };
  
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

  
   console.log('INOF==',inform);

  $('#container').append('<tr><td><div class="row" id="row"> <div class="col-md-1"><label>Item Code</label><input class="form-control" type="text" name="indent[' + i + '][item_code]"  value="'+ item_code +'" readonly></div><div class="col-md-2"><label>Product Name</label><input class="form-control" type="text" name="indent[' + i + '][name]" value="'+ name +'" readonly></div><div class="col-md-1"><label>Brand</label><input class="form-control" type="text" name="indent[' + i + '][brand]"  value="'+ brand +'" readonly></div>  <div class="col-md-3"><label>Features</label>  <textarea class="form-control" onclick="adjustHeight(this)">'+ inform +'</textarea>     </div>  <div class="col-md-2"><label>Description</label><input class="form-control" type="text" name="indent[' + i + '][desc]" placeholder="Add additional comments" ></div><div class="col-md-1"><label>Quantity*</label><input class="form-control" type="number" name="indent[' + i + '][quantity]" id="quantity" min="1" required></div>  <div class="col-md-1"><label>UOM*</label><input class="form-control"  name="indent[' + i + '][uom]" value="'+ uom +'" required readonly></div>  <div class="col-md-1"><i class="fa fa-close remove-input-field"></i></div> </div></td></tr>');

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
            document.getElementById("pcn_detail").innerHTML="This PCN is Completed , Please contact your Super Admin for more information";
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
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            var regx = new RegExp('(' + this.term + ')', 'ig');
            var label = item.value.replace(regx, "<span class='highlight'>" + this.term + "</span>");
            return $("<li/>").data("ui-autocomplete-item", item).append($("<a>").html(label)).appendTo(ul);
        };
    });
</script>



@endsection