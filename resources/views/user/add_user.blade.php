
@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Add Employeer Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Employeer</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Employeer Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Add Employeer Information</h3>
        </div>


        @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block text-center">
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
           <form class="form-horizontal form-label-left" action="{{route('save-user')}}" method="post">
             @csrf
   
               <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label  class="col-form-label col-md-3 col-sm-3 label-align">Name</label>
                      <div class="col-md-8 col-sm-3 ">
                        <input type="name" class="form-control" name="name" placeholder="Name">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label  class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                      <div class="col-md-8 col-sm-8 ">
                         <input type="email" class="form-control" name="email" placeholder="Enter email">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label  class="col-form-label col-md-3 col-sm-3 label-align">Rights Body</label>
                      <div class="col-md-8 col-sm-8 ">
                         <input type="text" class="form-control" name="rights_body" placeholder="Rights Body" >
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Designation</label>
                        <div class="col-md-8 col-sm-8 ">
                          <input type="text" class="form-control" name="designation" placeholder="Designation">
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Department</label>
                        <div class="col-md-8 col-sm-8 ">
                          <input type="text" class="form-control" name="department"  placeholder="Department" >
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Description</label>
                        <div class="col-md-8 col-sm-8 ">
                          <textarea class="form-control" name="description" rows="5" cols="70"></textarea>
                        </div>
                    </div>

                    </div>

                  <div class="col-md-6 ">
                    <div class="form-group row ">
                      <label for="staff_code" class="col-form-label col-md-3 col-sm-3 label-align offset-1">Staff Code</label>
                        <div class="col-md-8 col-sm-8 ">
                          <select class="form-control select2bs4" name="staff_code">
                                <option value="">--select--</option>
                                @foreach ($employees as $employee)
                                  <option value="{{$employee->staff_code}}">{{$employee->staff_code}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="form-group row ">
                        <label for="role" class="col-form-label col-md-3 col-sm-3 label-align offset-1">Role</label>
                        <div class="col-md-8 col-sm-3 ">
                          <select class="form-control select2bs4" name="role">
                            <option value="">--select--</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                         </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="email" class="col-form-label col-md-3 col-sm-3 label-align offset-1">Mobile</label>
                        <div class="col-md-8 col-sm-8 ">
                           <input type="text" class="form-control" name="mobile"  placeholder="Mobile">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="email" class="col-form-label col-md-3 col-sm-3 label-align offset-1">Address</label>
                          <div class="col-md-8 col-sm-8 ">
                            <input type="text" class="form-control" name="address"  placeholder="Address">
                          </div>
                      </div>

                                          
                    <div class="form-group row">
                      <label for="role" class="col-form-label col-md-3 col-sm-3 label-align offset-1">Verified</label>
                      <div class="col-md-8 col-sm-8 ">
                        <select class="form-control select2bs4" name="verified">
                            <option value="">--select--</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                        </select>
                      </div>
                    </div>

                    </div> 
                    <div class="form-group">
                        <div class="">
                          <button style="margin-left:139px;" type="submit" class="btn btn-success">Submit</button>
                          <a href="{{route('all-user')}}" class="btn btn-info ml-3">Back</a>
                        </div>
                    </div>

                  </div>
			    </form>
			  <!-- /.card -->
        </div>
      </div>
@endsection
