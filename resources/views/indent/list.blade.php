@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Indent</label>

            <!-- <a href="{{route('filter_indents','Active')}}"
                class="{{request()->routeIs('filter_indents')? 'link-dark active' : ''}}" >
                <label id="div1" style="margin-left: 50px" class="nav-links">Active11({{$activeCount}})</label></a>
            -->

            
            <a class="{{request()->routeIs('filter_indents')
                      ? 'active' : ''}}"
                       href="{{route('filter_indents','all')}}" > <button class="btn" id="div1" style="margin-left: 50px">All({{$all}})</button> </a>

            <label  style="margin-left: 20px;margin-top: 10px" class="label-medium" id="div1">|</label>
            
            <a class="{{request()->routeIs('filter_indents')
                      ? 'active' : ''}}" href="{{route('filter_indents','Active')}}"><button class="btn" id="div1" style="margin-left: 20px">Active({{$activeCount}})</button></a>


            <label  style="margin-left: 20px;margin-top: 10px" class="label-medium" id="div1">|</label>
          
            <a class="{{request()->routeIs('filter_indents')
                      ? 'active' : ''}}" href="{{route('filter_indents','Completed')}}">
              <button class="btn" id="div1" style="margin-left: 20px">Completed({{$compltedCount}})</button>
              </a>
          
         
          <div id="div2" >
            <a href="{{route('create_indent')}}"><button class="btn btn-light btn-outline-secondary" > Create Indent</button></a>
             
          </div>

          <div id="div2" style="margin-right: 30px">
            <a href="{{route('grn')}}"><button class="btn btn-light btn-outline-secondary" > GRN</button></a>
             
          </div>

          <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('search_indent')}}">
            @csrf
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search here">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>


        
          
        </div>
      <div class="page-container">
        <div class="div-margin">
        	
        	<div class="card border-white">

                        <table class="table" id="Table1">
                          <thead>
                            <tr>
                              <th style="display:none;">id </th>
                              <th scope="col">Creation Date</th>
                              <th scope="col">Indent Number</th>
                              <th scope="col">PCN</th>
                              <th scope="col">Billing Details </th>
                              <th scope="col">Indent Owner</th>
                              <th scope="col">Status</th>
                              
                              <th scope="col">Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($indents as $key =>$value)
                              <tr> 
                                <td style="display:none;">{{$value->id}}</td>
                                <td>{{date("d-m-Y", strtotime($value->created_at))}}</td> 
                                <td>{{$value->indent_no}}</td> 
                                <td>{{$value->pcn}}</td> 
                                <td >{{$value->pcns->brand}} , {{$value->pcns->location}} , {{$value->pcns->area}} , {{$value->pcns->city}}</td> 
                                <td>{{$value->user->name}}</td>  
                                <td>{{$value->status}}</td>
                                
                                <td> 
                                  <a href="{{route('indent_details',$value->indent_no)}}"><button class="btn btn-light curved-text-button btn-sm">View</button></a>

                                  <a onclick="return confirm('Are you sure to download?')" href="{{route('export_indent',$value->id)}}" style="margin-left: 10px; color: black"><i class='fa fa-download'></i></a>
                                  <input type="checkbox" id="check" name="check" value="{{$value->id}}">
                                </td>
                                
                              </tr>
                          @endforeach
                            
                          </tbody>
                        </table>
                      <form id="theForm" method="POST" action="download_multiple_indents">
                        @csrf
                        <input type="hidden" name="selctedindent" id="selctedindent">
                        <button class="btn btn-sm btn-light btn-outline-secondary" id="download" onclick="GetSelected()">Download Selected Indents</button>
                      </form>  
                    
                       

                         <label>Showing {{ $indents->firstItem() }} to {{ $indents->lastItem() }}
                                    of {{$indents->total()}} results</label>

                                {!! $indents->links('pagination::bootstrap-4') !!}
                        
                        
                    </div>
                    <!--</div>-->
                 </div>
        </div>
      </div>    	
    </div>
</div>

<script type="text/javascript">
    function GetSelected() {
        //Reference the Table.
        var indentarray=[];
        var message = '';
       
        var grid = document.getElementById("Table1");
 
        //Reference the CheckBoxes in Table.
        var checkBoxes = grid.getElementsByTagName("INPUT");
      
        //Loop through the CheckBoxes.
        for (var i = 0; i < checkBoxes.length; i++) {
            if (checkBoxes[i].checked) {
                var row = checkBoxes[i].parentNode.parentNode;
            
                indentarray.push(row.cells[1].innerHTML);
                message +=row.cells[0].innerHTML
                message += ",";

               
            }
        }
        
        document.getElementById('selctedindent').value=message;

        document.getElementById('theForm').submit();
       // alert(message);
       
    
       /* $.ajax({
            url:"{{route('download_multiple_indents')}}",
            type: 'POST',
            data:{ indent:indentarray,  '_token': '{!! csrf_token() !!}'},
             success: function( data ) {
              console.log(data);
            
            },
        });*/
    }

</script>
@endsection