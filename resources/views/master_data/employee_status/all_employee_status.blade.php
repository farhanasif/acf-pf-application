@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Employee Status Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Employee Status</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">All Employee Status Information</a></li>
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
          <h3 class="card-title">All Employee Status Information</h3>
        </div>
        <div class="col-md-6 ">
            <a href="{{route('add-employee-status')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add Employee Status</a>
        </div>
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
      </div>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="all-employee-status" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>SL NO</th>
            <th>Employee Status Name</th>
            <th>Employee Status Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php $i = 1; ?>
          @foreach ($all_employee_status as $row)
            <tr>
              <td>{{$i++}}</td>
              <td>{{$row->status_name}}</td>
              <td>{{$row->description}}</td>
              <td>
                <a href="{{route('edit-employee-status',$row->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <a href="{{route('delete-employee-status',$row->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
      $('#all-employee-status').DataTable();
    });
</script>
@endsection