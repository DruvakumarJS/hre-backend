@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            
        
        <div class="container-header">
            <label class="label-bold" id="div1">Intend Details</label>
           <div id="div2">
            <a class="btn btn-light" href="">
             <label id="modal"> </label> </a>
          
          </div>
         
        </div>

        <div class="div-margin">
            <div class="HeadCounter">
                <div class="row">
                    <div class="col">
                        <label>Intend Number</label>
                        <h3 class="label-bold">{{$indend_data->indent->indent_no}}</h3>
                    </div>
                    <div class="col">
                        <label>PCN</label>
                        <h3 class="label-bold">{{$indend_data->indent->pcn}}</h3>
                    </div>
                    <div class="col">
                        <label>Dispatched</label>
                        <h3 class="label-bold">{{$dispatched}}</h3>
                    </div>
                    <div class="col">
                        <label>Pending</label>
                        <h3 class="label-bold">{{$indend_data->pending}}</h3>
                    </div>
                    <div class="col">
                        <label>Accepted</label>
                        <h3 class="label-bold">{{$indend_data->recieved}}</h3>
                    </div>
                </div>
            </div>



            <div class="row" style="margin-top: 20px">
                <div class="card border-white col-md-4">
                    <div>
                        <label>Material Category</label>
                        <div>
                            <label class="label-bold">{{$indend_data->materials->Category->category}}</label>
                        </div>
                    </div>

                    <div style="margin-top: 20px">
                        <label>Material Id</label>
                        <div>
                            <label class="label-bold">{{$indend_data->material_id}}</label>
                        </div>
                    </div>

                    <div style="margin-top: 20px">
                        <label>Material Name</label>
                        <div>
                            <label class="label-bold">{{$indend_data->materials->name}}</label>
                        </div>
                    </div>

                    <div style="margin-top: 20px">
                        <label>Brand Name</label>
                        <div>
                            <label class="label-bold">{{$indend_data->materials->brand}}</label>
                        </div>
                    </div>

                    <div style="margin-top: 20px">
                        <label>Material Description</label>
                        <div>
                            @php
                                $info = json_decode($indend_data->materials->information , true);

                            @endphp
                            @foreach($info as $key =>$value)
                                <label class="label-bold">{{$key}} : {{$value}}</label>
                                @php echo"<br/>"; @endphp
                            @endforeach
                        </div>
                    </div>

                    <div style="margin-top: 20px">
                        <label>Created Date</label>
                        <div>
                            <label class="label-bold">{{$indend_data->created_at}}</label>
                        </div>
                    </div>

                </div>
                <div class=" col-md-8 div-margin">
                    <div style="margin-left: 60px">
                        <form method="post" action="{{route('update_quantity')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="text" class="col-4 col-form-label">Quantity Dispatched</label>
                                <div class="col-4">
                                    <input id="text" type="text" class="form-control" placeholder="Enter numbers"
                                           name="quantity" required="required" value="{{old('quantity')}}">

                                </div>
                                <input type="hidden" name="indent_no" value="{{$indend_data->indent->indent_no}}">
                                <input type="hidden" name="pcn" value="{{$indend_data->indent->pcn}}">
                                <input type="hidden" name="id" value="{{$id}}">
                                <input type="hidden" name="pending" value="{{$indend_data->pending}}">
                                <div class="col-md-3">
                                    <button class="btn btn-danger">Submit</button>
                                </div>
                            </div>

                        </form>

                        @if(Session::has('message'))
                            <p id="mydiv" class="text-danger text-center div-margin">{{ Session::get('message') }}</p>
                        @endif


                        <label class="label-bolder div-margin">Recent Updates</label>

                        <div class="card">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>GRN</th>
                                <th>Dispatched</th>
                                <th>GRN Status</th>
                                <th>Accepted</th>
                                <th>Rejected</th>
                                <th>Dispatched Date</th>
                            </tr>
                            </thead>
                        @foreach($grn as $key =>$value)
                                <tr>
                                    <td>{{$value->grn}}</td>
                                    <td>{{$value->dispatched}}</td>
                                    <td>{{$value->status}}</td>
                                    <td>{{$value->approved}}</td>
                                    <td>{{$value->damaged}}</td>
                                    <td>{{$value->created_at}}</td>
                                </tr>
                        @endforeach
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
