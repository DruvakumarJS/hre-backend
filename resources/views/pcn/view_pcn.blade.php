@extends('layouts.app')

@section('content')


<style type="text/css">
    td{
max-width: 100px;
overflow: hidden;
text-overflow: clip;
white-space: nowrap;
}
</style>

<div class="container-fluid">
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
          
          @if(Auth::user()->role_id != 14 AND Auth::user()->role_id != 9)
          <form method="POST" action="{{route('export-pcn')}}">
            @csrf
            <input type="hidden" name="search" value="{{$search}}">
             <div class="input-group mb-3">
            
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary" type="submit" >Download CSV</button>
                </div>
              </div>
           </form>
          @endif  
          </div>

          <div id="div2" style="margin-right: 30px">
           <form method="POST" action="{{route('search_pcn_details')}}">
            @csrf
             <div class="input-group mb-3">
                <input class="form-control" type="text" name="search" placeholder="Search here" value="{{$search}}">
                <div class="input-group-prepend">
                   <button class="btn btn-outline-secondary rounded-0" type="submit" >Search</button>
                </div>
              </div>
           </form>
          </div>


        </div>
        <div class="form-build">
            <div class="row">
                <div class="col-12">
                    <div class="card border-white">
                        <div class="card border-white table-wrapper-scroll-y tableFixHead" style="height: 600px; padding: 0px 5px 20px 20px">
                            <table class="table  table-lg table-hover">
                                <thead>
                                <tr>                                   
                                    <th scope="col">PCN</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">City</th>
                                    <th scope="col">P_SD</th>
                                    <th scope="col">P_ED</th>
                                    <th scope="col">P_HD</th>
                                    <th scope="col">T_Days</th>
                                    <th scope="col">A_SD</th>
                                    <th scope="col">A_CD</th>
                                    <th scope="col">A_HD</th>
                                    <th scope="col">Days Achieved</th>
                                    <th scope="col">DLP Date</th>
                                    <th scope="col">Status</th>
                                    <th></th>
                                </tr>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($pcns as $key => $value)
                                <tr>
                                    
                                    <td width="50px">{{$value->pcn}}</td>
                                    <td >{{$value->brand}}</td>
                                    <td>{{$value->city}} </td>
                                    <td width="100px"><?php echo ($value->proposed_start_date) !='' ? date("d-m-Y", strtotime($value->proposed_start_date)):'' ; ?> </td>
                      
                                    <td width="100px"><?php echo ($value->proposed_end_date) !='' ? date("d-m-Y", strtotime($value->proposed_end_date)):'' ; ?></td>
                                    <td>{{$value->approved_days}}</td>
                                    
                                    <td style="text-align: center; width: 20px;">{{$value->targeted_days}}</td>
                                    <td width="100px"><?php echo ($value->actual_start_date) !='' ? date("d-m-Y", strtotime($value->actual_start_date)):'' ; ?></td>
                                    <td width="100px"><?php echo ($value->actual_completed_date) !='' ? date("d-m-Y", strtotime($value->actual_completed_date)):'' ; ?></td>
                                    <td style="text-align: center; ">{{$value->hold_days}}</td>
                                    <td style="text-align: center; ">{{$value->days_acheived}}</td>
                                    <td><?php echo ($value->dlp_date) !='' ? date("d-m-Y", strtotime($value->dlp_date)):'' ; ?></td>
                                    <td>{{$value->status}}</td>
                                    @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2)
                                    <td>
                                        <a href="{{route('edit_pcn',$value->pcn)}}"><i class="fa fa-edit"></i></a>
                                    </td>
                                    @endif
                                </tr>
                               @endforeach

                                </tbody>
                            </table>

                            <label>Showing {{ $pcns->firstItem() }} to {{ $pcns->lastItem() }}
                                    of {{$pcns->total()}} results</label>

                                <div class="float">{!! $pcns->links('pagination::bootstrap-4') !!}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
