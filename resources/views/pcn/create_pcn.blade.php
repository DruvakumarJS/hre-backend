@extends('layouts.app')

@section('content')
  
<div class="container">
    <div class="row justify-content-center">
       <div class="container-header">
            <label class="label-bold" id="div1">Create PCN</label>
           <div id="div2">
            <button class="btn btn-light" >View PCN</button>

          </div>
          <div id="div2" style="margin-right: 30px">
             <button class="btn btn-light" ><i class="fa fa-plus"></i>  Create PCN</button>
          </div>

           <div id="div3" style="margin-right: 30px">
             <button class="btn btn-light" > Download CSV</button>
          </div>


        </div>
        <div class="form-build">
            <div class="row">
                <div class="col-6">
                    <form>
                        <h3>Project Details</h3>
                        <div class="form-group row">
                            <label for="text" class="col-5 col-form-label">Project Code</label>
                            <div class="col-7">
                                <input id="text" name="text" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Client Name / Billing Name</label>
                            <div class="col-7">
                                <input name="client_name" id="client_name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Brand Name</label>
                            <div class="col-7">
                                <input id="" name="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Type of Work</label>
                            <div class="col-7">
                                <select id="" name="" class="custom-select form-control">
                                    <option value="">Re-furbishment</option>
                                    <option value="">Furniture Supply</option>
                                    <option value="">New Project</option>
                                </select>
                            </div>
                        </div>

                        <hr/>
                        <h3>Location Details</h3>

                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Location</label>
                            <div class="col-7">
                                <input id="" name="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">City</label>
                            <div class="col-7">
                                <select id="" name="" class="custom-select form-control"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">State</label>
                            <div class="col-7">
                                <select id="" name="" class="custom-select form-control"></select>
                            </div>
                        </div>

                        <hr/>
                        <h3>Completion Details</h3>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Proposed Project Start Date</label>
                            <div class="col-7">
                                <input id="" name="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Proposed Project End Date</label>
                            <div class="col-7">
                                <input id="" name="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Target Date</label>
                            <div class="col-7">
                                <input id="" name="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text1" class="col-5 col-form-label">Actual Start Date</label>
                            <div class="col-7">
                                <input id="text1" name="text1" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Actual Completed Date</label>
                            <div class="col-7">
                                <input id="" name="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-5 col-form-label">Project Hold Days</label>
                            <div class="col-7">
                                <input id="" name="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text2" class="col-5 col-form-label">Actual Days Achived</label>
                            <div class="col-7">
                                <input id="text2" name="text2" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-5 col-7">
                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                <button name="submit" type="submit" class="btn btn-link">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>

var path = "{{ route('autocomplete') }}";

$('#client_name').typeahead({

    source: function(query, process){

        return $.get(path, {query:query}, function(data){
        //console.log(data['brand']);
            return process(data);

        });

    }

});




</script>

@endsection
