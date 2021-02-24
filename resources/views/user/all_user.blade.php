@extends('master')

@section('content')
 <!-- DataTables -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Employeer Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0);">Employeer</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0);">All Employeer Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
          <h3 class="card-title">All Employeer Information</h3>
          <div class="float-sm-right">
          <a href="" class="btn btn-success">Batch Upload</a> 
          <a href="" class="btn btn-success">Download Sample Excel</a> 
            <a href="{{route('add-user')}}" class="btn btn-success"><i class="fas fa-plus"></i> Add Employeer</a>
          </div>

          <div class="col-md-6 offset-3 mt-2">
            @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block text-center">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
              </div>
            @endif

            @if ($message = Session::get('error'))
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

    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="all-user" class="table table-bordered table-striped">
        <thead>
          <tr class="bg-success">
          <th>SL NO</th>
          <th>Name</th>
          <th>Staff Code</th>
          <th>Email</th>
          <th>User Type</th>
          <th>Rights Body</th>
          <th>Mobile</th>
          <th>Designation</th>
          <th>Address</th>
          <th>Department</th>
          <th>Description</th>
        </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
           @foreach($users as $user)
         <tr>
          <td>{{$i++}}</td>
          <td>
            <a href="{{url('/edit-user',$user->id)}}">{{ $user->name}}</a>
          </td>
          <td>
            <a href="{{url('/edit-user',$user->id)}}">
              {{sprintf("%04d", $user->staff_code)}}
            </a>
          </td>
          <td>{{ $user->email}}</td>
          <td>{{ $user->user_type}}</td>
          <td>{{ $user->rights_body}}</td>
          <td>{{ $user->mobile}}</td>
          <td>{{ $user->designation}}</td>
          <td>{{ $user->address}}</td>
          <td>{{ $user->department}}</td>
          <td>{{ $user->description}}</td>
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

@section('customjs')
<script>
  $(function () {
    // $("#example1").DataTable();
    $('#all-user').DataTable({
         // "paging": true,
        // "lengthChange": false,
      // "searching": false,
        // "ordering": true,
      "info": true,
      "autoWidth": false,
      scrollX:'50vh',
      scrollY:'50vh',
      scrollCollapse: true,
    });
  });

  function ConfirmDelete()
  {
    var user = confirm("Are you sure you want to delete?");
    if (user)
        return true;
    else
      return false;
  }
</script>

@endsection