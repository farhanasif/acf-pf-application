
@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
          <h1>All Alert Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Alert</a></li>
          <li class="breadcrumb-item active"><a href="#">All Alert Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="card card-success card-outline">
      <div class="card-header">
              <h3 class="card-title">All Alert Information</h3>
          <div class="float-sm-roght">
              <a href="{{route('add-alert')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add Alert</a>
          </div>
      
        <div class="col-md-5 text-center offset-3 mt-2">
            @if ($message = Session::get('danger'))
              <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
              </div>
            @endif

            @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
              </div>
            @endif
        </div>
      </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="all-alert" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>SL NO</th>
            <th>Name</th>
            <th>Duration</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          @foreach ($alerts as $alert)
          <tr>
          <td>{{$i++}}</td>
          <td>{{$alert->name}}</td>
          <td>{{$alert->duration}}</td>
          <td>
              <a href="{{route('edit-alert',$alert->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
              <a href="{{route('delete-alert',$alert->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt "></i></a>
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
    $('#all-alert').DataTable();
  });

</script>
@endsection