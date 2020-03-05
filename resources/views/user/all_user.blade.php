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
      <div class="row">
        <div class="col-sm-6">
          <h3 class="card-title">All Employeer Information</h3>
        </div>

        <div class="col-md-6">
          <a href="" class="btn btn-success">Batch Upload</a> 
          <a href="" class="btn btn-success">Download Sample Excel</a> 
            <a href="{{url('/add-user')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Employeer</a>
        </div>

      </div>
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
            <a href="{{url('/edit-user',$user->id)}}">{{ $user->staff_code}}</a>
            
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
{{-- <!-- DataTables -->
<script src="{{ asset('theme/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('theme/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script> --}}
<script>
  $(function () {
    // $("#example1").DataTable();
    $('#example1').DataTable({
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

