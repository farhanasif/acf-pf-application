@extends('master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add User Role Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">User Role</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add User Role Information</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Add User Role Information</h3>
        </div>

        <div class="col-md-6 offset-3 mt-2">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

{{--            @if ($errors->any())--}}
{{--                <div class="alert alert-warning">--}}
{{--                    <button type="button" class="close" data-dismiss="alert">×</button>--}}
{{--                    <strong>Whoops!</strong> There were some problems with your input.<br><br>--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}
        </div>

        <section class="content">
            <div class="container-fluid">
                <form class="form-horizontal form-label-left" action="{{route('store.system.user')}}" method="post">
                    @csrf
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                            @if($errors->has('name'))
                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Staff Code</label>
                            {{-- <input type="number" class="form-control" name="staff_code" id="staff_code" placeholder="Enter Staff Code"> --}}
                                <select id="my-select" name="staff_code" id="staff_code" class="form-control select2bs4">
                               <option value="">--Select Staff Code--</option>
                                @foreach ($staff_codes as $staff_code)
                                 <option value="{{ $staff_code->staff_code }}">{{ sprintf("%04d", $staff_code->staff_code)}}</option>
                                @endforeach
                                </select>
                            @if($errors->has('staff_code'))
                                <strong class="text-danger">{{ $errors->first('staff_code') }}</strong>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                            @if($errors->has('email'))
                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">User Type</label>
                            <input type="text" class="form-control" name="user_type" id="user_type" placeholder="Enter User Type">
                            @if($errors->has('user_type'))
                                <strong class="text-danger">{{ $errors->first('user_type') }}</strong>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Rights Body</label>
                            <input type="text" class="form-control" name="rights_body" id="rights_body" placeholder="Enter Rights Body">
                            @if($errors->has('rights_body'))
                                <strong class="text-danger">{{ $errors->first('rights_body') }}</strong>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mobile</label>
                            <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile">
                            @if($errors->has('mobile'))
                                <strong class="text-danger">{{ $errors->first('mobile') }}</strong>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Designation</label>
                            <input type="text" class="form-control" name="designation" id="designation" placeholder="Enter Designation">
                            @if($errors->has('designation'))
                                <strong class="text-danger">{{ $errors->first('designation') }}</strong>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                            @if($errors->has('address'))
                                <strong class="text-danger">{{ $errors->first('address') }}</strong>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Department</label>
                            <input type="text" class="form-control" name="department" id="department" placeholder="Enter department">
                            @if($errors->has('department'))
                                <strong class="text-danger">{{ $errors->first('department') }}</strong>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Discription</label>
                            <input type="text" class="form-control" name="description" id="description" placeholder="Enter discription">
                            @if($errors->has('description'))
                                <strong class="text-danger">{{ $errors->first('description') }}</strong>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                            @if($errors->has('password'))
                                <strong class="text-danger">{{ $errors->first('password') }}</strong>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirm Possword</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password" placeholder="Enter confirm password">
                            @if($errors->has('password_confirmation'))
                                <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <div class="col-md-6 col-sm-6">
                                <select class="form-control" name="role">
                                    <option value="">-- Select Role --</option>
                                    <option value="sub-admin">Sub Admin</option>
                                    <option value="editor">Editor</option>
                                    <option value="moderator">Moderator</option>
                                </select>
                                @if($errors->has('role'))
                                    <strong class="text-danger">{{ $errors->first('role') }}</strong>
                                @endif
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                    <div class="card-footer">

                        <button  type="submit" class="btn btn-success float-right ">Submit</button>&nbsp;&nbsp;
                        <a href="#" class="btn btn-info ml-4 float-right">Back</a>
                    </div>
                </form>
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection

@section('customjs')
    <script>

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    </script>
@endsection


