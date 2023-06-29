@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">Detailed PCN</label>
           <div id="div2">
            <a href="{{route('PCN')}}"><button class="btn btn-light btn-outline-secondary" >View PCN</button></a>
          </div>
          @if(Auth::user()->role_id == 1)
          <div id="div2" style="margin-right: 30px">
            <a href="{{route('create_pcn')}}">
             <button class="btn btn-light btn-outline-secondary" ><i class="fa fa-plus"></i>  Create PCN</button> </a>
          </div>
          @endif

           <div id="div3" style="margin-right: 30px">
             <a href="{{route('export-pcn')}}"><button class="btn btn-light btn-outline-secondary" > Download CSV</button></a>
          </div>


        </div>
        <div class="form-build">
            <div class="row">
                <div class="col-12">
                    <div class="card border-white">
                        <div class="table table-responsive">
                            <table class="table  table-lg table-hover">
                                <thead>
                                <tr>
                                   
                                    <th scope="col">PCN</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">City</th>
                                    <th scope="col">P_SD</th>
                                    <th scope="col">P_ED</th>
                                    <th scope="col">P_HD</th>
                                    <th scope="col">Targeted Days</th>
                                    <th scope="col">A_SD</th>
                                    <th scope="col">A_CD</th>
                                    <th scope="col">A_HD</th>
                                    <th scope="col">Days Achieved</th>
                                    <th scope="col">Status</th>
                                    <th></th>
                                </tr>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($pcns as $key => $value)
                                <tr>
                                    
                                    <td>{{$value->pcn}}</td>
                                    <td>{{$value->brand}}</td>
                                    <td>{{$value->area}}</td>
                                    <td>{{$value->city}}</td>
                                    
                                    <td><?php echo ($value->proposed_start_date) !='' ? date("d-m-Y", strtotime($value->proposed_start_date)):'' ; ?> </td>
                      
                                    <td><?php echo ($value->proposed_end_date) !='' ? date("d-m-Y", strtotime($value->proposed_end_date)):'' ; ?></td>
                                    <td>{{$value->approved_days}}</td>
                                    
                                    <td style="text-align: center; ">{{$value->targeted_days}}</td>
                                    <td><?php echo ($value->actual_start_date) !='' ? date("d-m-Y", strtotime($value->actual_start_date)):'' ; ?></td>
                                    <td><?php echo ($value->actual_completed_date) !='' ? date("d-m-Y", strtotime($value->actual_completed_date)):'' ; ?></td>
                                    <td style="text-align: center; ">{{$value->hold_days}}</td>
                                    <td style="text-align: center; ">{{$value->days_acheived}}</td>
                                    <td>{{$value->status}}</td>
                                    <td>
                                        <a href="{{route('edit_pcn',$value->pcn)}}"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                               @endforeach

                                </tbody>
                            </table>

                            <label>Showing {{ $pcns->firstItem() }} to {{ $pcns->lastItem() }}
                                    of {{$pcns->total()}} results</label>

                                {!! $pcns->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
