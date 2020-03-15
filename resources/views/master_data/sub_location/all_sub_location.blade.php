@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Sub Location Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Sub Location</a></li>
          <li class="breadcrumb-item active"><a href="#">All Sub Location Information</a></li>
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
          <h3 class="card-title">All Sub Location Information</h3>
        </div>
        <div class="col-md-6 ">
            <a href="{{route('add-sub-location')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add Sub Location</a>
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
      <table id="all-sub-location" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>SL NO</th>
            <th>Sub Location Name</th>
            <th>Sub Location Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          @foreach ($sub_locations as $sub_location)
          <tr>
            <td>{{ $i++}}</td>
            <td>{{$sub_location->sub_location_name}}</td>
            <td>{{$sub_location->sub_location_description}}</td>
            <td>
                <a href="{{route('edit-sub-location',$sub_location->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <a href="{{route('delete-sub-location',$sub_location->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
    $('#all-sub-location').DataTable();
  });

</script>
@endsection