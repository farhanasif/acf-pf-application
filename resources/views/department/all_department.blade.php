
@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Department</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Department</a></li>
          <li class="breadcrumb-item active"><a href="#">All Department</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
      <h3 class="card-title">All Department</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>SL NO</th>
          <th>Department Name</th>
          <th>Department Code</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          @foreach($departments  as $department)
        <tr>
          <td>{{$i++}}</td>
          <td>{{$department->name}}</td>
          <td>{{$department->department_code}}</td>
          <td>
              <a href="{{route('edit-department',$department->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
              <a href="{{route('delete-department',$department->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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

