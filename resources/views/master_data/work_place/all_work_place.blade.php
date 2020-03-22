@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Work Place Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Work Place</a></li>
          <li class="breadcrumb-item active"><a href="#">All Work Place Information</a></li>
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
          <h3 class="card-title">All Work Place Information</h3>
        </div>
        <div class="col-md-6 ">
            <a href="{{route('add-work-place')}}" class="btn btn-success float-right"><i class="fas fa-plus"></i> Add Work Place</a>
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
      <table id="all-work-place" class="table table-bordered table-striped">
        <thead>
          <tr class="bg-success">
            <th>SL NO</th>
            <th>Work Place Name</th>
            <th>Work Place Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          @foreach ($work_places as $work_place)
          <tr>
            <td>{{ $i++}}</td>
            <td>{{$work_place->work_place_name}}</td>
            <td>{{$work_place->work_place_description}}</td>
            <td>
              <a href="{{route('edit-work-place',$work_place->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
              <a href="{{route('delete-work-place',$work_place->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
    $('#all-work-place').DataTable({
          "info": true,
          "autoWidth": false,
          scrollX:'50vh', 
          scrollY:'50vh',
    });
  });

</script>
@endsection