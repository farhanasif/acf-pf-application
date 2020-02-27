

@extends('master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit User Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">User</a></li>
          <li class="breadcrumb-item active"><a href="#">Edit User Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Edit User Information</h3>
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
           <form class="form-horizontal form-label-left" action="{{url('/update-user',$users->id)}}" method="post">
            @csrf
           	 <div class="form-group row">
			    <label  class="col-form-label col-md-2 col-sm-3 label-align">Name</label>
			    <div class="col-md-3 col-sm-3 ">
          <input type="name" class="form-control" name="name" placeholder="Name" value="{{$users->name}}">
          </div>
           <div class="col-md-2"></div>
          <label for="staff_code" class="col-form-label col-md-2 col-sm-3 label-align">Staff Code</label>
			    <div class="col-md-3 col-sm-3 ">
	            <select class="form-control select2bs4" name="staff_code">
                  @foreach ($alluserdata as $row)
                  <option <?php echo ($row->staff_code) ? "selected" : ""; ?> value="{{$row->staff_code}}">{{$row->staff_code}}</option>
                  @endforeach
	            </select>
			    </div>
			  </div>

			   <div class="form-group row">
			    <label  class="col-form-label col-md-2 col-sm-3 label-align">Email</label>
			    <div class="col-md-3 col-sm-3 ">
			    	 <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{$users->staff_code}}">
          </div>
          <div class="col-md-2"></div>
          <label for="role" class="col-form-label col-md-2 col-sm-3 label-align">Role</label>
			    <div class="col-md-3 col-sm-3 ">
	            <select class="form-control select2bs4" name="role">
                  @foreach ($alluserdata as $row)
                  <option <?php echo ($row->role) ? "selected" : ""; ?> value="{{$row->role}}">{{$row->role}}</option>
                  @endforeach
	            </select>
			    </div>
			  </div>

			   <div class="form-group row">
			    <label  class="col-form-label col-md-2 col-sm-3 label-align">Rights Body</label>
			    <div class="col-md-3 col-sm-3 ">
			    	 <input type="text" class="form-control" name="rights_body" placeholder="Rights Body" value="{{$users->rights_body}}">
          </div>

          <div class="col-md-2"></div>

          <label for="email" class="col-form-label col-md-2 col-sm-3 label-align">Mobile</label>
			    <div class="col-md-3 col-sm-3 ">
			    	 <input type="text" class="form-control" name="mobile"  placeholder="Mobile" value="{{$users->mobile}}">
			    </div>
        </div>
        
      <div class="form-group row">
       <label for="email" class="col-form-label col-md-2 col-sm-3 label-align">Designation</label>
       <div class="col-md-3 col-sm-3 ">
          <input type="text" class="form-control" name="designation" placeholder="Designation" value="{{$users->designation}}">
       </div>
       <div class="col-md-2"></div>
       <label for="email" class="col-form-label col-md-2 col-sm-3 label-align">Address</label>
       <div class="col-md-3 col-sm-3 ">
          <input type="text" class="form-control" name="address"  placeholder="Address" value="{{$users->address}}">
       </div>
     </div>

      <div class="form-group row">
       <label for="email" class="col-form-label col-md-2 col-sm-3 label-align">Department</label>
       <div class="col-md-3 col-sm-3 ">
          <input type="text" class="form-control" name="department"  placeholder="Department" >
       </div>
       <div class="col-md-2"></div>
       <label for="email" class="col-form-label col-md-2 col-sm-3 label-align">Description</label>
       <div class="col-md-3 col-sm-3 ">
          <textarea class="form-control" name="description" rows="5" cols="70" >{{$users->description}}</textarea>
       </div>
     </div>

     <div class="form-group row">
      <label for="role" class="col-form-label col-md-2 col-sm-3 label-align">Verified</label>
      <div class="col-md-3 col-sm-3 ">
          <select class="form-control select2bs4" name="verified">
              <option <?php echo ($row == '0') ? "selected" : ""; ?> value="0">0</option>
              <option <?php echo ($row == '1') ? "selected" : ""; ?> value="1">1</option>
          </select>
      </div>

      <div class="col-md-2"></div>

      <label for="role" class="col-form-label col-md-2 col-sm-3 label-align">User Type</label>
      <div class="col-md-3 col-sm-3 ">
          <select class="form-control select2bs4" name="user_type">
              <option <?php echo ($row == 'Admin') ? "selected" : ""; ?> value="Admin">Admin</option>
              <option <?php echo ($row == 'User') ? "selected" : ""; ?> value="User">User</option>
          </select>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-2"></div>
      <div class="col-md-3 col-sm-3">
          <button  type="submit" class="btn btn-success ">Submit</button>
      </div>
   </div>

			</form>
			            <!-- /.card -->
        </div>
      </div>
@endsection
