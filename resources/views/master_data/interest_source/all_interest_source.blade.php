@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Interest Sourece Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Interest Sourece</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">All Interest Sourece Information</a></li>
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
          <h3 class="card-title">All Interest Sourece Information</h3>
        </div>
        <div class="col-md-6 ">
            <a href="{{route('add-interest-source')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add Interest Source</a>
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
      <table id="all-interest-source" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>SL NO</th>
            <th>Employee Status Name</th>
            <th>Employee Status Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

        <?php $i = 1;?>
        @foreach ($interest_sources as $interest_source)
            <tr>
              <td> {{ $i++}} </td>
              <td> {{$interest_source->name}} </td>
              <td> {{$interest_source->description}} </td>
              <td>
                <a href="{{route('edit-interest-source',$interest_source->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <a href="{{route('delete-interest-source',$interest_source->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
    $('#all-interest-source').DataTable();
  });

</script>
@endsection