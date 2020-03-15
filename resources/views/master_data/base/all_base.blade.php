@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Base Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Base</a></li>
          <li class="breadcrumb-item active"><a href="#">All Base Information</a></li>
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
          <h3 class="card-title">All Base Information</h3>
        </div>
        <div class="col-md-6 ">
            <a href="{{route('add-base')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add Base</a>
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
      <table id="all-base" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>SL NO</th>
          <th>Base Name</th>
          <th>Base Description</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          @foreach ($bases as $base)
          <tr>
            <td>{{ $i++}}</td>
            <td>{{$base->base_name}}</td>
            <td>{{$base->base_description}}</td>
            <td class="row">
              <a href="{{route('edit-base',$base->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
              <a href="{{route('delete-base',$base->id)}}" class="btn btn-danger ml-2"><i class="fas fa-trash-alt"></i></a>
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
    $('#all-base').DataTable();
  });

</script>
@endsection