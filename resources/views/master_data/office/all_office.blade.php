
@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Office Information </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Office</a></li>
          <li class="breadcrumb-item active"><a href="#">All Office Information</a></li>
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
          <h3 class="card-title">All Office Information</h3>
      </div>
      <div class="col-md-6 ">
          <a href="{{route('add-office')}}" class="btn btn-success float-right"><i class="fas fa-plus"></i> Add Office</a>
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

    <!-- /.card-header -->
    <div class="card-body">
      <table id="all-office" class="table table-bordered table-striped">
        <thead>
          <tr class="bg-success">
          <th>SL NO</th>
          <th>name</th>
          <th>Duration</th>
          <th>Office Code</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          @foreach($offices as $office)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$office->name}}</td>
            <td>{{$office->duration}}</td>
            <td>{{$office->office_code}}</td>
            <td>
                <a href="{{route('edit-office',$office->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <a href="{{route('delete-office',$office->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
    $('#all-office').DataTable({
          "info": true,
          "autoWidth": false,
          scrollX:'50vh', 
          scrollY:'50vh',
    });
  });

</script>
@endsection