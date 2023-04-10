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
           <div class="col-4">
               <div class="create-form">
                   <h4>Create User</h4>
                   <div class="form-block">
                       <form>
                           <div class="form-group">
                               <label for="text1">Employee ID</label>
                               <input id="text1" name="text1" type="text" class="form-control">
                           </div>
                           <div class="form-group">
                               <label for="text">Name</label>
                               <input id="text" name="text" type="text" class="form-control">
                           </div>
                           <div class="form-group">
                               <label for="text2">Email</label>
                               <input id="text2" name="text2" type="text" class="form-control">
                           </div>
                           <div class="form-group">
                               <label for="text3">Password</label>
                               <input id="text3" name="text3" type="text" class="form-control">
                           </div>
                           <div class="form-group">
                               <label for="text4">Mobile Number</label>
                               <input id="text4" name="text4" type="text" class="form-control">
                           </div>
                           <div class="form-group">
                               <label for="select">Role</label>
                               <div>
                                   <select id="select" name="select" class="custom-select form-control">
                                       <option value="">Procurement</option>
                                       <option value="">Supervisor</option>
                                       <option value="">Project Manager</option>
                                       <option value="">Finance</option>
                                       <option value="">Admin</option>
                                   </select>
                               </div>
                           </div>
                           <div class="form-group">
                               <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
    </div>
</div>
@endsection
