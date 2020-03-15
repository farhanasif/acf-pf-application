
@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All User Role Information </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">User Rolet</a></li>
          <li class="breadcrumb-item active"><a href="#">All User Role Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
      <div class="row">
        <div class="col-sm-6">
            <h3 class="card-title">All User Role Information</h3>
        </div>
        <div class="col-md-6">
          <a href="" class="btn btn-success">Batch Upload</a> 
          <a href="" class="btn btn-success">Download Sample Excel</a> 
          <a href="{{route('add-user-role')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add User Role</a>
        </div>

         <div class="col-md-6 offset-3 mt-2">
            @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
              </div>
            @endif

            @if ($message = Session::get('danger'))
              <div class="alert alert-danger alert-block">
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

      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="all-user-role" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>SL NO</th>
            <th>Role Name</th>
            <th>Role Description</th>
            <th>Role Value</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php $i = 1;?>
          @foreach ($user_roles as $user_role)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$user_role->role_name}}</td>
            <td>{{$user_role->role_description}}</td>
            <td>{{$user_role->value}}</td>
            <td>
              <a href="{{route('edit-user-role',$user_role->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
              <a href="{{route('delete-user-role',$user_role->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt "></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
@endsection

@section('customjs')  
<script>

  $(document).ready( function(){
    $('#all-user-role').DataTable();
  });

</script>
@endsection