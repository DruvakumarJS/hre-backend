@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container-header">
            <label class="label-bold" id="div1">Users Master / Procurement</label>
          <div id="div2">
             <button class="btn btn-light" ><i class="fa fa-plus"></i> Create User</button>
          </div>
           <div id="div3" style="margin-right: 30px">
             <button class="btn btn-light" > Download CSV</button>
          </div>
        </div>
    </div>
    <div class="page-container">
       <div class="row">
           <div class="col-12">
               <div class="create-form">
                   <h4>Create User</h4>
                   <div class="form-block">

                   </div>
               </div>
           </div>
       </div>
    </div>
</div>
@endsection
