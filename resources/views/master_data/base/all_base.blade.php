@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Base </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Base</a></li>
          <li class="breadcrumb-item active"><a href="#">All Base</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


<section class="content">
  <div class="card card-success card-outline">
    <div class="card-header">
      <h3 class="card-title">All Base Information</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="base" class="table table-bordered table-striped">
        <thead>

        <tr>
          <th>SL NO</th>
          <th>Base Name</th>
          <th>Base Description</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td >
              <a href="" class="btn btn-warning"><i class="fas fa-edit"></i></a>
              <a href="" onclick="ConfirmDelete()" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
    
      </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>


<script>
    $(function () {
      // $("#example1").DataTable();
      $('#base').DataTable({
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
  </script>

@endsection

