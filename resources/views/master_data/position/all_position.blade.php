@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Position Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Position</a></li>
          <li class="breadcrumb-item active"><a href="#">All Position Information</a></li>
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
            <h3 class="card-title">All Position Information</h3>
        </div>
        <div class="col-md-6 ">
            <a href="{{route('add-position')}}" class="btn btn-success float-right"><i class="fas fa-plus"></i> Add position</a>
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
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="all-position" class="table table-bordered table-striped">
        <thead>
          <tr class="bg-success">
            <th>SL NO</th>
            <th>Position Name</th>
            <th>Position Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          @foreach ($positions as $position)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$position->position_name}}</td>
            <td>{{$position->position_description}}</td>
            <td>
                <a href="{{route('edit-position',$position->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <a href="{{route('delete-position',$position->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
    $('#all-position').DataTable({
          "info": true,
          "autoWidth": false,
          scrollX:'50vh', 
          scrollY:'50vh',
    });
  });

</script>
@endsection

