
@extends('master')

@section('content')
   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Add User Information</h3>
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
           <form class="form-horizontal form-label-left" action="{{url('/save-user')}}" method="post">
             @csrf
           	 <div class="form-group row">
			    <label  class="col-form-label col-md-2 col-sm-3 label-align">Name</label>
			    <div class="col-md-6 col-sm-6 ">
			    	 <input type="name" class="form-control" name="name" placeholder="Name">
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="staff_code" class="col-form-label col-md-2 col-sm-3 label-align">Staff Code</label>
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
			    <label  class="col-form-label col-md-2 col-sm-3 label-align">Email</label>
			    <div class="col-md-6 col-sm-6 ">
			    	 <input type="email" class="form-control" name="email" placeholder="Enter email">
			    </div>
			  </div>
			   <div class="form-group row">
			    <label for="role" class="col-form-label col-md-2 col-sm-3 label-align">Role</label>
			    <div class="col-md-6 col-sm-6 ">
			    	 <!-- <input type="email" class="form-control"  placeholder="Enter email"> -->
	            <select class="form-control" name="role">
	                <option value="">--select--</option>
	                <option value="1">1</option>
	                <option value="2">2</option>
	            </select>
			    </div>
			  </div>
			   <div class="form-group row">
			    <label  class="col-form-label col-md-2 col-sm-3 label-align">Rights Body</label>
			    <div class="col-md-6 col-sm-6 ">
			    	 <input type="text" class="form-control" name="rights_body" placeholder="Rights Body" >
			    </div>
			  </div>
			   <div class="form-group row">
			    <label for="email" class="col-form-label col-md-2 col-sm-3 label-align">Mobile</label>
			    <div class="col-md-6 col-sm-6 ">
			    	 <input type="text" class="form-control" name="mobile"  placeholder="Mobile">
			    </div>
			  </div>
      <div class="form-group row">
       <label for="email" class="col-form-label col-md-2 col-sm-3 label-align">Designation</label>
       <div class="col-md-6 col-sm-6 ">
          <input type="text" class="form-control" name="designation" placeholder="Designation">
       </div>
     </div>

        <div class="form-group row">
        <label for="email" class="col-form-label col-md-2 col-sm-3 label-align">Address</label>
        <div class="col-md-6 col-sm-6 ">
           <input type="text" class="form-control" name="address"  placeholder="Address">
        </div>
      </div>
      <div class="form-group row">
       <label for="email" class="col-form-label col-md-2 col-sm-3 label-align">Department</label>
       <div class="col-md-6 col-sm-6 ">
          <input type="text" class="form-control" name="department"  placeholder="Department" >
       </div>
     </div>
     <div class="form-group row">
      <label for="email" class="col-form-label col-md-2 col-sm-3 label-align">Description</label>
      <div class="col-md-6 col-sm-6 ">
         <textarea class="form-control" name="description" rows="5" cols="70"></textarea>
      </div>
    </div>
     <div class="form-group row">
      <label for="role" class="col-form-label col-md-2 col-sm-3 label-align">Verified</label>
      <div class="col-md-6 col-sm-6 ">
          <select class="form-control" name="verified">
              <option value="">--select--</option>
              <option value="1">0</option>
              <option value="1">1</option>
          </select>
      </div>
    </div>

     <div class="form-group row">
      <label for="role" class="col-form-label col-md-2 col-sm-3 label-align">User Type</label>
      <div class="col-md-6 col-sm-6 ">
          <select class="form-control" name="user_type">
              <option value="">--select--</option>
              <option value="Admin">Admin</option>
              <option value="User">User</option>
          </select>
      </div>
    </div>
    <div class="form-group row">
    <label for="email" class="col-form-label col-md-2 col-sm-3 label-align"></label>
    <div class="col-md-6 col-sm-6 text-center ">
      <button  type="submit" class="btn btn-success ">Submit</button>
    </div>
    </div>

			</form>
			            <!-- /.card -->
        </div>
      </div>
@endsection
