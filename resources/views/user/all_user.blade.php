@extends('master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All User Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">User</a></li>
          <li class="breadcrumb-item active"><a href="#">All User Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
      <h3 class="card-title">All User Information</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>SL NO</th>
          <th>Name</th>
          <th>Staff Code</th>
          <th>Email</th>
          <th>Role</th>
          <th>Rights Body</th>
          <th>Mobile</th>
          <th>Designation</th>
          <th>Address</th>
          <th>Department</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
           @foreach($users as $user)
        <tr>
          <td>{{$i++}}</td>
          <td>{{ $user->name}}</td>
          <td>{{ $user->staff_code}}</td>
          <td>{{ $user->email}}</td>
          <td>{{ $user->role}}</td>
          <td>{{ $user->rights_body}}</td>
          <td>{{ $user->mobile}}</td>
          <td>{{ $user->designation}}</td>
          <td>{{ $user->address}}</td>
          <td>{{ $user->department}}</td>
          <td>{{ $user->description}}</td>
          <td >
              <a href="{{url('/edit-user',$user->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
              <a href="{{url('/delete-user',$user->id)}}" onclick="ConfirmDelete()" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
    @endforeach
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
@endsection

<script>
    function ConfirmDelete()
    {
      var user = confirm("Are you sure you want to delete?");
      if (user)
          return true;
      else
        return false;
    }
</script>
