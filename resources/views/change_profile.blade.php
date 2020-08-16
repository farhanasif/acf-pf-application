
@extends('master')

@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="javascript:void(0)">Change Profile</a></li>
              <li class="breadcrumb-item active"><a href="javascript:void(0)">Change Profile</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Change Profile</h3>
        </div>


        <div class="col-md-6 offset-3 mt-2">
          @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block text-center">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
              </div>
          @endif

          @if ($message = Session::get('danger'))
            <div class="alert alert-danger alert-block text-center">
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
      </div>

        <div class="card-header">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label  class="col-form-label col-md-3 col-sm-3 label-align">Name</label>
                  <div class="col-md-8 col-sm-3 ">
                    <label" for="">{{$profile->name}}</label>
                  </div>
                </div>

                <div class="form-group row">
                  <label  class="col-form-label col-md-3 col-sm-3 label-align">Rights Body</label>
                  <div class="col-md-8 col-sm-8 ">
                    <label" for="">{{$profile->rights_body}}</label>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Designation</label>
                    <div class="col-md-8 col-sm-8 ">
                      <label" for="">{{$profile->designation}}</label>
                    </div>
                </div>

                <div class="form-group row">
                  <label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Department</label>
                    <div class="col-md-8 col-sm-8 ">
                      <label" for="">{{$profile->department}}</label>
                    </div>
                </div>

                <div class="form-group row">
                  <label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Description</label>
                    <div class="col-md-8 col-sm-8 ">
                      <label" for="">{{$profile->description}}</label>
                    </div>
                </div>

                </div>

              <div class="col-md-6 ">
                <div class="form-group row ">
                  <label for="staff_code" class="col-form-label col-md-3 col-sm-3 label-align offset-1">Staff Code</label>
                    <div class="col-md-8 col-sm-8 ">
                      <label" for="">{{$profile->staff_code}}</label>
                    </div>
                  </div>
                  <div class="form-group row ">
                    <label for="role" class="col-form-label col-md-3 col-sm-3 label-align offset-1">Role</label>
                    <div class="col-md-8 col-sm-3 ">
                      <label" for="">{{$profile->role}}</label>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="email" class="col-form-label col-md-3 col-sm-3 label-align offset-1">Mobile</label>
                    <div class="col-md-8 col-sm-8 ">
                      <label" for="">{{$profile->mobile}}</label>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="email" class="col-form-label col-md-3 col-sm-3 label-align offset-1">Address</label>
                      <div class="col-md-8 col-sm-8 ">
                        <label" for="">{{$profile->address}}</label>
                      </div>
                  </div>

                                      
                <div class="form-group row">
                  <label for="role" class="col-form-label col-md-3 col-sm-3 label-align offset-1">Verified</label>
                  <div class="col-md-8 col-sm-8 ">
                    <label" for="">{{$profile->verified}}</label>
                  </div>
                </div>

                </div> 

              </div>
        </div>
			   
        <!-- /.card -->
        
          <div class="card-header  card-secondary">
              <div class="card-header">
                  <h3 class="card-title">Change Password</h3>
              </div>
          </div>

        <form class="form-horizontal form-label-left" action="{{route('update-passsword',Auth::user()->id)}}" method="post">
            @csrf
          <div class="card-body">

            <div class="form-group row">
              <label  class="col-form-label col-md-3 col-sm-3 label-align">Old Password</label>
              <div class="col-md-8 col-sm-3 ">
                <input type="password" class="form-control" name="old_password" placeholder="Old Password">
              </div>
            </div>

            <div class="form-group row">
              <label  class="col-form-label col-md-3 col-sm-3 label-align">New Password</label>
              <div class="col-md-8 col-sm-3 ">
                <input type="password" class="form-control" name="password" placeholder="New Password">
              </div>
            </div>

            <div class="form-group row">
              <label  class="col-form-label col-md-3 col-sm-3 label-align">Confirm Password</label>
              <div class="col-md-8 col-sm-3 ">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
              </div>
            </div>

            <div class="form-group row">
              <label  class="col-form-label col-md-3 col-sm-3 label-align"></label>
              <div class="col-md-8 col-sm-3 ">
                <button type="submit" class="btn btn-success">Submit</button>                  </div>
            </div>
          </div>
        </form>
      </div>
@endsection
