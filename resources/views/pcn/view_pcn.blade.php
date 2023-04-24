@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">View PCN</label>
           <div id="div2">
            <button class="btn btn-light" >View PCN</button>

          </div>
          <div id="div2" style="margin-right: 30px">
             <button class="btn btn-light" ><i class="fa fa-plus"></i>  Create PCN</button>
          </div>

           <div id="div3" style="margin-right: 30px">
             <a href="{{route('export-pcn')}}"><button class="btn btn-light" > Download CSV</button></a>
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
                                    <th scope="col">Sl.no</th>
                                    <th scope="col">Project Code</th>
                                    <th scope="col">Client Name / Billing Name</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Type of Work</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">City</th>
                                    <th scope="col">State</th>
                                     <th scope="col">Proposed Start Date</th>
                                    <th scope="col">Proposed End Date</th>
                                    <th scope="col">Approve Holidays</th>
                                    <th scope="col">Target Date</th>
                                    <th scope="col">Actual Start Date</th>
                                    <th scope="col">Actual Completed Date</th>
                                    <th scope="col">Project Hold Days</th>
                                    <th scope="col">Actual Days Achived</th>
                                    <th scope="col">Status</th>
                                    <th></th>
                                </tr>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($pcns as $key => $value)
                                <tr>
                                    <td>{{$key + $pcns->firstItem()}}</td>
                                    <td>{{$value->pcn}}</td>
                                    <td>{{$value->client_name}}</td>

                                    <td>{{$value->brand}}</td>
                                    <td>{{$value->work}}</td>
                                    <td>{{$value->area}}</td>
                                    <td>{{$value->city}}</td>
                                    <td>{{$value->state}}</td>
                                    <td>{{$value->proposed_start_date}}</td>
                                    <td>{{$value->proposed_end_date}}</td>
                                    <td>{{$value->approve_holidays}}</td>
                                    <td>{{$value->targeted_days}}</td>
                                    <td>{{$value->actual_start_date}}</td>
                                    <td>{{$value->actual_completed_date}}</td>
                                    <td>{{$value->hold_days}}</td>
                                    <td>{{$value->days_acheived}}</td>
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
