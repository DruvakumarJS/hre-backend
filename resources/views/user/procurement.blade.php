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
           <div class="col-md-12">
               <div class="users-list">
                   <div class="card border-white">

                       <table class="table">
                           <thead>
                           <tr>
                               <th scope="col">Employee ID</th>
                               <th scope="col">Name</th>
                               <th scope="col">Email ID</th>
                               <th scope="col">Password</th>
                               <th scope="col">Mobile</th>
                               <th scope="col">Role</th>
                               <th scope="col">Action</th>
                           </tr>
                           </thead>
                           <tbody>
                               <tr>
                                   <td>EMP02022</td>
                                   <td>Kubulu Babu</td>
                                   <td>kubulu@netiapps.com</td>
                                   <td>9876543210</td>
                                   <td>password</td>
                                   <td>Procurement</td>
                                   <td><button class="btn btn-light btn-sm">Edit</button></td>
                               </tr>
                               <tr>
                                   <td>EMP02022</td>
                                   <td>Kubulu Babu</td>
                                   <td>kubulu@netiapps.com</td>
                                   <td>9876543210</td>
                                   <td>password</td>
                                   <td>Procurement</td>
                                   <td><button class="btn btn-light btn-sm">Edit</button></td>
                               </tr>
                               <tr>
                                   <td>EMP02022</td>
                                   <td>Kubulu Babu</td>
                                   <td>kubulu@netiapps.com</td>
                                   <td>9876543210</td>
                                   <td>password</td>
                                   <td>Procurement</td>
                                   <td><button class="btn btn-light btn-sm">Edit</button></td>
                               </tr>
                               <tr>
                                   <td>EMP02022</td>
                                   <td>Kubulu Babu</td>
                                   <td>kubulu@netiapps.com</td>
                                   <td>9876543210</td>
                                   <td>password</td>
                                   <td>Procurement</td>
                                   <td><button class="btn btn-light btn-sm">Edit</button></td>
                               </tr>
                               <tr>
                                   <td>EMP02022</td>
                                   <td>Kubulu Babu</td>
                                   <td>kubulu@netiapps.com</td>
                                   <td>9876543210</td>
                                   <td>password</td>
                                   <td>Procurement</td>
                                   <td><button class="btn btn-light btn-sm">Edit</button></td>
                               </tr>
                               <tr>
                                   <td>EMP02022</td>
                                   <td>Kubulu Babu</td>
                                   <td>kubulu@netiapps.com</td>
                                   <td>9876543210</td>
                                   <td>password</td>
                                   <td>Procurement</td>
                                   <td><button class="btn btn-light btn-sm">Edit</button></td>
                               </tr>
                               <tr>
                                   <td>EMP02022</td>
                                   <td>Kubulu Babu</td>
                                   <td>kubulu@netiapps.com</td>
                                   <td>9876543210</td>
                                   <td>password</td>
                                   <td>Procurement</td>
                                   <td><button class="btn btn-light btn-sm">Edit</button></td>
                               </tr>
                               <tr>
                                   <td>EMP02022</td>
                                   <td>Kubulu Babu</td>
                                   <td>kubulu@netiapps.com</td>
                                   <td>9876543210</td>
                                   <td>password</td>
                                   <td>Procurement</td>
                                   <td><button class="btn btn-light btn-sm">Edit</button></td>
                               </tr>
                               <tr>
                                   <td>EMP02022</td>
                                   <td>Kubulu Babu</td>
                                   <td>kubulu@netiapps.com</td>
                                   <td>9876543210</td>
                                   <td>password</td>
                                   <td>Procurement</td>
                                   <td><button class="btn btn-light btn-sm">Edit</button></td>
                               </tr>
                               <tr>
                                   <td>EMP02022</td>
                                   <td>Kubulu Babu</td>
                                   <td>kubulu@netiapps.com</td>
                                   <td>9876543210</td>
                                   <td>password</td>
                                   <td>Procurement</td>
                                   <td><button class="btn btn-light btn-sm">Edit</button></td>
                               </tr>

                           </tbody>
                       </table>

                   </div>

               </div>
           </div>
       </div>
    </div>
</div>
@endsection
