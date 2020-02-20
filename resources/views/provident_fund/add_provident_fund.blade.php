@extends('master')

@section('content')
   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Add Provident Fund Information</h3>
        </div>
        @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
           <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
          </div>
          @endif

          @if ($errors->any())
        <div class="alert alert-warning">
          <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
              </div>
          @endif

        <div class="card-body">
          <!-- /.card -->
            <!-- Horizontal Form -->
           <form class="form-horizontal form-label-left" action="{{url('/save-provident-fund')}}" method="post">
             @csrf
          <!-- <div class="form-group row">
  			    <label for="deposit_date" class="col-form-label col-md-3 col-sm-3 label-align">Deposit Date</label>
  			       <div class="col-md-6 col-sm-6 ">
  			    	       <input type="date" class="form-control" name="deposit_date">
  			        </div>
			     </div> -->

			  <div class="form-group row">
			    <label for="staff_code" class="col-form-label col-md-3 col-sm-3 label-align">Staff Code</label>
			    <div class="col-md-6 col-sm-6 ">
			    	 <!-- <input type="email" class="form-control"  placeholder="Enter email"> -->
	            <select class="form-control" name="staff_code">
	                <option value="">--select--</option>
	                <option value="1">1</option>
	                <option value="2">2</option>
	            </select>
			    </div>
			  </div>
			   <div class="form-group row">
			    <label for="own_pf" class="col-form-label col-md-3 col-sm-4 label-align">Own Provident</label>
			    <div class="col-md-6 col-sm-6 ">
			    	 <input type="number" class="form-control" name="own_pf" placeholder="Own Provident">
			    </div>
			  </div>
        <div class="form-group row">
         <label for="organization_pf" class="col-form-label col-md-3 col-sm-4 label-align">Organization Provident</label>
         <div class="col-md-6 col-sm-6 ">
            <input type="number" class="form-control" name="organization_pf" placeholder="Organization Provident">
         </div>
       </div>

    <div class="form-group row">
    <label for="email" class="col-form-label col-md-3 col-sm-4 label-align"></label>
    <div class="col-md-6 col-sm-6 text-center ">
      <button  type="submit" class="btn btn-success ">Submit</button>
    </div>
    </div>

			</form>
			            <!-- /.card -->
        </div>
      </div>
@endsection
