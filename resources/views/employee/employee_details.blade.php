@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Employee Details Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Employee</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Employee Details Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="card card-success card-outline">
    <div class="card-header">
          <h3 class="card-title">Employee Details Information</h3>

        <div class="float-sm-right"> 
        <a href="#" class="btn btn-success"><i class="fas fa-plus"></i> Edit Employee</a>
        </div>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
     Employee Details Or Employee History 
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>

  @endsection

 

